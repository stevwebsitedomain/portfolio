(() => {
  "use strict";

  const init = () => {
    if (document.documentElement.dataset.mohRedesignReady === "true") return;
    document.documentElement.dataset.mohRedesignReady = "true";
    document.body.classList.add("moh-redesign");

    const main = document.querySelector("main.main");
    if (!main) return;
    main.id = main.id || "main-content";

    const header = document.createElement("header");
    header.className = "moh-site-header";
    header.innerHTML = `
      <a class="moh-skip" href="#main-content">Ruka kwenda kwenye maudhui</a>

      <div class="moh-utility">
        <div class="moh-container moh-utility-inner">
          <div class="moh-utility-links" aria-label="Quick links">
            <a href="#contact"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Tanzania</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Wasiliana nasi</a>
          </div>
          <div class="moh-tools">
            <button type="button" class="moh-text-size" aria-label="Badilisha ukubwa wa maandishi">A<sup>+</sup></button>
            <button type="button" class="moh-fullscreen" aria-label="Fungua skrini nzima"><i class="bi bi-arrows-fullscreen" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>

      <div class="moh-identity">
        <div class="moh-container moh-identity-inner">
          <p class="moh-identity-note">United Republic<br>of Tanzania</p>
          <a class="moh-brand" href="#home" aria-label="Digital Matrix Technology - Mwanzo">
            <img src="images/DIGITAL MATRIX TECHNOLOGY.png" alt="Digital Matrix Technology">
            <span class="moh-brand-copy">
              <small class="moh-brand-kicker">Professional Portfolio</small>
              <strong class="moh-brand-title">Digital Matrix Technology</strong>
              <em class="moh-brand-subtitle">Software Developer • Tanzania</em>
            </span>
          </a>
          <p class="moh-identity-note">Websites<br>Management Systems</p>
        </div>
      </div>

      <nav class="moh-main-nav" aria-label="Main navigation">
        <div class="moh-container moh-nav-inner">
          <ul id="moh-nav-links" class="moh-nav-links">
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#qualifications">Qualifications</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <div class="moh-nav-actions">
            <button class="moh-nav-icon moh-search-toggle" type="button" aria-label="Tafuta kwenye tovuti">
              <i class="bi bi-search" aria-hidden="true"></i>
            </button>
            <button class="moh-burger" type="button" aria-expanded="false" aria-controls="moh-nav-links" aria-label="Fungua menu">
              <i class="bi bi-list" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </nav>

      <button class="moh-nav-backdrop" type="button" aria-label="Funga menu"></button>

      <div class="moh-search" aria-hidden="true">
        <button class="moh-search-close" type="button" aria-label="Funga utafutaji"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
        <form class="moh-search-form" role="search">
          <label for="moh-search-input">Tafuta kwenye portfolio</label>
          <div class="moh-search-row">
            <input id="moh-search-input" type="search" placeholder="Mfano: website, database, project..." required>
            <button type="submit" aria-label="Tafuta"><i class="bi bi-search" aria-hidden="true"></i></button>
          </div>
          <p class="moh-search-feedback" aria-live="polite"></p>
        </form>
      </div>
    `;

    document.body.insertBefore(header, main);

    const navToggle = header.querySelector(".moh-burger");
    const navBackdrop = header.querySelector(".moh-nav-backdrop");
    const navLinks = [...header.querySelectorAll(".moh-nav-links a")];

    const closeNavigation = () => {
      document.body.classList.remove("nav-open");
      navToggle?.setAttribute("aria-expanded", "false");
      navToggle?.setAttribute("aria-label", "Fungua menu");
    };

    navToggle?.addEventListener("click", () => {
      const open = document.body.classList.toggle("nav-open");
      navToggle.setAttribute("aria-expanded", String(open));
      navToggle.setAttribute("aria-label", open ? "Funga menu" : "Fungua menu");
    });
    navBackdrop?.addEventListener("click", closeNavigation);
    navLinks.forEach((link) => link.addEventListener("click", closeNavigation));

    const search = header.querySelector(".moh-search");
    const searchInput = header.querySelector("#moh-search-input");
    const searchFeedback = header.querySelector(".moh-search-feedback");

    const setSearchOpen = (open) => {
      search?.classList.toggle("open", open);
      search?.setAttribute("aria-hidden", String(!open));
      document.body.classList.toggle("moh-search-open", open);
      if (open) window.setTimeout(() => searchInput?.focus(), 100);
    };

    header.querySelector(".moh-search-toggle")?.addEventListener("click", () => setSearchOpen(true));
    header.querySelector(".moh-search-close")?.addEventListener("click", () => setSearchOpen(false));
    search?.addEventListener("click", (event) => {
      if (event.target === search) setSearchOpen(false);
    });

    header.querySelector(".moh-search-form")?.addEventListener("submit", (event) => {
      event.preventDefault();
      const rawTerm = searchInput?.value.trim() || "";
      const term = rawTerm.toLocaleLowerCase();
      if (!term) return;

      const candidates = [...main.querySelectorAll("h1, h2, h3, h4, p, .org-card")];
      const match = candidates.find((node) => node.textContent.toLocaleLowerCase().includes(term));
      if (!match) {
        searchFeedback.textContent = `Hakuna matokeo ya “${rawTerm}”.`;
        return;
      }

      searchFeedback.textContent = "Tumepata matokeo. Tunakupeleka hapo...";
      setSearchOpen(false);
      match.scrollIntoView({ behavior: "smooth", block: "center" });
      match.classList.add("moh-search-hit");
      window.setTimeout(() => match.classList.remove("moh-search-hit"), 2200);
    });

    const fontButton = header.querySelector(".moh-text-size");
    const sizeClasses = ["", "moh-text-large", "moh-text-larger"];
    let fontIndex = 0;
    fontButton?.addEventListener("click", () => {
      document.body.classList.remove("moh-text-large", "moh-text-larger");
      fontIndex = (fontIndex + 1) % sizeClasses.length;
      if (sizeClasses[fontIndex]) document.body.classList.add(sizeClasses[fontIndex]);
      fontButton.setAttribute("aria-label", `Ukubwa wa maandishi: kiwango ${fontIndex + 1}`);
    });

    header.querySelector(".moh-fullscreen")?.addEventListener("click", async () => {
      try {
        if (!document.fullscreenElement) await document.documentElement.requestFullscreen();
        else await document.exitFullscreen();
      } catch (_) {
        // Fullscreen may be restricted by the browser.
      }
    });

    const projectSection = document.querySelector("#projects");
    const projectRows = projectSection ? [...projectSection.querySelectorAll(".row.gy-4")] : [];
    const projectRow = projectRows.find((row) => row.querySelector(".org-card"));

    if (projectRow && !projectSection.querySelector(".moh-project-layout")) {
      const cards = [...projectRow.children].filter((item) => item.querySelector(".org-card"));
      if (cards.length) {
        const layout = document.createElement("div");
        layout.className = "moh-project-layout";

        const primary = document.createElement("section");
        primary.className = "moh-project-main";
        primary.setAttribute("aria-labelledby", "moh-projects-main-title");
        primary.innerHTML = '<h3 id="moh-projects-main-title" class="moh-column-title">Featured Projects</h3>';

        const reports = document.createElement("aside");
        reports.className = "moh-project-reports";
        reports.setAttribute("aria-labelledby", "moh-projects-reports-title");
        reports.innerHTML = '<h3 id="moh-projects-reports-title" class="moh-column-title">Project Reports</h3>';

        const featured = document.createElement("aside");
        featured.className = "moh-project-featured";
        featured.setAttribute("aria-labelledby", "moh-projects-featured-title");
        featured.innerHTML = '<h3 id="moh-projects-featured-title" class="moh-column-title">Current Project</h3>';

        cards.forEach((card, index) => {
          card.classList.add("moh-project-item");
          if (index < 6) primary.appendChild(card);
          else if (index < 9) reports.appendChild(card);
          else featured.appendChild(card);
        });

        reports.insertAdjacentHTML("beforeend", '<a class="moh-project-all" href="#projects">View All Projects <i class="bi bi-arrow-right" aria-hidden="true"></i></a>');
        featured.insertAdjacentHTML("beforeend", `
          <h3 class="moh-program-title">Services and Programmes</h3>
          <div class="moh-program-card">
            <i class="bi bi-code-square" aria-hidden="true"></i>
            <strong>Website &amp; Management Systems</strong>
            <span>Design, development, databases and cloud deployment.</span>
            <a href="#contact">Request a service <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
          </div>
        `);

        layout.append(primary, reports, featured);
        projectRow.replaceWith(layout);
      }
    }

    const sections = navLinks
      .map((link) => document.querySelector(link.getAttribute("href")))
      .filter(Boolean);

    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver((entries) => {
        const visible = entries
          .filter((entry) => entry.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
        if (!visible) return;

        navLinks.forEach((link) => {
          const isActive = link.getAttribute("href") === `#${visible.target.id}`;
          link.classList.toggle("active", isActive);
          if (isActive) link.setAttribute("aria-current", "page");
          else link.removeAttribute("aria-current");
        });
      }, { rootMargin: "-25% 0px -60% 0px", threshold: [0.05, 0.25, 0.5] });

      sections.forEach((section) => observer.observe(section));
    }

    document.addEventListener("keydown", (event) => {
      if (event.key !== "Escape") return;
      closeNavigation();
      setSearchOpen(false);
    });
  };

  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", init);
  else init();
})();
