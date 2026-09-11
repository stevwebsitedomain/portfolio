<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<div class="necta-contact-bar">
  <div class="necta-contact-item">
    <span class="necta-ico necta-ico-fill" aria-hidden="true"><i class="fa-solid fa-location-dot"></i></span>
    <div>
      <strong data-i18n="contact_location">Location:</strong>
      <p><span data-i18n="contact_location_line1">Digital Matrix Technology</span><br><span data-i18n="contact_location_line2">Tanzania</span></p>
    </div>
  </div>
  <a class="necta-contact-item" href="mailto:stevenabalwambo@gmail.com">
    <span class="necta-ico" aria-hidden="true"><i class="fa-regular fa-envelope"></i></span>
    <div>
      <strong data-i18n="contact_email_label">Email:</strong>
      <p>stevenabalwambo@gmail.com</p>
    </div>
  </a>
  <a class="necta-contact-item" href="tel:+255715296092">
    <span class="necta-ico" aria-hidden="true"><i class="fa-solid fa-mobile-screen-button"></i></span>
    <div>
      <strong data-i18n="contact_call_label">Call:</strong>
      <p>+255 715 296 092</p>
    </div>
  </a>
</div>

<form class="php-email-form necta-contact-form" novalidate>
  <div class="hp-field" aria-hidden="true">
    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
  </div>
  <input type="hidden" name="phone" value="">
  <div class="form-row">
    <label class="field">
      <span class="sr-only" data-i18n="ph_name">Your Name</span>
      <input type="text" name="name" data-i18n="ph_name" placeholder="Your Name" required>
    </label>
    <label class="field">
      <span class="sr-only" data-i18n="ph_email">Your Email</span>
      <input type="email" name="email" data-i18n="ph_email" placeholder="Your Email" required>
    </label>
  </div>
  <div class="form-row full">
    <label class="field">
      <span class="sr-only" data-i18n="ph_subject">Subject</span>
      <input type="text" name="subject" data-i18n="ph_subject" placeholder="Subject" required>
    </label>
  </div>
  <div class="form-row full">
    <label class="field">
      <span class="sr-only" data-i18n="ph_message">Message</span>
      <textarea name="message" data-i18n="ph_message" placeholder="Message" required></textarea>
    </label>
  </div>
  <div class="form-actions">
    <div class="loading" data-i18n="form_sending">Sending…</div>
    <div class="error-message"></div>
    <div class="sent-message" data-i18n="form_sent">Thank you. Your message has been sent.</div>
    <button type="submit" data-i18n="send_message">Send Message</button>
  </div>
</form>
