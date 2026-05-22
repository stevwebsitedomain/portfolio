/**
 * Static contact form handler (no PHP).
 * Shows success feedback; opens mail client when available.
 */
(function () {
  'use strict';

  document.querySelectorAll('.php-email-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var loading = form.querySelector('.loading');
      var errorEl = form.querySelector('.error-message');
      var sentEl = form.querySelector('.sent-message');
      var name = (form.querySelector('[name="name"]') || {}).value || '';
      var email = (form.querySelector('[name="email"]') || {}).value || '';
      var subject = (form.querySelector('[name="subject"]') || {}).value || '';
      var message = (form.querySelector('[name="message"]') || {}).value || '';

      name = name.trim();
      email = email.trim();
      subject = subject.trim();
      message = message.trim();

      if (!name || !email || !subject || !message) {
        if (errorEl) {
          errorEl.textContent = 'Please fill in all fields.';
          errorEl.classList.add('d-block');
        }
        if (sentEl) sentEl.classList.remove('d-block');
        return;
      }

      if (errorEl) errorEl.classList.remove('d-block');
      if (loading) loading.classList.add('d-block');
      if (sentEl) sentEl.classList.remove('d-block');

      window.setTimeout(function () {
        if (loading) loading.classList.remove('d-block');
        if (sentEl) sentEl.classList.add('d-block');
        form.reset();

        var body =
          'Name: ' + name + '\nEmail: ' + email + '\n\n' + message;
        var mailto =
          'mailto:stevenabalwambo@gmail.com?subject=' +
          encodeURIComponent(subject) +
          '&body=' +
          encodeURIComponent(body);

        try {
          window.location.href = mailto;
        } catch (e) {
          /* Offline / blocked mailto: success message still shown */
        }
      }, 350);
    });
  });
})();
