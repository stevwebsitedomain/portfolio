/**
 * Contact form: Send Message opens a choice of SMS or WhatsApp.
 */
(function () {
  'use strict';

  var pending = null;
  var ignoreClicksUntil = 0;

  function setError(errorEl, text) {
    if (!errorEl) return;
    errorEl.textContent = text;
    errorEl.classList.add('d-block');
  }

  function whatsappNumber() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    return String(cfg.whatsappNumber || '255715296092').replace(/\D/g, '');
  }

  function contactEndpoint() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    if (cfg.contactEndpoint) return cfg.contactEndpoint;
    return (window.PORTFOLIO_BASE || '') + '/send-message.php';
  }

  function t(key, fallback) {
    var i18n = window.PortfolioI18n;
    if (i18n && typeof i18n.t === 'function') {
      var lang = typeof i18n.getLang === 'function' ? i18n.getLang() : 'en';
      var value = i18n.t(lang, key);
      if (value && value !== key) return value;
    }
    return fallback;
  }

  function formPayload(form) {
    return {
      name: ((form.querySelector('[name="name"]') || {}).value || '').trim(),
      email: ((form.querySelector('[name="email"]') || {}).value || '').trim(),
      phone: ((form.querySelector('[name="phone"]') || {}).value || '').trim(),
      subject: ((form.querySelector('[name="subject"]') || {}).value || '').trim(),
      message: ((form.querySelector('[name="message"]') || {}).value || '').trim(),
      website: ((form.querySelector('[name="website"]') || {}).value || '').trim(),
    };
  }

  function messageText(data) {
    return 'Portfolio contact'
      + '\nName: ' + data.name
      + '\nEmail: ' + data.email
      + (data.phone ? '\nPhone: ' + data.phone : '')
      + '\nSubject: ' + data.subject
      + '\n\n' + data.message;
  }

  function openWhatsApp(data) {
    window.open(
      'https://wa.me/' + whatsappNumber() + '?text=' + encodeURIComponent(messageText(data)),
      '_blank',
      'noopener'
    );
  }

  function closeModal(overlay) {
    if (!overlay) return;
    overlay.hidden = true;
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
  }

  function ensureModal() {
    var overlay = document.getElementById('sendChoiceModal');
    if (overlay) return overlay;

    overlay = document.createElement('div');
    overlay.id = 'sendChoiceModal';
    overlay.className = 'send-choice-overlay';
    overlay.hidden = true;
    overlay.setAttribute('aria-hidden', 'true');
    overlay.innerHTML = ''
      + '<div class="send-choice-card" role="dialog" aria-modal="true" aria-labelledby="sendChoiceTitle">'
      + '  <button type="button" class="send-choice-close" data-close="1" aria-label="Close">&times;</button>'
      + '  <h3 id="sendChoiceTitle"></h3>'
      + '  <p class="send-choice-lead"></p>'
      + '  <div class="send-choice-actions">'
      + '    <button type="button" class="send-choice-sms" data-channel="sms">'
      + '      <i class="fa-solid fa-comment-sms"></i><span></span>'
      + '    </button>'
      + '    <button type="button" class="send-choice-wa" data-channel="whatsapp">'
      + '      <i class="fa-brands fa-whatsapp"></i><span></span>'
      + '    </button>'
      + '  </div>'
      + '</div>';
    document.body.appendChild(overlay);

    overlay.addEventListener('click', function (event) {
      if (Date.now() < ignoreClicksUntil) return;
      if (event.target === overlay || event.target.closest('[data-close]')) {
        closeModal(overlay);
        return;
      }

      var smsBtn = event.target.closest('[data-channel="sms"]');
      var waBtn = event.target.closest('[data-channel="whatsapp"]');
      if (!smsBtn && !waBtn) return;
      if (!pending) return;
      event.preventDefault();
      event.stopPropagation();

      if (waBtn) {
        closeModal(overlay);
        openWhatsApp(pending.data);
        if (pending.sentEl) {
          pending.sentEl.textContent = t('form_sent_wa', 'WhatsApp is opening with your message. Tap Send.');
          pending.sentEl.classList.add('d-block');
        }
        return;
      }

      closeModal(overlay);
      sendSms(pending);
    });

    return overlay;
  }

  function sendSms(ctx) {
    if (ctx.loadingEl) ctx.loadingEl.classList.add('d-block');
    fetch(contactEndpoint(), {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({
        name: ctx.data.name,
        email: ctx.data.email,
        phone: ctx.data.phone,
        subject: ctx.data.subject,
        message: ctx.data.message,
        website: ctx.data.website,
        channel: 'sms',
      }),
    })
      .then(function (res) {
        return res.json().then(function (json) {
          return { json: json };
        });
      })
      .then(function (out) {
        if (ctx.loadingEl) ctx.loadingEl.classList.remove('d-block');
        if (out.json && out.json.ok) {
          if (ctx.sentEl) {
            ctx.sentEl.textContent = out.json.message || t('form_sent_sms', 'Thank you. Your SMS has been sent.');
            ctx.sentEl.classList.add('d-block');
          }
          return;
        }
        setError(ctx.errorEl, (out.json && out.json.message) || 'SMS could not be sent.');
      })
      .catch(function () {
        if (ctx.loadingEl) ctx.loadingEl.classList.remove('d-block');
        setError(ctx.errorEl, 'SMS could not be sent. Please try WhatsApp.');
      });
  }

  function openChoice(form) {
    var errorEl = form.querySelector('.error-message');
    var sentEl = form.querySelector('.sent-message');
    var loadingEl = form.querySelector('.loading');
    var data = formPayload(form);

    if (errorEl) {
      errorEl.classList.remove('d-block');
      errorEl.textContent = '';
    }
    if (sentEl) sentEl.classList.remove('d-block');
    if (loadingEl) loadingEl.classList.remove('d-block');

    if (data.website) return;

    if (!data.name || !data.email || !data.subject || !data.message) {
      setError(errorEl, 'Please fill in name, email, subject, and message.');
      return;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) {
      setError(errorEl, 'Please enter a valid email address.');
      return;
    }

    pending = { form: form, data: data, errorEl: errorEl, sentEl: sentEl, loadingEl: loadingEl };
    var overlay = ensureModal();
    var title = overlay.querySelector('#sendChoiceTitle');
    var lead = overlay.querySelector('.send-choice-lead');
    var sms = overlay.querySelector('.send-choice-sms span');
    var wa = overlay.querySelector('.send-choice-wa span');
    if (title) title.textContent = t('send_choice_title', 'How should we send this?');
    if (lead) lead.textContent = t('send_choice_lead', 'Choose SMS or WhatsApp.');
    if (sms) sms.textContent = t('send_sms', 'Send SMS');
    if (wa) wa.textContent = t('via_whatsapp', 'WhatsApp');

    ignoreClicksUntil = Date.now() + 400;
    overlay.hidden = false;
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
  }

  function bindForm(form) {
    form.setAttribute('novalidate', 'novalidate');
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      event.stopPropagation();
      openChoice(form);
    });
    var btn = form.querySelector('button[type="submit"]');
    if (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        openChoice(form);
      });
    }
  }

  function init() {
    document.querySelectorAll('.php-email-form').forEach(bindForm);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') return;
    closeModal(document.getElementById('sendChoiceModal'));
  });
})();
