"""Generate crawlable public pages for Google sitelinks (same chrome as the homepage)."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "portfolio-frontend"
SITE = "https://makarious.legitconsult.co.tz"

HEAD_ASSETS = """  <link rel="icon" href="favicon.ico" sizes="any">
  <link rel="icon" type="image/png" href="images/favicon.png" sizes="32x32">
  <link rel="icon" type="image/png" href="images/favicon.png" sizes="192x192">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" sizes="180x180">
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="manifest" href="site.webmanifest">
  <script src="js/seo-config.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Montserrat:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/gov-theme.css?v=6">
  <link rel="stylesheet" href="css/moh-layout.css?v=18">
  <script>try{var __l=localStorage.getItem('site-lang');if(__l==='sw'||__l==='en')document.documentElement.lang=__l;else document.documentElement.lang='en';}catch(e){}</script>
"""

CHROME_TOP = """  <header class="site-header">
    <div class="utility topbar">
      <div class="header-container topbar-row">
        <a class="welcome" href="contact.html" data-i18n="welcome_talk">Talk To Steven Makarious</a>
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
        <img src="assets/images/banner-left-coder.jpg" alt="">
      </div>
      <div class="brand-side brand-side-right" aria-hidden="true">
        <img src="assets/images/banner-right-team.jpg" alt="">
      </div>
      <div class="header-container brand-row">
        <a href="index.html" class="logo-wrap"><img class="emblem" src="images/DIGITAL%20MATRIX%20TECHNOLOGY.png" alt="Digital Matrix Technology logo"></a>
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
          <li class="nav-item"><a class="nav-link" href="index.html" data-i18n="nav_home">Home</a></li>
          <li class="nav-item">
            <button class="nav-link submenu-toggle" type="button"><span data-i18n="nav_about">About</span> <i class="fa-solid fa-chevron-down"></i></button>
            <ul class="dropdown">
              <li><a href="about.html" data-i18n="nav_history">History</a></li>
              <li><a href="about.html#dira" data-i18n="nav_vision">Vision</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="services.html" data-i18n="nav_services">Services</a></li>
          <li class="nav-item">
            <button class="nav-link submenu-toggle" type="button"><span data-i18n="nav_projects">Projects</span> <i class="fa-solid fa-chevron-down"></i></button>
            <ul class="dropdown">
              <li><a href="news.html" data-i18n="portal_news">Latest Projects</a></li>
              <li><a href="projects.html" data-i18n="nav_projects">All Projects</a></li>
              <li><a href="gallery.html" data-i18n="nav_gallery">Gallery</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="news.html" data-i18n="portal_docs">Publications</a></li>
          <li class="nav-item"><a class="nav-link" href="qualifications.html" data-i18n="nav_qualifications">Qualifications</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html" data-i18n="nav_contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
          <button class="round-btn text-size" id="textSize" data-i18n-title="text_size" title="Change text size" type="button"><i class="fa-solid fa-text-height"></i></button>
          <button class="round-btn" id="themeToggle" data-i18n-title="theme" title="Toggle theme" type="button"><i class="fa-solid fa-moon"></i></button>
          <button class="menu-btn" id="menuBtn" data-i18n-aria="menu_open" aria-label="Open menu" type="button"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </nav>
  </header>
"""

CHROME_BOTTOM = """  <footer id="footer">
    <div class="container footer-top">
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
          <li><a href="index.html">› Home</a></li>
          <li><a href="about.html">› About</a></li>
          <li><a href="services.html">› Services</a></li>
          <li><a href="projects.html">› Projects</a></li>
          <li><a href="news.html">› News</a></li>
          <li><a href="gallery.html">› Gallery</a></li>
          <li><a href="contact.html">› Contact</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3 data-i18n="footer_contact">Contact Us</h3>
        <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span>Digital Matrix Technology<br>Tanzania</span></div>
        <div class="contact-line"><i class="fa-solid fa-envelope"></i><span>stevenabalwambo@gmail.com</span></div>
        <div class="contact-line"><i class="fa-brands fa-whatsapp"></i><span>+255 715 296 092</span></div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container footer-bottom-row">
        <p>© <span id="year"></span> <span data-i18n="footer_copy">Steven Makarious · Digital Matrix Technology. All rights reserved.</span></p>
        <div class="footer-bottom-links">
          <a href="about.html" data-i18n="footer_about">About</a>
          <a href="contact.html" data-i18n="footer_contact_link">Contact</a>
          <a href="sitemap.xml" data-i18n="footer_map">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>
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
  <script src="js/config.js"></script>
  <script src="js/contact-form.js?v=8"></script>
  <script src="js/gov-theme.js?v=6"></script>
  <script src="js/i18n.js?v=7"></script>
</body>
</html>
"""


def breadcrumb_ld(page_name, page_path):
    return f"""  {{
    "@type": "BreadcrumbList",
    "itemListElement": [
      {{ "@type": "ListItem", "position": 1, "name": "Home", "item": "{SITE}/" }},
      {{ "@type": "ListItem", "position": 2, "name": "{page_name}", "item": "{SITE}/{page_path}" }}
    ]
  }}"""


def page_head(title, description, path, extra_ld):
    url = f"{SITE}/{path}" if path else f"{SITE}/"
    return f"""<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{title}</title>
  <meta name="description" content="{description}">
  <meta name="author" content="Steven Makarious">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <meta name="theme-color" content="#20659f">
  <link rel="canonical" href="{url}">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Digital Matrix Technology">
  <meta property="og:locale" content="en_TZ">
  <meta property="og:url" content="{url}">
  <meta property="og:title" content="{title}">
  <meta property="og:description" content="{description}">
  <meta property="og:image" content="{SITE}/images/profile.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{title}">
  <meta name="twitter:description" content="{description}">
  <meta name="twitter:image" content="{SITE}/images/profile.png">
{HEAD_ASSETS}
  <script type="application/ld+json">
  {{
    "@context": "https://schema.org",
    "@graph": [
{extra_ld}
    ]
  }}
  </script>
</head>
<body>
"""


def banner(crumbs, h1, lead):
    crumb_html = " ".join(
        f'<a href="{href}">{label}</a> <span aria-hidden="true">/</span>' if href else f"<span>{label}</span>"
        for label, href in crumbs[:-1]
    )
    last = crumbs[-1][0]
    return f"""    <section class="page-banner">
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">{crumb_html} {last}</nav>
        <h1>{h1}</h1>
        <p>{lead}</p>
      </div>
    </section>
"""


PAGES = []

PAGES.append(
    (
        "about.html",
        page_head(
            "About | Digital Matrix Technology",
            "About Digital Matrix Technology in Tanzania — Steven Makarious builds websites, school and office systems, and cloud apps for organizations.",
            "about",
            breadcrumb_ld("About", "about")
            + """,
      {
        "@type": "AboutPage",
        "@id": "%s/about#page",
        "url": "%s/about",
        "name": "About Digital Matrix Technology",
        "isPartOf": { "@id": "%s/#website" },
        "about": { "@id": "%s/#organization" }
      }"""
            % (SITE, SITE, SITE, SITE),
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("About", None)],
            "About Digital Matrix Technology",
            "History, vision, and how Steven Makarious delivers systems for Tanzanian organizations.",
        )
        + """    <main class="page-content">
      <div class="container page-prose">
        <article id="historia">
          <h2>History</h2>
          <p>Steven Makarious is a Full Stack Developer in Tanzania who builds websites, management systems, and cloud applications for businesses and institutions. Through Digital Matrix Technology, he delivers end-to-end solutions — from design and databases to backend, reporting, and live deployment.</p>
          <p>Work includes school portals, office and audit systems, e-commerce, travel sites, and agriculture platforms. The approach is practical: a live system that staff and customers can use, with hosting and support after launch.</p>
        </article>
        <article id="dira">
          <h2>Vision</h2>
          <p>To empower Tanzanian clients with reliable, easy-to-use digital systems that can grow — so they can run operations, serve customers online, and improve workplace efficiency.</p>
        </article>
        <p><a class="primary-btn" href="contact.html">Contact the team</a></p>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "services.html",
        page_head(
            "Services | Digital Matrix Technology",
            "Services from Digital Matrix Technology: websites, school and office systems, mobile apps, cloud hosting, and professional presentations in Tanzania.",
            "services",
            breadcrumb_ld("Services", "services")
            + f""",
      {{
        "@type": "CollectionPage",
        "url": "{SITE}/services",
        "name": "Services",
        "isPartOf": {{ "@id": "{SITE}/#website" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("Services", None)],
            "Services &amp; programmes",
            "Public systems and websites — not private staff dashboards.",
        )
        + """    <main class="page-content">
      <div class="container">
        <div class="page-grid">
          <article class="page-card"><h3>Website development</h3><p>Responsive sites for businesses, schools, and institutions — from design to live hosting.</p></article>
          <article class="page-card"><h3>School management systems</h3><p>Admissions, results, and records portals for schools in Tanzania.</p></article>
          <article class="page-card"><h3>Business &amp; office systems</h3><p>Document workflows, staff communication, and audit-ready operations platforms.</p></article>
          <article class="page-card"><h3>Mobile applications</h3><p>Android and iOS apps that extend a web system to phones.</p></article>
          <article class="page-card"><h3>Cloud services</h3><p>Vercel, Render, and hosting pipelines — backups and go-live support.</p></article>
          <article class="page-card"><h3>Data, security &amp; networking</h3><p>Dashboards, hardening, and infrastructure support for production systems.</p></article>
        </div>
        <p style="margin-top:28px"><a class="primary-btn" href="contact.html">Request a quote</a></p>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "projects.html",
        page_head(
            "Projects | Digital Matrix Technology",
            "Live projects by Digital Matrix Technology in Tanzania: school portals, office systems, e-commerce, travel, and agriculture platforms.",
            "projects",
            breadcrumb_ld("Projects", "projects")
            + f""",
      {{
        "@type": "CollectionPage",
        "url": "{SITE}/projects",
        "name": "Projects",
        "isPartOf": {{ "@id": "{SITE}/#website" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("Projects", None)],
            "Projects",
            "Selected live systems and websites delivered for clients in Tanzania.",
        )
        + """    <main class="page-content">
      <div class="container page-prose">
        <ul>
          <li><a href="https://whitelakeschoolportal.co.tz" rel="noopener" target="_blank">White Lake High School</a> — student results and school management portal.</li>
          <li><a href="https://aoa.aquinasschool.sc.tz" rel="noopener" target="_blank">Aquinas Secondary School</a> — online admissions for parents and students.</li>
          <li><a href="http://buhalahalasecondaryschool.com/" rel="noopener" target="_blank">Buhalahala Secondary School</a> — school website and admissions.</li>
          <li><a href="http://reacris.co.tz/" rel="noopener" target="_blank">REACRIS</a> — luxury spirits e-commerce.</li>
          <li><a href="http://g4elevate.co.tz/" rel="noopener" target="_blank">G4 Elevate</a> — travel and bookings.</li>
          <li><a href="https://agridata.co.tz" rel="noopener" target="_blank">AGRIDATA SMART</a> — farm records and agri analytics.</li>
          <li><a href="https://audit.plustax.co.tz/" rel="noopener" target="_blank">Plustax Associates</a> — office documents and staff communication.</li>
          <li><a href="https://miracletechgroup.com" rel="noopener" target="_blank">Miracle Tech</a> — company website.</li>
          <li><a href="https://dda-tra.free.nf" rel="noopener" target="_blank">TRA-related web system</a> — data handling workflows.</li>
        </ul>
        <p>EASTC institutional management work is available on request via the contact page.</p>
        <p><a class="primary-btn" href="contact.html">Start a project</a></p>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "news.html",
        page_head(
            "News | Digital Matrix Technology",
            "News and announcements from Digital Matrix Technology in Tanzania — new systems, quotes, hosting, and project updates.",
            "news",
            breadcrumb_ld("News", "news")
            + f""",
      {{
        "@type": "CollectionPage",
        "url": "{SITE}/news",
        "name": "News",
        "isPartOf": {{ "@id": "{SITE}/#website" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("News", None)],
            "News &amp; announcements",
            "Public updates about systems, websites, and how to request a quote.",
        )
        + """    <main class="page-content">
      <div class="container page-prose">
        <article class="page-card" style="margin-bottom:16px">
          <h2>Digital Matrix Technology expands full-stack delivery</h2>
          <p>Websites, management systems, and cloud apps for businesses and institutions across Tanzania — from design to live deployment.</p>
        </article>
        <article class="page-card" style="margin-bottom:16px">
          <h2>Request a quote on WhatsApp — +255 715 296 092</h2>
          <p>Send your project idea, school system need, or website brief for scope, timeline, and cost.</p>
        </article>
        <article class="page-card" style="margin-bottom:16px">
          <h2>Office, audit &amp; admissions systems</h2>
          <p>Document workflows, online applications, and staff portals that reduce paperwork.</p>
        </article>
        <article class="page-card">
          <h2>Cloud hosting &amp; secure deployment</h2>
          <p>From shared hosting to modern cloud platforms — go-live, backups, and production support.</p>
        </article>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "qualifications.html",
        page_head(
            "Qualifications | Digital Matrix Technology",
            "Qualifications of Steven Makarious at Digital Matrix Technology: cloud computing, websites, PHP/MySQL backends, frontend, and hosting in Tanzania.",
            "qualifications",
            breadcrumb_ld("Qualifications", "qualifications")
            + f""",
      {{
        "@type": "ProfilePage",
        "url": "{SITE}/qualifications",
        "name": "Qualifications",
        "mainEntity": {{ "@id": "{SITE}/#person" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("Qualifications", None)],
            "Qualifications",
            "Education and delivery skills behind Digital Matrix Technology systems.",
        )
        + """    <main class="page-content">
      <div class="container">
        <div class="page-grid">
          <article class="page-card"><h3>Cloud Computing</h3><p>Infrastructure, deployment, and distributed systems for live applications.</p></article>
          <article class="page-card"><h3>Website Development</h3><p>Responsive professional websites for organizations across Tanzania.</p></article>
          <article class="page-card"><h3>Backend Development</h3><p>PHP, Yii2, MySQL, authentication, and REST APIs.</p></article>
          <article class="page-card"><h3>Frontend Development</h3><p>HTML, CSS, and JavaScript for clear, usable interfaces.</p></article>
          <article class="page-card"><h3>Hosting &amp; Deployment</h3><p>Vercel, Render, and shared hosting — from build to production.</p></article>
          <article class="page-card"><h3>Database Management</h3><p>MySQL design, queries, and reporting for real-world web apps.</p></article>
        </div>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "gallery.html",
        page_head(
            "Gallery | Digital Matrix Technology",
            "Client and project gallery for Digital Matrix Technology in Tanzania — school portals, company sites, and live systems.",
            "gallery",
            breadcrumb_ld("Gallery", "gallery")
            + f""",
      {{
        "@type": "CollectionPage",
        "url": "{SITE}/gallery",
        "name": "Gallery",
        "isPartOf": {{ "@id": "{SITE}/#website" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("Gallery", None)],
            "Gallery",
            "Logos and work samples from public client systems. Office photos can be added for Google Business Profile.",
        )
        + """    <main class="page-content">
      <div class="container">
        <div class="gallery-grid">
          <figure><img src="images/profile.png" alt="Steven Makarious, Full Stack Developer"><figcaption>Steven Makarious</figcaption></figure>
          <figure><img src="images/DIGITAL MATRIX TECHNOLOGY.png" alt="Digital Matrix Technology brand mark"><figcaption>Digital Matrix Technology</figcaption></figure>
          <a href="https://whitelakeschoolportal.co.tz" target="_blank" rel="noopener"><figure><img src="images/whitelake.png" alt="White Lake High School portal"><figcaption>White Lake</figcaption></figure></a>
          <a href="https://aoa.aquinasschool.sc.tz" target="_blank" rel="noopener"><figure><img src="images/aquinas.png" alt="Aquinas Secondary School admissions"><figcaption>Aquinas</figcaption></figure></a>
          <a href="http://buhalahalasecondaryschool.com/" target="_blank" rel="noopener"><figure><img src="images/buhalahala.png" alt="Buhalahala Secondary School website"><figcaption>Buhalahala</figcaption></figure></a>
          <a href="http://reacris.co.tz/" target="_blank" rel="noopener"><figure><img src="images/reacris.png" alt="REACRIS e-commerce"><figcaption>REACRIS</figcaption></figure></a>
          <a href="https://agridata.co.tz" target="_blank" rel="noopener"><figure><img src="images/agridata-smart.png" alt="AGRIDATA SMART farming platform"><figcaption>AGRIDATA</figcaption></figure></a>
          <a href="http://g4elevate.co.tz/" target="_blank" rel="noopener"><figure><img src="images/g4elevate.png" alt="G4 Elevate travel website"><figcaption>G4 Elevate</figcaption></figure></a>
          <a href="https://miracletechgroup.com" target="_blank" rel="noopener"><figure><img src="images/miracletech.png" alt="Miracle Tech company website"><figcaption>Miracle Tech</figcaption></figure></a>
        </div>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)

PAGES.append(
    (
        "contact.html",
        page_head(
            "Contact | Digital Matrix Technology",
            "Contact Digital Matrix Technology in Tanzania: +255 715 296 092, stevenabalwambo@gmail.com, WhatsApp. Request a website or system quote.",
            "contact",
            breadcrumb_ld("Contact", "contact")
            + f""",
      {{
        "@type": "ContactPage",
        "url": "{SITE}/contact",
        "name": "Contact",
        "mainEntity": {{ "@id": "{SITE}/#organization" }}
      }}""",
        )
        + CHROME_TOP
        + banner(
            [("Home", "index.html"), ("Contact", None)],
            "Contact",
            "Same name, phone, and email as the public listing — Digital Matrix Technology, Tanzania.",
        )
        + """    <main class="page-content">
      <div class="container">
        <div class="contact-layout">
          <aside class="contact-info-card">
            <h2>Digital Matrix Technology</h2>
            <p class="contact-note" data-i18n="contact_note">I receive form messages on WhatsApp and SMS. Choose how you want your request delivered.</p>
            <div class="contact-line"><i class="fa-solid fa-user"></i><span>Steven Makarious</span></div>
            <div class="contact-line"><i class="fa-solid fa-envelope"></i><span><a href="mailto:stevenabalwambo@gmail.com">stevenabalwambo@gmail.com</a></span></div>
            <div class="contact-line"><i class="fa-brands fa-whatsapp"></i><span><a href="https://wa.me/255715296092" target="_blank" rel="noopener">WhatsApp +255 715 296 092</a></span></div>
            <div class="contact-line"><i class="fa-solid fa-comment-sms"></i><span><a href="sms:+255622045972">SMS +255 622 045 972</a></span></div>
            <div class="contact-line"><i class="fa-solid fa-phone"></i><span><a href="tel:+255715296092">Call +255 715 296 092</a></span></div>
            <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span>Tanzania</span></div>
            <a class="wa-direct" href="https://wa.me/255715296092" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> <span data-i18n="chat_whatsapp">Chat on WhatsApp</span></a>
          </aside>
          <form class="php-email-form" novalidate>
            <p class="form-lead" data-i18n="form_lead">Fill the form below. Your message will be delivered to Steven on WhatsApp, SMS, or both.</p>
            <div class="channel-row" role="radiogroup" aria-label="Send via">
              <label class="channel-pick">
                <input type="radio" name="channel" value="whatsapp">
                <span><i class="fa-brands fa-whatsapp"></i> <em data-i18n="via_whatsapp">WhatsApp</em></span>
              </label>
              <label class="channel-pick">
                <input type="radio" name="channel" value="sms">
                <span><i class="fa-solid fa-comment-sms"></i> <em data-i18n="via_sms">SMS</em></span>
              </label>
              <label class="channel-pick">
                <input type="radio" name="channel" value="both" checked>
                <span><i class="fa-solid fa-paper-plane"></i> <em data-i18n="via_both">Both</em></span>
              </label>
            </div>
            <div class="hp-field" aria-hidden="true">
              <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            </div>
            <div class="form-row">
              <label class="field"><span data-i18n="ph_name">Full name</span><input type="text" name="name" data-i18n="ph_name" placeholder="Full name" required></label>
              <label class="field"><span data-i18n="ph_email">Email</span><input type="email" name="email" data-i18n="ph_email" placeholder="Email" required></label>
            </div>
            <div class="form-row">
              <label class="field"><span data-i18n="ph_phone">Phone (optional)</span><input type="tel" name="phone" data-i18n="ph_phone" placeholder="Phone (optional)"></label>
              <label class="field"><span data-i18n="ph_subject">Subject</span><input type="text" name="subject" data-i18n="ph_subject" placeholder="Subject" required></label>
            </div>
            <div class="form-row full">
              <label class="field"><span data-i18n="ph_message">Message</span><textarea name="message" data-i18n="ph_message" placeholder="Message" required></textarea></label>
            </div>
            <div class="form-actions">
              <div class="loading" data-i18n="form_sending">Sending…</div>
              <div class="error-message"></div>
              <div class="sent-message" data-i18n="form_sent">Thank you. Your message has been sent.</div>
              <button type="submit"><i class="fa-solid fa-paper-plane"></i> <span data-i18n="send_message">Send Message</span></button>
            </div>
          </form>
        </div>
      </div>
    </main>
"""
        + CHROME_BOTTOM,
    )
)


def main():
    for name, html in PAGES:
        path = ROOT / name
        path.write_text(html, encoding="utf-8")
        print("wrote", path.name, "chars", len(html))


if __name__ == "__main__":
    main()
