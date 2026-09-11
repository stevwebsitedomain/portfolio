<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
$footerLiveProjects = $footerLiveProjects ?? false;
?>
  <footer id="footer">
    <div class="container footer-top<?= $footerLiveProjects ? ' footer-top-live' : '' ?>">
      <div class="footer-col">
        <h3 data-i18n="footer_support">Customer Support Centre</h3>
        <div class="contact-line"><i class="fa-solid fa-phone"></i><span>+255 715 296 092</span></div>
        <p data-i18n="footer_support_p">Reach out for projects, support, or systems advice.</p>
        <div class="socials">
          <a href="https://wa.me/255715296092" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="mailto:stevenabalwambo@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h3 data-i18n="footer_links">Links</h3>
        <ul>
          <li><a href="<?= $baseUrl ?>/">› <span data-i18n="nav_home">Home</span></a></li>
          <li><a href="<?= $baseUrl ?>/about">› <span data-i18n="nav_about">About</span></a></li>
          <li><a href="<?= $baseUrl ?>/services">› <span data-i18n="nav_services">Services</span></a></li>
          <li><a href="<?= $baseUrl ?>/projects">› <span data-i18n="nav_projects">Projects</span></a></li>
          <li><a href="<?= $baseUrl ?>/news">› <span data-i18n="nav_news">News</span></a></li>
          <li><a href="<?= $baseUrl ?>/events">› <span data-i18n="nav_events">Events</span></a></li>
          <li><a href="<?= $baseUrl ?>/qualifications">› <span data-i18n="nav_qualifications">Qualifications</span></a></li>
          <li><a href="<?= $baseUrl ?>/contact">› <span data-i18n="nav_contact">Contact</span></a></li>
        </ul>
      </div>
<?php if ($footerLiveProjects): ?>
      <div class="footer-col">
        <h3 data-i18n="footer_live">Live Projects</h3>
        <ul>
          <li><a href="https://dda-tra.free.nf" target="_blank" rel="noopener">› TRA</a></li>
          <li><a href="https://audit.plustax.co.tz/" target="_blank" rel="noopener">› Plustax</a></li>
          <li><a href="https://whitelakeschoolportal.co.tz" target="_blank" rel="noopener">› White Lake</a></li>
          <li><a href="http://reacris.co.tz/" target="_blank" rel="noopener">› REACRIS</a></li>
          <li><a href="http://g4elevate.co.tz/" target="_blank" rel="noopener">› G4 Elevate</a></li>
          <li><a href="https://agridata.co.tz" target="_blank" rel="noopener">› AGRIDATA</a></li>
          <li><a href="https://aoa.aquinasschool.sc.tz" target="_blank" rel="noopener">› Aquinas</a></li>
          <li><a href="https://miracletechgroup.com" target="_blank" rel="noopener">› Miracle Tech</a></li>
        </ul>
      </div>
<?php endif; ?>
      <div class="footer-col">
        <h3 data-i18n="footer_contact">Contact Us</h3>
        <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span>Digital Matrix Technology<br>Tanzania</span></div>
        <div class="contact-line"><i class="fa-solid fa-envelope"></i><span>stevenabalwambo@gmail.com</span></div>
        <div class="contact-line"><i class="fa-brands fa-whatsapp"></i><span>+255 715 296 092</span></div>
      </div>
      <div class="footer-col footer-col-qr">
        <div class="footer-qr">
          <a href="https://makarious.legitconsult.co.tz/" target="_blank" rel="noopener">
            <img src="<?= $baseUrl ?>/images/portfolio-qr.png?v=2" width="140" height="140" alt="QR code for https://makarious.legitconsult.co.tz">
          </a>
          <span class="footer-qr-caption" data-i18n="qr_caption">Scan to open this portfolio</span>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container footer-bottom-row">
        <p>© <span id="year"></span> <span data-i18n="footer_copy">Steven Makarious · Digital Matrix Technology. All rights reserved.</span></p>
        <div class="footer-bottom-links">
          <a href="<?= $baseUrl ?>/about" data-i18n="footer_about">About</a>
          <a href="<?= $baseUrl ?>/contact" data-i18n="footer_contact_link">Contact</a>
          <a href="<?= $baseUrl ?>/sitemap.xml" data-i18n="footer_map">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>
