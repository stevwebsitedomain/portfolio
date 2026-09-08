(function () {
  const SITE_URL = 'https://portfolio-nu-taupe-017y2cafli.vercel.app/';

  const dict = {
    en: {
      search_placeholder: 'Search projects, skills, contact ...',
      search_aria: 'Open search',
      util_support: 'Customer Support',
      util_announcements: 'Announcements',
      util_sitemap: 'Sitemap',
      util_contact: 'Contact Us',
      text_size: 'Change text size',
      theme: 'Toggle theme',
      lang_title: 'Language',
      nav_home: 'Home',
      nav_about: 'About',
      nav_history: 'History',
      nav_vision: 'Vision',
      nav_skills: 'Skills',
      nav_projects: 'Projects',
      nav_qualifications: 'Qualifications',
      nav_contact: 'Contact',
      menu_open: 'Open menu',
      hero_label: 'Full Stack · Tanzania',
      hero_cta: 'View projects',
      hero_1_title: 'Building systems that power businesses in Tanzania',
      hero_1_text: 'I build websites, management systems, and cloud apps — from interface to database, backend, and deployment.',
      hero_2_title: 'Digital solutions for institutions and businesses',
      hero_2_text: 'School systems, e-commerce, travel, and agriculture platforms — built with PHP, Yii2, MySQL, and cloud hosting.',
      hero_3_title: 'Digital Matrix Technology — Full Stack Development',
      hero_3_text: 'From idea to live system: design, development, hosting, and support for clients across Tanzania.',
      about_eyebrow: 'About',
      about_title: 'History & Vision',
      about_history: 'History',
      about_history_p: 'Steven Makarious is a Full Stack Developer in Tanzania who builds websites, management systems, and cloud applications for businesses and institutions. Through Digital Matrix Technology, he delivers end-to-end solutions — from design and databases to backend, reporting, and live deployment.',
      about_vision: 'Vision',
      about_vision_p: 'To empower Tanzanian clients with reliable, easy-to-use digital systems that can grow — so they can run operations, serve customers online, and improve workplace efficiency.',
      news_title: 'News',
      projects_title: 'Projects',
      news_1_title: 'REACRIS LTD — luxury spirits e-commerce platform',
      news_1_p: 'The REACRIS LTD business website is live — online sales, product listings, and customer contact for Tanzania.',
      news_2_title: 'G4 Elevate Travel & Tours — new travel website',
      news_2_p: 'The travel and tourism company now has a modern site for flights, safaris, and bookings for local and international clients.',
      news_3_title: 'Buhalahala Secondary School — admissions portal',
      news_3_p: 'The Geita secondary school now has a website and online application system for parents and students.',
      news_4_title: 'AGRIDATA SMART — smart agriculture platform',
      news_4_p: 'A data and smart farming platform for farmers and agriculture stakeholders in Tanzania.',
      read_more: 'read more',
      view_all_projects: 'View all / Request a project',
      new_project: 'New project',
      ann_title: 'Announcements',
      ann_1: 'Start a new project — contact us for a system or website quote',
      ann_2: 'New projects added to the portfolio (REACRIS, G4 Elevate)',
      ann_3: 'Services: Full stack development, hosting & cloud deployment',
      ann_4: 'Support via WhatsApp: +255 715 296 092',
      contact_link: 'Contact',
      services_title: 'Key Services',
      svc_1: 'Website development for businesses and institutions',
      svc_2: 'Management systems (schools, offices, admissions)',
      svc_3: 'Backend PHP / Yii2 / MySQL & REST APIs',
      svc_4: 'Cloud deployment — Vercel, Render, shared hosting',
      skills_link: 'Skills',
      docs_eyebrow: 'Resources',
      docs_title: 'Documents & Links',
      docs_search: 'Search a project or skill...',
      search_btn: 'Search',
      live_projects: 'Live Projects',
      live_projects_p: 'List of systems and websites already delivered.',
      service_request: 'Service Request',
      service_request_p: 'Submit project details through the contact form.',
      video_eyebrow: 'Watch',
      video_title: 'Video & Showcase',
      skills_eyebrow: 'Expertise',
      skills_title: 'Skills',
      qual_eyebrow: 'Education & Experience',
      qual_title: 'Qualifications',
      stats_eyebrow: 'At a Glance',
      stats_title: 'Key Stats',
      partners_eyebrow: 'Quick Links',
      partners_title: 'Systems & Partners',
      contact_eyebrow: 'Get in touch',
      contact_title: 'Contact',
      contact_details: 'Contact Details',
      ph_name: 'Full name',
      ph_email: 'Email',
      ph_subject: 'Subject',
      ph_message: 'Message',
      send_message: 'Send Message',
      footer_support: 'Customer Support Centre',
      footer_support_p: 'Reach out for projects, support, or systems advice.',
      footer_links: 'Links',
      footer_live: 'Live Projects',
      footer_contact: 'Contact Us',
      footer_copy: 'Steven Makarious · Digital Matrix Technology. All rights reserved.',
      footer_about: 'About',
      footer_contact_link: 'Contact',
      footer_map: 'Sitemap',
      search_title: 'Search this site',
      search_close: 'Close',
      search_input: 'Type what you are looking for...',
      to_top: 'Back to top',
      qr_caption: 'Scan to open this portfolio',
      brand_line: 'Brand · Systems & Web Solutions'
    },
    sw: {
      search_placeholder: 'Tafuta miradi, stadi, mawasiliano ...',
      search_aria: 'Fungua sehemu ya kutafuta',
      util_support: 'Huduma kwa Wateja',
      util_announcements: 'Matangazo',
      util_sitemap: 'Ramani ya Tovuti',
      util_contact: 'Wasiliana Nasi',
      text_size: 'Badili ukubwa wa maandishi',
      theme: 'Badili mandhari',
      lang_title: 'Lugha',
      nav_home: 'Mwanzo',
      nav_about: 'Kuhusu',
      nav_history: 'Historia',
      nav_vision: 'Dira',
      nav_skills: 'Stadi',
      nav_projects: 'Miradi',
      nav_qualifications: 'Sifa',
      nav_contact: 'Mawasiliano',
      menu_open: 'Fungua menu',
      hero_label: 'Full Stack · Tanzania',
      hero_cta: 'Tazama miradi',
      hero_1_title: 'Kujenga mifumo inayowezesha biashara Tanzania',
      hero_1_text: 'Ninaunda tovuti, mifumo ya usimamizi na programu za wingu — kutoka interface hadi database, backend na deployment.',
      hero_2_title: 'Suluhisho za kidijitali kwa taasisi na biashara',
      hero_2_text: 'Mifumo ya shule, e-commerce, travel na kilimo — iliyojengwa kwa PHP, Yii2, MySQL na cloud hosting.',
      hero_3_title: 'Digital Matrix Technology — Full Stack Development',
      hero_3_text: 'Kutoka idea hadi live system: design, development, hosting na support kwa wateja nchini Tanzania.',
      about_eyebrow: 'Kuhusu',
      about_title: 'Historia na Dira',
      about_history: 'Historia',
      about_history_p: 'Steven Makarious ni Full Stack Developer nchini Tanzania anayejenga tovuti, mifumo ya usimamizi, na programu za wingu kwa biashara na taasisi. Kupitia Digital Matrix Technology, anatoa suluhisho kamili — kutoka design na databases hadi backend, ripoti, na live deployment.',
      about_vision: 'Dira',
      about_vision_p: 'Kuwaendeleza wateja wa Tanzania kwa mifumo ya kidijitali yenye uaminifu, rahisi kutumia, na inayoweza kukua — ili kuendesha shughuli, kuhudumia wateja mtandaoni, na kuongeza ufanisi wa kazi.',
      news_title: 'Habari',
      projects_title: 'Miradi',
      news_1_title: 'REACRIS LTD — jukwaa la e-commerce la luxury spirits',
      news_1_p: 'Tovuti ya biashara ya REACRIS LTD imeundwa na kuwekwa live — mauzo mtandaoni, orodha ya bidhaa, na mawasiliano kwa wateja Tanzania.',
      news_2_title: 'G4 Elevate Travel & Tours — tovuti mpya ya usafiri',
      news_2_p: 'Kampuni ya usafiri na utalii sasa ina tovuti ya kisasa kwa flights, safaris, na bookings kwa wateja wa ndani na nje.',
      news_3_title: 'Buhalahala Secondary School — portal ya uandikishaji',
      news_3_p: 'Shule ya sekondari Geita sasa ina tovuti na mfumo wa maombi ya kujiunga mtandaoni kwa wazazi na wanafunzi.',
      news_4_title: 'AGRIDATA SMART — jukwaa la kilimo smart',
      news_4_p: 'Mfumo wa data na huduma za kilimo smart kwa wakulima na wadau wa sekta ya kilimo nchini Tanzania.',
      read_more: 'soma zaidi',
      view_all_projects: 'Tazama Zote / Omba Mradi',
      new_project: 'Mradi mpya',
      ann_title: 'Matangazo',
      ann_1: 'Fungua mradi mpya — wasiliana kwa quote ya mfumo au tovuti',
      ann_2: 'Miradi mipya imeongezwa kwenye portfolio (REACRIS, G4 Elevate)',
      ann_3: 'Huduma: Full stack development, hosting & cloud deployment',
      ann_4: 'Support kupitia WhatsApp: +255 715 296 092',
      contact_link: 'Wasiliana',
      services_title: 'Huduma Muhimu',
      svc_1: 'Website development kwa biashara na taasisi',
      svc_2: 'Management systems (shule, ofisi, admissions)',
      svc_3: 'Backend PHP / Yii2 / MySQL & REST APIs',
      svc_4: 'Cloud deployment — Vercel, Render, shared hosting',
      skills_link: 'Stadi',
      docs_eyebrow: 'Rasilimali',
      docs_title: 'Nyaraka na Viungo',
      docs_search: 'Tafuta mradi au stadi...',
      search_btn: 'Tafuta',
      live_projects: 'Miradi Hai',
      live_projects_p: 'Orodha ya mifumo na tovuti zilizotengenezwa.',
      service_request: 'Ombi la Huduma',
      service_request_p: 'Wasilisha maelezo ya mradi kupitia fomu ya mawasiliano.',
      video_eyebrow: 'Tazama',
      video_title: 'Video & Showcase',
      skills_eyebrow: 'Ujuzi',
      skills_title: 'Stadi',
      qual_eyebrow: 'Elimu na Uzoefu',
      qual_title: 'Sifa',
      stats_eyebrow: 'Kwa Muhtasari',
      stats_title: 'Takwimu Muhimu',
      partners_eyebrow: 'Viungo vya Haraka',
      partners_title: 'Mifumo & Washirika',
      contact_eyebrow: 'Wasiliana',
      contact_title: 'Mawasiliano',
      contact_details: 'Maelezo ya Mawasiliano',
      ph_name: 'Jina kamili',
      ph_email: 'Barua pepe',
      ph_subject: 'Mada',
      ph_message: 'Ujumbe',
      send_message: 'Tuma Ujumbe',
      footer_support: 'Kituo cha Huduma kwa Wateja',
      footer_support_p: 'Wasiliana kwa miradi, support, au ushauri wa mifumo.',
      footer_links: 'Viungo',
      footer_live: 'Miradi Hai',
      footer_contact: 'Wasiliana Nasi',
      footer_copy: 'Steven Makarious · Digital Matrix Technology. Haki zote zimehifadhiwa.',
      footer_about: 'Kuhusu',
      footer_contact_link: 'Mawasiliano',
      footer_map: 'Ramani',
      search_title: 'Tafuta kwenye tovuti',
      search_close: 'Funga',
      search_input: 'Andika unachotafuta...',
      to_top: 'Rudi juu',
      qr_caption: 'Scan fungua portfolio hii',
      brand_line: 'Brand · Systems & Web Solutions'
    }
  };

  function getLang() {
    const saved = localStorage.getItem('site-lang');
    return saved === 'sw' || saved === 'en' ? saved : 'en';
  }

  function t(lang, key) {
    return (dict[lang] && dict[lang][key]) || dict.en[key] || key;
  }

  function applyLanguage(lang) {
    const L = lang === 'sw' ? 'sw' : 'en';
    document.documentElement.lang = L;
    localStorage.setItem('site-lang', L);

    document.querySelectorAll('[data-i18n]').forEach((el) => {
      const key = el.getAttribute('data-i18n');
      const val = t(L, key);
      if (val == null) return;
      if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
        el.setAttribute('placeholder', val);
      } else {
        el.textContent = val;
      }
    });

    document.querySelectorAll('[data-i18n-aria]').forEach((el) => {
      el.setAttribute('aria-label', t(L, el.getAttribute('data-i18n-aria')));
    });

    document.querySelectorAll('[data-i18n-title]').forEach((el) => {
      el.setAttribute('title', t(L, el.getAttribute('data-i18n-title')));
    });

    const langBtn = document.getElementById('langBtn');
    if (langBtn) {
      langBtn.innerHTML = (L === 'en' ? 'EN' : 'SW') + ' <i class="fa-solid fa-chevron-down"></i>';
      langBtn.setAttribute('title', t(L, 'lang_title'));
    }

    // Sync hero copy for current slide
    window.__heroContent = [
      [t(L, 'hero_1_title'), t(L, 'hero_1_text')],
      [t(L, 'hero_2_title'), t(L, 'hero_2_text')],
      [t(L, 'hero_3_title'), t(L, 'hero_3_text')]
    ];
    if (typeof window.__refreshHeroCopy === 'function') window.__refreshHeroCopy();

    document.dispatchEvent(new CustomEvent('site-lang-changed', { detail: { lang: L } }));
  }

  function initLanguageUI() {
    const wrap = document.querySelector('.lang-wrap');
    const btn = document.getElementById('langBtn');
    const menu = document.getElementById('langMenu');
    if (!btn || !menu) return;

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = menu.classList.toggle('open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    menu.querySelectorAll('[data-lang]').forEach((item) => {
      item.addEventListener('click', () => {
        applyLanguage(item.getAttribute('data-lang'));
        menu.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      });
    });

    document.addEventListener('click', () => {
      menu.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
    });
    if (wrap) wrap.addEventListener('click', (e) => e.stopPropagation());
  }

  window.PortfolioI18n = { applyLanguage, getLang, t, SITE_URL, dict };

  document.addEventListener('DOMContentLoaded', () => {
    initLanguageUI();
    applyLanguage(getLang());
  });
})();
