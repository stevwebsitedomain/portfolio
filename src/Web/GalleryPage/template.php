<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery | Digital Matrix Technology</title>
  <meta name="description" content="Client and project gallery for Digital Matrix Technology in Tanzania — school portals, company sites, and live systems.">
  <meta name="author" content="Steven Makarious">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <meta name="theme-color" content="#13548c">
  <link rel="canonical" href="https://makarious.legitconsult.co.tz/gallery">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Digital Matrix Technology">
  <meta property="og:locale" content="en_TZ">
  <meta property="og:url" content="https://makarious.legitconsult.co.tz/gallery">
  <meta property="og:title" content="Gallery | Digital Matrix Technology">
  <meta property="og:description" content="Client and project gallery for Digital Matrix Technology in Tanzania — school portals, company sites, and live systems.">
  <meta name="twitter:title" content="Gallery | Digital Matrix Technology">
  <meta name="twitter:description" content="Client and project gallery for Digital Matrix Technology in Tanzania — school portals, company sites, and live systems.">
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
      { "@type": "ListItem", "position": 2, "name": "Gallery", "item": "https://makarious.legitconsult.co.tz/gallery" }
    ]
  },
      {
        "@type": "CollectionPage",
        "url": "https://makarious.legitconsult.co.tz/gallery",
        "name": "Gallery",
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
      <div class="container">
        <header class="page-intro">
          <h1>Gallery</h1>
          <p>Logos and work samples from public client systems. Office photos can be added for Google Business Profile.</p>
        </header>
        <div class="gallery-grid">
          <figure><img src="<?= $baseUrl ?>/images/profile.png" alt="Steven Makarious, Full Stack Developer"><figcaption>Steven Makarious</figcaption></figure>
          <figure><img src="<?= $baseUrl ?>/images/DIGITAL MATRIX TECHNOLOGY.png" alt="Digital Matrix Technology brand mark"><figcaption>Digital Matrix Technology</figcaption></figure>
          <a href="https://whitelakeschoolportal.co.tz" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/whitelake.png" alt="White Lake High School portal"><figcaption>White Lake</figcaption></figure></a>
          <a href="https://aoa.aquinasschool.sc.tz" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/aquinas.png" alt="Aquinas Secondary School admissions"><figcaption>Aquinas</figcaption></figure></a>
          <a href="http://buhalahalasecondaryschool.com/" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/buhalahala.png" alt="Buhalahala Secondary School website"><figcaption>Buhalahala</figcaption></figure></a>
          <a href="http://reacris.co.tz/" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/reacris.png" alt="REACRIS e-commerce"><figcaption>REACRIS</figcaption></figure></a>
          <a href="https://agridata.co.tz" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/agridata-smart.png" alt="AGRIDATA SMART farming platform"><figcaption>AGRIDATA</figcaption></figure></a>
          <a href="http://g4elevate.co.tz/" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/g4elevate.png" alt="G4 Elevate travel website"><figcaption>G4 Elevate</figcaption></figure></a>
          <a href="https://miracletechgroup.com" target="_blank" rel="noopener"><figure><img src="<?= $baseUrl ?>/images/miracletech.png" alt="Miracle Tech company website"><figcaption>Miracle Tech</figcaption></figure></a>
        </div>
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
  <script src="<?= $baseUrl ?>/js/i18n.js?v=10"></script>
</body>
</html>
