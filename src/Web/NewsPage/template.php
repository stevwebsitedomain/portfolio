<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News | Digital Matrix Technology</title>
  <meta name="description" content="News and announcements from Digital Matrix Technology in Tanzania — new systems, quotes, hosting, and project updates.">
  <meta name="author" content="Steven Makarious">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <meta name="theme-color" content="#13548c">
  <link rel="canonical" href="https://makarious.legitconsult.co.tz/news">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Digital Matrix Technology">
  <meta property="og:locale" content="en_TZ">
  <meta property="og:url" content="https://makarious.legitconsult.co.tz/news">
  <meta property="og:title" content="News | Digital Matrix Technology">
  <meta property="og:description" content="News and announcements from Digital Matrix Technology in Tanzania — new systems, quotes, hosting, and project updates.">
  <meta name="twitter:title" content="News | Digital Matrix Technology">
  <meta name="twitter:description" content="News and announcements from Digital Matrix Technology in Tanzania — new systems, quotes, hosting, and project updates.">
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
      { "@type": "ListItem", "position": 2, "name": "News", "item": "https://makarious.legitconsult.co.tz/news" }
    ]
  },
      {
        "@type": "CollectionPage",
        "url": "https://makarious.legitconsult.co.tz/news",
        "name": "News",
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
    <main class="page-content">
      <div class="container moh-split">
        <div class="moh-doc">
          <h2 class="moh-doc-title" data-i18n="news_doc_title">News and announcements</h2>
          <h3 id="news-1" data-i18n="news_1_title">Digital Matrix Technology expands full-stack delivery</h3>
          <p data-i18n="news_1_p">Websites, management systems, and cloud apps for businesses and institutions across Tanzania — from design to live deployment.</p>
          <h3 id="news-2" data-i18n="news_2_title">Request a quote on WhatsApp — +255 715 296 092</h3>
          <p data-i18n="news_2_p">Send your project idea, school system need, or website brief for scope, timeline, and cost.</p>
          <h3 id="news-3" data-i18n="news_3_title">Office, audit and admissions systems</h3>
          <p data-i18n="news_3_p">Document workflows, online applications, and staff portals that reduce paperwork.</p>
          <h3 id="news-4" data-i18n="news_4_title">Cloud hosting and secure deployment</h3>
          <p data-i18n="news_4_p">From shared hosting to modern cloud platforms — go-live, backups, and production support.</p>
        </div>
        <?php
        $sidebarTitle = 'Updates';
        $sidebarTitleI18n = 'sidebar_updates';
        $sidebarLinks = [
            ['href' => '#news-1', 'label' => 'Full-Stack Delivery', 'i18n' => 'news_side_1'],
            ['href' => '#news-2', 'label' => 'Request A Quote On WhatsApp', 'i18n' => 'news_side_2'],
            ['href' => '#news-3', 'label' => 'Office And Admissions Systems', 'i18n' => 'news_side_3'],
            ['href' => '#news-4', 'label' => 'Cloud Hosting And Deployment', 'i18n' => 'news_side_4'],
            ['href' => $baseUrl . '/projects', 'label' => 'Projects', 'i18n' => 'nav_projects'],
            ['href' => $baseUrl . '/events', 'label' => 'Events', 'i18n' => 'nav_events'],
            ['href' => $baseUrl . '/contact', 'label' => 'Contact', 'i18n' => 'nav_contact'],
        ];
        require dirname(__DIR__) . '/Shared/page-sidebar.php';
        ?>
      </div>
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
  <script src="<?= $baseUrl ?>/js/i18n.js?v=13"></script>
</body>
</html>
