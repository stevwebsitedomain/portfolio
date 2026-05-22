/**
 * Contact form → Render backend API (sends email to contactRecipientEmail).
 */
(function () {
  'use strict';

  function apiUrl() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    var base = (cfg.apiBaseUrl || 'https://portfolio-mbvg.onrender.com').replace(/\/$/, '');
    var path = (cfg.endpoints && cfg.endpoints.contact) || '/api/contact';
    return base + path;
  }

  function parseResponse(response) {
    return response.text().then(function (text) {
      var data = {};
      if (text) {
        try {
          data = JSON.parse(text);
        } catch (e) {
          data = { error: text.substring(0, 200) };
        }
      }
      return { ok: response.ok, data: data, status: response.status };
    });
  }

  document.querySelectorAll('.php-email-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var loading = form.querySelector('.loading');
      var errorEl = form.querySelector('.error-message');
      var sentEl = form.querySelector('.sent-message');
      var submitBtn = form.querySelector('button[type="submit"]');
      var url = apiUrl();

      var name = ((form.querySelector('[name="name"]') || {}).value || '').trim();
      var email = ((form.querySelector('[name="email"]') || {}).value || '').trim();
      var subject = ((form.querySelector('[name="subject"]') || {}).value || '').trim();
      var message = ((form.querySelector('[name="message"]') || {}).value || '').trim();

      if (!name || !email || !subject || !message) {
        if (errorEl) {
          errorEl.textContent = 'Please fill in all fields.';
          errorEl.classList.add('d-block');
        }
        if (sentEl) sentEl.classList.remove('d-block');
        return;
      }

      if (errorEl) {
        errorEl.classList.remove('d-block');
        errorEl.textContent = '';
      }
      if (loading) loading.classList.add('d-block');
      if (sentEl) sentEl.classList.remove('d-block');
      if (submitBtn) submitBtn.disabled = true;

      fetch(url, {
        method: 'POST',
        mode: 'cors',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
        body: JSON.stringify({
          name: name,
          email: email,
          subject: subject,
          message: message,
        }),
      })
        .then(parseResponse)
        .then(function (result) {
          if (loading) loading.classList.remove('d-block');
          if (submitBtn) submitBtn.disabled = false;

          if (result.ok && result.data && result.data.ok) {
            if (sentEl) sentEl.classList.add('d-block');
            form.reset();
            return;
          }

          if (errorEl) {
            errorEl.textContent =
              (result.data && result.data.error) ||
              'Could not send message (HTTP ' + result.status + ').';
            errorEl.classList.add('d-block');
          }
        })
        .catch(function (err) {
          if (loading) loading.classList.remove('d-block');
          if (submitBtn) submitBtn.disabled = false;
          if (errorEl) {
            var hint =
              window.location.protocol === 'file:'
                ? ' Open the site via http://localhost or Vercel, not as a file.'
                : '';
            errorEl.textContent =
              'Cannot reach API at ' +
              url +
              '. Wait for Render to wake up, then try again.' +
              hint;
            errorEl.classList.add('d-block');
          }
          console.error('[Contact form]', err);
        });
    });
  });
})();
