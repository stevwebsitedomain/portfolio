/**
 * Contact form → opens WhatsApp with the composed message.
 * Number: +255 715 296 092
 */
(function () {
  'use strict';

  function whatsappNumber() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    return String(cfg.whatsappNumber || '255715296092').replace(/\D/g, '');
  }

  function setError(errorEl, text) {
    if (!errorEl) return;
    errorEl.textContent = text;
    errorEl.classList.add('d-block');
  }

  function buildWhatsAppText(name, email, subject, message) {
    return (
      'Hello Steven Makarious,\n\n' +
      'Name: ' + name + '\n' +
      'Email: ' + email + '\n' +
      'Subject: ' + subject + '\n\n' +
      'Message:\n' + message
    );
  }

  document.querySelectorAll('.php-email-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var loading = form.querySelector('.loading');
      var errorEl = form.querySelector('.error-message');
      var sentEl = form.querySelector('.sent-message');
      var submitBtn = form.querySelector('button[type="submit"]');

      var name = ((form.querySelector('[name="name"]') || {}).value || '').trim();
      var email = ((form.querySelector('[name="email"]') || {}).value || '').trim();
      var subject = ((form.querySelector('[name="subject"]') || {}).value || '').trim();
      var message = ((form.querySelector('[name="message"]') || {}).value || '').trim();

      if (!name || !email || !subject || !message) {
        setError(errorEl, 'Please fill in all fields.');
        if (sentEl) sentEl.classList.remove('d-block');
        return;
      }

      if (errorEl) {
        errorEl.classList.remove('d-block');
        errorEl.textContent = '';
      }
      if (sentEl) sentEl.classList.remove('d-block');
      if (loading) loading.classList.add('d-block');
      if (submitBtn) submitBtn.disabled = true;

      var text = buildWhatsAppText(name, email, subject, message);
      var url = 'https://wa.me/' + whatsappNumber() + '?text=' + encodeURIComponent(text);

      window.setTimeout(function () {
        if (loading) loading.classList.remove('d-block');
        if (submitBtn) submitBtn.disabled = false;
        window.open(url, '_blank', 'noopener,noreferrer');
        if (sentEl) {
          sentEl.textContent = 'Opening WhatsApp… Complete send there. Thank you!';
          sentEl.classList.add('d-block');
        }
        form.reset();
      }, 250);
    });
  });
})();
