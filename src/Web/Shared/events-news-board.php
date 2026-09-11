<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<section class="events-board" id="events">
  <div class="container events-board-grid">
    <div class="events-col">
      <h2 class="events-board-title" data-i18n="events_title">Events</h2>

      <article class="event-row">
        <a class="event-thumb" href="<?= $baseUrl ?>/events">
          <img src="<?= $baseUrl ?>/images/steven-makarious.jpg" alt="Digital Matrix Technology client systems workshop" loading="lazy">
        </a>
        <div class="event-body">
          <a class="event-title" href="<?= $baseUrl ?>/events" data-i18n="event_1_title">THE DIGITAL MATRIX TECHNOLOGY CLIENT SYSTEMS WORKSHOP 2026</a>
          <p class="event-meta"><i class="fa-regular fa-clock" aria-hidden="true"></i><span data-i18n="event_1_when">Sep 22, 2026 09:00 - Sep 23, 2026 16:00</span></p>
          <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span data-i18n="event_1_where">DAR ES SALAAM, TANZANIA</span></p>
        </div>
      </article>

      <article class="event-row event-row-desc">
        <a class="event-thumb" href="<?= $baseUrl ?>/events">
          <img src="<?= $baseUrl ?>/assets/images/hero-team.jpg" alt="School portals and office systems briefing" loading="lazy" onerror="this.onerror=null;this.src='<?= $baseUrl ?>/images/eastc.png'">
        </a>
        <div class="event-body">
          <p class="event-lead" data-i18n="event_2_desc">Digital Matrix Technology will host a briefing on school portals, office systems, and live websites for clients and partners from 22–23 September 2026 at Julius Nyerere International Convention Centre, Dar es Salaam.</p>
          <p class="event-meta"><i class="fa-regular fa-clock" aria-hidden="true"></i><span data-i18n="event_2_when">Sep 22, 2026 09:00 - Sep 23, 2026 16:30</span></p>
          <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span data-i18n="event_2_where">Julius Nyerere International Convention Centre, Dar es Salaam</span></p>
        </div>
      </article>

      <article class="event-row event-row-more">
        <a class="event-thumb" href="<?= $baseUrl ?>/contact">
          <img src="<?= $baseUrl ?>/assets/images/hero-workspace.jpg" alt="Cloud hosting and deployment clinic" loading="lazy" onerror="this.onerror=null;this.src='<?= $baseUrl ?>/images/og-share.jpg'">
        </a>
        <div class="event-body">
          <a class="event-title" href="<?= $baseUrl ?>/contact" data-i18n="event_3_title">CLOUD HOSTING &amp; DEPLOYMENT CLINIC</a>
          <p class="event-lead" data-i18n="event_3_desc">A practical session on go-live, backups, and production support for websites and management systems.</p>
          <p class="event-meta"><i class="fa-regular fa-clock" aria-hidden="true"></i><span data-i18n="event_3_when">Oct 08, 2026 09:00 - Oct 08, 2026 13:00</span></p>
          <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span data-i18n="event_3_where">Digital Matrix Technology, Dar es Salaam</span></p>
        </div>
      </article>

      <article class="event-row event-row-more">
        <a class="event-thumb" href="<?= $baseUrl ?>/projects">
          <img src="<?= $baseUrl ?>/images/buhalahala.png" alt="School portal go-live briefing" loading="lazy">
        </a>
        <div class="event-body">
          <a class="event-title" href="<?= $baseUrl ?>/projects" data-i18n="event_4_title">SCHOOL PORTAL GO-LIVE BRIEFING</a>
          <p class="event-lead" data-i18n="event_4_desc">Walkthrough of admissions, results, and parent portals for schools rolling out new systems this term.</p>
          <p class="event-meta"><i class="fa-regular fa-clock" aria-hidden="true"></i><span data-i18n="event_4_when">Oct 20, 2026 10:00 - Oct 20, 2026 15:30</span></p>
          <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span data-i18n="event_4_where">Geita, Tanzania</span></p>
        </div>
      </article>

      <article class="event-row event-row-more">
        <a class="event-thumb" href="<?= $baseUrl ?>/contact">
          <img src="<?= $baseUrl ?>/images/agridata-smart.png" alt="WhatsApp consultation open hours" loading="lazy">
        </a>
        <div class="event-body">
          <a class="event-title" href="<?= $baseUrl ?>/contact" data-i18n="event_5_title">WHATSAPP CONSULTATION OPEN HOURS</a>
          <p class="event-lead" data-i18n="event_5_desc">Book a short call to discuss a website, school system, or office platform — send your brief on WhatsApp.</p>
          <p class="event-meta"><i class="fa-regular fa-clock" aria-hidden="true"></i><span data-i18n="event_5_when">Mon–Fri, 09:00 - 17:00</span></p>
          <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span data-i18n="event_5_where">Online · Tanzania</span></p>
        </div>
      </article>

      <a class="events-all-btn" href="<?= $baseUrl ?>/events" data-i18n="events_all">All events</a>
    </div>

    <div class="news-col">
      <h2 class="events-board-title" data-i18n="news_title">News</h2>
      <a class="news-date-item" href="<?= $baseUrl ?>/news">
        <div class="news-date">
          <strong>08</strong>
          <span><span data-i18n="wd_tue">Tue</span><br>Sep</span>
        </div>
        <span class="news-date-title" data-i18n="news_1_title">Digital Matrix Technology expands full-stack delivery</span>
      </a>
      <a class="news-date-item" href="<?= $baseUrl ?>/news">
        <div class="news-date">
          <strong>01</strong>
          <span><span data-i18n="wd_tue">Tue</span><br>Sep</span>
        </div>
        <span class="news-date-title" data-i18n="ann_2">New projects added to the portfolio (REACRIS, G4 Elevate)</span>
      </a>
      <a class="news-date-item" href="<?= $baseUrl ?>/news">
        <div class="news-date">
          <strong>15</strong>
          <span><span data-i18n="wd_sat">Sat</span><br>Aug</span>
        </div>
        <span class="news-date-title" data-i18n="ann_3">Services: Full stack development, hosting &amp; cloud deployment</span>
      </a>
      <a class="news-date-item" href="<?= $baseUrl ?>/news">
        <div class="news-date">
          <strong>01</strong>
          <span><span data-i18n="wd_sat">Sat</span><br>Aug</span>
        </div>
        <span class="news-date-title" data-i18n="ann_4">Support via WhatsApp: +255 715 296 092</span>
      </a>
      <a class="news-date-item" href="<?= $baseUrl ?>/news">
        <div class="news-date">
          <strong>28</strong>
          <span><span data-i18n="wd_fri">Fri</span><br>Aug</span>
        </div>
        <span class="news-date-title" data-i18n="news_3_title">Office, audit &amp; admissions systems built for teams</span>
      </a>
    </div>
  </div>
</section>
