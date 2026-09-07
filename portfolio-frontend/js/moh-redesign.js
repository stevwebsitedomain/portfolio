(() => {
  "use strict";

  const init = () => {
    if (document.documentElement.dataset.mohRedesignReady === "true") return;
    document.documentElement.dataset.mohRedesignReady = "true";
    document.body.classList.add("moh-redesign");

    const main = document.querySelector("main.main");
    if (!main) return;

    const header = document.createElement("div");
    header.className = "moh-site-header";
    header.innerHTML = `
      <a class="moh-skip-link" href="#main-content">Ruka kwenda kwenye maudhui</a>
      <div class="moh-utility">
        <div class="container moh-utility-inner">
          <span><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Tanzania</span>
          <div class="moh-utility-actions">
            <a href="#contact">Wasiliana nasi</a>
            <button type="button" class="moh-text-size" aria-label="Badilisha ukubwa wa maandishi">A<sup>+</sup></button>
            <button type="button" class="moh-fullscreen" aria-label="Fungua skrini nzima"><i class="bi bi-arrows-fullscreen" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>

      <div class="moh-identity">
        <div class="container moh-identity-inner">
          <a class="moh-brand" href="#home" aria-label="Digital Matrix Technology - Mwanzo">
            <img src="images/DIGITAL MATRIX TECHNOLOGY.png" alt="Digital Matrix Technology">
            <span>
              <small>United Republic of Tanzania</small>
              <strong>Digital Matrix Technology</strong>
              <em>Software Developer Portfolio</em>
            </span>
          </a>
          <div class="moh-identity-contact">
            <span><i class="bi bi-envelope-fill" aria-hidden="true"></i> info@digitalmatrixtechnology.com</span>
            <a href="#contact"><i class="bi bi-chat-square-text-fill" aria-hidden="true"></i> Pata huduma</a>
          </div>
        </div>
      </div>

      <nav class="moh-navbar" aria-label="Main navigation">
        <div class="container moh-navbar-inner">
          <button class="moh-nav-toggle" type="button" aria-expanded="false" aria-controls="moh-nav-links">
            <i class="bi bi-list" aria-hidden="true"></i><span>Menu</span>
          </button>
          <div id="moh-nav-links" class="moh-nav-links">
            <a class="active" href="#home">Home</a>
            <a href="#profile">Profile</a>
            <a href="#skills">Skills</a>
            <a href="#qualifications">Qualifications</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
          </div>
          <button class="moh-search-toggle" type="button" aria-label="Tafuta kwenye tovuti">
            <i class="bi bi-search" aria-hidden="true"></i>
          </button>
        </div>
      </nav>
      <button class="moh-nav-backdrop" type="button" aria-label="Funga menu"></button>

      <div class="moh-search-overlay" aria-hidden="true">
        <div class="container moh-search-panel" role="dialog" aria-modal="true" aria-labelledby="moh-search-title">
          <button class="moh-search-close" type="button" aria-label="Funga utafutaji"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
          <h2 id="moh-search-title">Tafuta kwenye portfolio</h2>
          <form class="moh-search-form">
            <label class="visually-hidden" for="moh-search-input">Neno la kutafuta</label>
            <input id="moh-search-input" type="search" placeholder="Mfano: website, database, project..." required>
            <button type="submit">Tafuta</button>
          </form>
          <p class="moh-search-feedback" aria-live="polite"></p>
        </div>
      </div>
    `;

    main.id = main.id || "main-content";
    document.body.insertBefore(header, main);

    const navToggle = header.querySelector(".moh-nav-toggle");
    const navBackdrop = header.querySelector(".moh-nav-backdrop");
    const navLinks = [...header.querySelectorAll(".moh-nav-links a")];

    const closeNavigation = () => {
      document.body.classList.remove("moh-nav-open");
      navToggle?.setAttribute("aria-expanded", "false");
    };

    navToggle?.addEventListener("click", () => {
      const open = document.body.classList.toggle("moh-nav-open");
      navToggle.setAttribute("aria-expanded", String(open));
    });
    navBackdrop?.addEventListener("click", closeNavigation);
    navLinks.forEach((link) => link.addEventListener("click", closeNavigation));

    const searchOverlay = header.querySelector(".moh-search-overlay");
    const searchInput = header.querySelector("#moh-search-input");
    const searchFeedback = header.querySelector(".moh-search-feedback");

    const setSearchOpen = (open) => {
      document.body.classList.toggle("moh-search-open", open);
      searchOverlay?.setAttribute("aria-hidden", String(!open));
      if (open) window.setTimeout(() => searchInput?.focus(), 100);
    };

    header.querySelector(".moh-search-toggle")?.addEventListener("click", () => setSearchOpen(true));
    header.querySelector(".moh-search-close")?.addEventListener("click", () => setSearchOpen(false));
    searchOverlay?.addEventListener("click", (event) => {
      if (event.target === searchOverlay) setSearchOpen(false);
    });

    header.querySelector(".moh-search-form")?.addEventListener("submit", (event) => {
      event.preventDefault();
      const term = searchInput?.value.trim().toLocaleLowerCase() || "";
      if (!term) return;

      const candidates = [...main.querySelectorAll("h1, h2, h3, h4, p, .org-card")];
      const match = candidates.find((node) => node.textContent.toLocaleLowerCase().includes(term));
      if (!match) {
        searchFeedback.textContent = `Hakuna matokeo ya “${searchInput.value.trim()}”.`;
        return;
      }

      searchFeedback.textContent = "Tumepata matokeo. Tunakupeleka hapo...";
      setSearchOpen(false);
      match.scrollIntoView({ behavior: "smooth", block: "center" });
      match.classList.add("moh-search-hit");
      window.setTimeout(() => match.classList.remove("moh-search-hit"), 2200);
    });

    const fontButton = header.querySelector(".moh-text-size");
    const fontScales = ["1", "1.08", "1.16"];
    let fontIndex = 0;
    fontButton?.addEventListener("click", () => {
      fontIndex = (fontIndex + 1) % fontScales.length;
      document.documentElement.style.setProperty("--moh-font-scale", fontScales[fontIndex]);
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
    const projectRow = projectSection?.querySelector(".container:not(:has(.section-title)) .row.gy-4")
      || [...(projectSection?.querySelectorAll(".row.gy-4") || [])].find((row) => row.querySelector(".org-card"));

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
