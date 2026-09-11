<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projects | Digital Matrix Technology</title>
  <meta name="description" content="Live projects by Digital Matrix Technology in Tanzania: school portals, office systems, e-commerce, travel, and agriculture platforms.">
  <meta name="author" content="Steven Makarious">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <meta name="theme-color" content="#13548c">
  <link rel="canonical" href="https://makarious.legitconsult.co.tz/projects">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Digital Matrix Technology">
  <meta property="og:locale" content="en_TZ">
  <meta property="og:url" content="https://makarious.legitconsult.co.tz/projects">
  <meta property="og:title" content="Projects | Digital Matrix Technology">
  <meta property="og:description" content="Live projects by Digital Matrix Technology in Tanzania: school portals, office systems, e-commerce, travel, and agriculture platforms.">
  <meta name="twitter:title" content="Projects | Digital Matrix Technology">
  <meta name="twitter:description" content="Live projects by Digital Matrix Technology in Tanzania: school portals, office systems, e-commerce, travel, and agriculture platforms.">
  <?php require dirname(__DIR__) . '/Shared/google-head.php'; ?>
  <script src="<?= $baseUrl ?>/js/seo-config.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Montserrat:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="<?= $baseUrl ?>/css/gov-theme.css?v=14">
  <link rel="stylesheet" href="<?= $baseUrl ?>/css/moh-layout.css?v=52">
  <script>try{var __l=localStorage.getItem('site-lang');if(__l==='sw'||__l==='en')document.documentElement.lang=__l;else document.documentElement.lang='en';}catch(e){}</script>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
  {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://makarious.legitconsult.co.tz/" },
      { "@type": "ListItem", "position": 2, "name": "Projects", "item": "https://makarious.legitconsult.co.tz/projects" }
    ]
  },
      {
        "@type": "CollectionPage",
        "url": "https://makarious.legitconsult.co.tz/projects",
        "name": "Projects",
        "isPartOf": { "@id": "https://makarious.legitconsult.co.tz/#website" }
      }
    ]
  }
  </script>
</head>
<body>
  <header class="site-header">
    <div class="utility topbar">
      <div class="header-container topbar-row">
        <a class="welcome" href="<?= $baseUrl ?>/contact" data-i18n="welcome_talk">Talk To Steven Makarious</a>
        <form class="header-search" id="headerSearchForm" role="search">
          <label class="sr-only" for="headerSearch">Search</label>
          <input id="headerSearch" type="search" placeholder="Search Here" data-i18n="search_here">
          <button type="submit" id="openSearch" data-i18n-aria="search_aria" aria-label="Open search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <nav class="social-links" aria-label="Social links">
          <a href="https://wa.me/255715296092" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="mailto:stevenabalwambo@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
        </nav>
        <div class="language-wrap">
          <label class="sr-only" for="language">Language</label>
          <select class="language-select" id="language">
            <option value="en">English</option>
            <option value="sw">Kiswahili</option>
          </select>
        </div>
      </div>
    </div>
    <div class="identity brand-header">
      <div class="brand-side brand-side-left" aria-hidden="true">
        <img src="<?= $baseUrl ?>/assets/images/banner-left-coder.jpg" alt="">
      </div>
      <div class="brand-side brand-side-right" aria-hidden="true">
        <img src="<?= $baseUrl ?>/assets/images/banner-right-team.jpg" alt="">
      </div>
      <div class="header-container brand-row">
        <a href="<?= $baseUrl ?>/" class="logo-wrap"><img class="emblem" src="<?= $baseUrl ?>/images/DIGITAL%20MATRIX%20TECHNOLOGY.png" alt="Digital Matrix Technology logo"></a>
        <div class="brand-copy titles">
          <p class="republic">Digital Matrix Technology</p>
          <p class="h1-like">Steven Makarious</p>
        </div>
        <span aria-hidden="true"></span>
      </div>
    </div>
    <nav class="main-nav" aria-label="Main menu">
      <div class="header-container nav-row">
        <ul class="nav-list" id="navList">
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/" data-i18n="nav_home">Home</a></li>
          <li class="nav-item">
            <button class="nav-link submenu-toggle" type="button"><span data-i18n="nav_about">About</span> <i class="fa-solid fa-chevron-down"></i></button>
            <ul class="dropdown">
              <li><a href="<?= $baseUrl ?>/about" data-i18n="nav_history">History</a></li>
              <li><a href="about.html#dira" data-i18n="nav_vision">Vision</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/services" data-i18n="nav_services">Services</a></li>
          <li class="nav-item">
            <button class="nav-link submenu-toggle" type="button"><span data-i18n="nav_projects">Projects</span> <i class="fa-solid fa-chevron-down"></i></button>
            <ul class="dropdown">
              <li><a href="<?= $baseUrl ?>/news" data-i18n="portal_news">Latest Projects</a></li>
              <li><a href="<?= $baseUrl ?>/projects" data-i18n="nav_projects">All Projects</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/news" data-i18n="portal_docs">Publications</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/events" data-i18n="nav_events">Events</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/qualifications" data-i18n="nav_qualifications">Qualifications</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/contact" data-i18n="nav_contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
          <button class="round-btn text-size" id="textSize" data-i18n-title="text_size" title="Change text size" type="button"><i class="fa-solid fa-text-height"></i></button>
          <button class="round-btn" id="themeToggle" data-i18n-title="theme" title="Toggle theme" type="button"><i class="fa-solid fa-moon"></i></button>
          <button class="menu-btn" id="menuBtn" data-i18n-aria="menu_open" aria-label="Open menu" type="button"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </nav>
  </header>
    <main class="page-content projects-page">
      <h1 class="sr-only">Projects</h1>
      <section class="events-board">
        <div class="container">
          <h2 class="events-board-title" data-i18n="projects_title">Projects</h2>
<?php
$projectItems = [
  [
    'url' => 'https://dda-tra.free.nf',
    'img' => '/images/tra.jpg',
    'alt' => 'Tanzania Revenue Authority',
    'title' => 'TANZANIA REVENUE AUTHORITY (TRA)',
    'descKey' => 'proj_tra',
    'desc' => 'Tax-related web system with data handling, scraping support, and database workflows.',
    'when' => 'Posted On: 2025 – 2026',
    'where' => 'Live system',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => 'https://audit.plustax.co.tz/',
    'img' => '/images/plustax.jpg',
    'alt' => 'Plustax Associates',
    'title' => 'PLUSTAX ASSOCIATES',
    'descKey' => 'proj_plustax',
    'desc' => 'Office management system for documents, staff communication, and audit workflows.',
    'when' => 'Posted On: 2025 – 2026',
    'where' => 'Live system',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => 'https://whitelakeschoolportal.co.tz',
    'img' => '/images/whitelake.png',
    'alt' => 'White Lake High School',
    'title' => 'WHITE LAKE HIGH SCHOOL',
    'descKey' => 'proj_whitelake',
    'desc' => 'Student results and school management portal for White Lake High School.',
    'when' => 'Posted On: 03 Jun 2026',
    'where' => 'Live portal',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => 'http://reacris.co.tz/',
    'img' => '/images/reacris.png',
    'alt' => 'REACRIS LTD',
    'title' => 'REACRIS LTD',
    'descKey' => 'proj_reacris',
    'desc' => 'Luxury spirits e-commerce platform — online sales, product listings, and customer contact.',
    'when' => 'Posted On: 08 Sep 2026',
    'where' => 'Live website',
    'new' => true,
    'external' => true,
  ],
  [
    'url' => 'http://g4elevate.co.tz/',
    'img' => '/images/g4elevate.png',
    'alt' => 'G4 Elevate',
    'title' => 'G4 ELEVATE TRAVEL & TOURS',
    'descKey' => 'proj_g4',
    'desc' => 'Travel agency website for flights, safaris, and bookings for local and international clients.',
    'when' => 'Posted On: 05 Sep 2026',
    'where' => 'Live website',
    'new' => true,
    'external' => true,
  ],
  [
    'url' => 'http://buhalahalasecondaryschool.com/',
    'img' => '/images/buhalahala.png',
    'alt' => 'Buhalahala Secondary School',
    'title' => 'BUHALAHALA SECONDARY SCHOOL',
    'descKey' => 'proj_buhalahala',
    'desc' => 'School website and online admissions portal for students and parents in Geita.',
    'when' => 'Posted On: 01 Sep 2026',
    'where' => 'Geita, Tanzania',
    'new' => true,
    'external' => true,
  ],
  [
    'url' => 'https://aoa.aquinasschool.sc.tz',
    'img' => '/images/aquinas.png',
    'alt' => 'Aquinas Secondary School',
    'title' => 'AQUINAS SECONDARY SCHOOL',
    'descKey' => 'proj_aquinas',
    'desc' => 'Online application system for admissions — easier for parents, students, and school staff.',
    'when' => 'Posted On: 2026',
    'where' => 'Live admissions',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => 'https://agridata.co.tz',
    'img' => '/images/agridata-smart.png',
    'alt' => 'AGRIDATA SMART',
    'title' => 'AGRIDATA SMART',
    'descKey' => 'proj_agridata',
    'desc' => 'Smart farming and agri-data platform for farmers and agriculture stakeholders.',
    'when' => 'Posted On: 20 Aug 2026',
    'where' => 'Live website',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => 'https://miracletechgroup.com',
    'img' => '/images/miracletech.png',
    'alt' => 'Miracle Tech Group',
    'title' => 'MIRACLE TECH GROUP',
    'descKey' => 'proj_miracle',
    'desc' => 'Company website showcasing services, portfolio, and contact for Miracle Tech.',
    'when' => 'Posted On: 12 Jul 2026',
    'where' => 'Live website',
    'new' => false,
    'external' => true,
  ],
  [
    'url' => $baseUrl . '/contact',
    'img' => '/images/eastc.png',
    'alt' => 'EASTC',
    'title' => 'EASTC',
    'descKey' => 'proj_eastc',
    'desc' => 'Institutional management system for records, workflows, and administrative operations.',
    'when' => 'Posted On: 2026',
    'where' => 'Available on request',
    'new' => false,
    'external' => false,
  ],
];
foreach ($projectItems as $item):
  $href = $item['url'];
  $ext = !empty($item['external']);
?>
          <article class="event-row">
            <a class="event-thumb" href="<?= htmlspecialchars($href, ENT_QUOTES) ?>"<?= $ext ? ' target="_blank" rel="noopener"' : '' ?>>
              <img src="<?= $baseUrl . $item['img'] ?>" alt="<?= htmlspecialchars($item['alt'], ENT_QUOTES) ?>" loading="lazy">
              <?php if (!empty($item['new'])): ?><span class="card-new">NEW</span><?php endif; ?>
            </a>
            <div class="event-body">
              <a class="event-title" href="<?= htmlspecialchars($href, ENT_QUOTES) ?>"<?= $ext ? ' target="_blank" rel="noopener"' : '' ?>><?= htmlspecialchars($item['title']) ?></a>
              <p class="event-lead" data-i18n="<?= htmlspecialchars($item['descKey'], ENT_QUOTES) ?>"><?= htmlspecialchars($item['desc']) ?></p>
              <p class="event-meta"><i class="fa-regular fa-calendar" aria-hidden="true"></i><span><?= htmlspecialchars($item['when']) ?></span></p>
              <p class="event-meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span><?= htmlspecialchars($item['where']) ?></span></p>
            </div>
          </article>
<?php endforeach; ?>
          <a class="events-all-btn" href="<?= $baseUrl ?>/contact">Start a project</a>
        </div>
      </section>
    </main>
  <?php require dirname(__DIR__) . '/Shared/site-footer.php'; ?>
  <div class="modal" id="searchModal" role="dialog" aria-modal="true" aria-labelledby="searchTitle">
    <div class="search-dialog">
      <div class="search-dialog-head">
        <h3 id="searchTitle" data-i18n="search_title">Search this site</h3>
        <button class="close-search" id="closeSearch" data-i18n-aria="search_close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <form class="search-field" onsubmit="event.preventDefault(); var q=(document.getElementById('siteSearchInput').value||'').toLowerCase(); if(/mradi|project/.test(q))location.href='projects.html'; else if(/stadi|skill|qual/.test(q))location.href='qualifications.html'; else if(/contact|wasiliana|phone/.test(q))location.href='contact.html'; else if(/service|huduma/.test(q))location.href='services.html'; else if(/news|habari/.test(q))location.href='news.html'; else location.href='about.html';">
        <input id="siteSearchInput" type="search" data-i18n="search_input" placeholder="Type what you are looking for...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>
  <button class="to-top" id="toTop" data-i18n-aria="to_top" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>
  <script>window.PORTFOLIO_BASE = <?= json_encode($baseUrl, JSON_UNESCAPED_SLASHES) ?>;</script>
  <script src="<?= $baseUrl ?>/js/config.js"></script>
  <script src="<?= $baseUrl ?>/js/contact-form.js"></script>
  <script src="<?= $baseUrl ?>/js/gov-theme.js?v=6"></script>
  <script src="<?= $baseUrl ?>/js/i18n.js?v=10"></script>
</body>
</html>
