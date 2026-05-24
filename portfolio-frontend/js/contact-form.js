/**
 * Contact form → Render backend API (sends email to contactRecipientEmail).
 */
(function () {
  'use strict';

  function isDebugEnabled() {
    try {
      var qs = new URLSearchParams(window.location.search);
      if (qs.get('debug') === '1') return true;
      if (window.localStorage && localStorage.getItem('portfolioDebug') === '1') return true;
    } catch (e) {
      // ignore
    }
    return false;
  }

  function apiUrl() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    var base = (cfg.apiBaseUrl || 'https://portfolio-mbvg.onrender.com').replace(/\/$/, '');
    var path = (cfg.endpoints && cfg.endpoints.contact) || '/api/contact';
    return base + path;
  }

  function apiRootUrl() {
    var cfg = window.PORTFOLIO_CONFIG || {};
    return (cfg.apiBaseUrl || 'https://portfolio-mbvg.onrender.com').replace(/\/$/, '') + '/';
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

  function setError(errorEl, text) {
    if (!errorEl) return;
    errorEl.textContent = text;
    errorEl.classList.add('d-block');
  }

  function fetchMailConfigured() {
    return fetch(apiRootUrl(), { method: 'GET', mode: 'cors', headers: { Accept: 'application/json' } })
      .then(parseResponse)
      .then(function (r) {
        if (r && r.data && typeof r.data.mailConfigured !== 'undefined') return r.data.mailConfigured;
        return null;
      })
      .catch(function () {
        return null;
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
      var debug = isDebugEnabled();

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
      if (loading) loading.classList.add('d-block');
      if (sentEl) sentEl.classList.remove('d-block');
      if (submitBtn) submitBtn.disabled = true;

      var headers = {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      };
      if (debug) {
        headers['X-Portfolio-Debug'] = '1';
      }

      var controller = new AbortController();
      var timeoutId = window.setTimeout(function () {
        controller.abort();
      }, 25000);

      fetch(url, {
        method: 'POST',
        mode: 'cors',
        headers: headers,
        signal: controller.signal,
        body: JSON.stringify({
          name: name,
          email: email,
          subject: subject,
          message: message,
        }),
      })
        .then(parseResponse)
        .then(function (result) {
          window.clearTimeout(timeoutId);
          if (loading) loading.classList.remove('d-block');
          if (submitBtn) submitBtn.disabled = false;

          if (result.ok && result.data && result.data.ok) {
            if (sentEl) sentEl.classList.add('d-block');
            form.reset();
            return;
          }

          var baseMsg =
            (result.data && result.data.error) ||
            'Could not send message (HTTP ' + result.status + ').';

          if (debug && result.data && result.data.debug) {
            baseMsg += '\n\n[Mail debug]\n' + result.data.debug;
          }

          if (!debug) {
            setError(errorEl, baseMsg);
            return;
          }

          fetchMailConfigured().then(function (mailConfigured) {
            var extra =
              '\n\n[Debug]\n' +
              'POST: ' + url + '\n' +
              'HTTP: ' + result.status + '\n' +
              'mailConfigured: ' + String(mailConfigured) + '\n' +
              'response: ' + JSON.stringify(result.data || {}, null, 2);

            setError(errorEl, baseMsg + extra);
          });
        })
        .catch(function (err) {
          window.clearTimeout(timeoutId);
          if (loading) loading.classList.remove('d-block');
          if (submitBtn) submitBtn.disabled = false;
          var hint =
            window.location.protocol === 'file:'
              ? ' Open the site via http://localhost or Vercel, not as a file.'
              : '';
          var msg =
            err && err.name === 'AbortError'
              ? 'Request timed out. Render/Gmail SMTP is slow or blocked. Try again in 30 seconds.'
              : 'Cannot reach API at ' + url + '. Wait for Render to wake up, then try again.' + hint;

          if (!debug) {
            setError(errorEl, msg);
            console.error('[Contact form]', err);
            return;
          }

          fetchMailConfigured().then(function (mailConfigured) {
            var extra =
              '\n\n[Debug]\n' +
              'POST: ' + url + '\n' +
              'mailConfigured: ' + String(mailConfigured) + '\n' +
              'error: ' + String((err && err.message) || err);
            setError(errorEl, msg + extra);
            console.error('[Contact form]', err);
          });
        });
    });
  });
})();
