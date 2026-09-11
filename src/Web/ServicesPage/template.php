<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services | Digital Matrix Technology</title>
  <meta name="description" content="Services from Digital Matrix Technology: websites, school and office systems, mobile apps, cloud hosting, and professional presentations in Tanzania.">
  <meta name="author" content="Steven Makarious">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <meta name="theme-color" content="#13548c">
  <link rel="canonical" href="https://makarious.legitconsult.co.tz/services">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Digital Matrix Technology">
  <meta property="og:locale" content="en_TZ">
  <meta property="og:url" content="https://makarious.legitconsult.co.tz/services">
  <meta property="og:title" content="Services | Digital Matrix Technology">
  <meta property="og:description" content="Services from Digital Matrix Technology: websites, school and office systems, mobile apps, cloud hosting, and professional presentations in Tanzania.">
  <meta name="twitter:title" content="Services | Digital Matrix Technology">
  <meta name="twitter:description" content="Services from Digital Matrix Technology: websites, school and office systems, mobile apps, cloud hosting, and professional presentations in Tanzania.">
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
      { "@type": "ListItem", "position": 2, "name": "Services", "item": "https://makarious.legitconsult.co.tz/services" }
    ]
  },
      {
        "@type": "CollectionPage",
        "url": "https://makarious.legitconsult.co.tz/services",
        "name": "Services",
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
          <h2 class="moh-doc-title" data-i18n="services_doc_title">Services and programmes</h2>
          <h3 data-i18n="doc_objective">Objective</h3>
          <p data-i18n="services_objective_p">To provide websites, management systems, and cloud applications that Tanzanian businesses, schools, and institutions can use in daily operations.</p>
          <h3 data-i18n="doc_functions">Functions</h3>
          <p class="moh-fn" id="svc-web" data-i18n="svc_web_p"><strong>Website development.</strong> Responsive sites for businesses, schools, and institutions — from design to live hosting.</p>
          <p class="moh-fn" id="svc-school" data-i18n="svc_school_p"><strong>School management systems.</strong> Admissions, results, and records portals for schools in Tanzania.</p>
          <p class="moh-fn" id="svc-office" data-i18n="svc_office_p"><strong>Business and office systems.</strong> Document workflows, staff communication, and audit-ready operations platforms.</p>
          <p class="moh-fn" id="svc-mobile" data-i18n="svc_mobile_p"><strong>Mobile applications.</strong> Android and iOS apps that extend a web system to phones.</p>
          <p class="moh-fn" id="svc-cloud" data-i18n="svc_cloud_p"><strong>Cloud services.</strong> Vercel, Render, and hosting pipelines — backups and go-live support.</p>
          <p class="moh-fn" id="svc-data" data-i18n="svc_data_p"><strong>Data, security and networking.</strong> Dashboards, hardening, and infrastructure support for production systems.</p>
          <p style="margin-top:22px"><a class="primary-btn" href="<?= $baseUrl ?>/contact" data-i18n="services_cta">Request a quote</a></p>
        </div>
        <?php
        $sidebarTitle = 'Services';
        $sidebarTitleI18n = 'sidebar_services';
        $sidebarLinks = [
            ['href' => '#svc-web', 'label' => 'Website Development', 'i18n' => 'svc_web'],
            ['href' => '#svc-school', 'label' => 'School Management Systems', 'i18n' => 'svc_school'],
            ['href' => '#svc-office', 'label' => 'Business And Office Systems', 'i18n' => 'svc_office'],
            ['href' => '#svc-mobile', 'label' => 'Mobile Applications', 'i18n' => 'svc_mobile'],
            ['href' => '#svc-cloud', 'label' => 'Cloud Services', 'i18n' => 'svc_cloud'],
            ['href' => '#svc-data', 'label' => 'Data, Security And Networking', 'i18n' => 'svc_data'],
            ['href' => $baseUrl . '/contact', 'label' => 'Request A Quote', 'i18n' => 'services_cta'],
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
