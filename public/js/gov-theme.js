// Mobile menu
const menuBtn = document.getElementById('menuBtn');
const navList = document.getElementById('navList');
if (menuBtn && navList) {
  menuBtn.addEventListener('click', () => {
    navList.classList.toggle('open');
    const open = navList.classList.contains('open');
    menuBtn.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
  });
}

(function markActiveNav() {
  const raw = (location.pathname.split('/').pop() || 'index.html').toLowerCase();
  const file = raw.replace(/\.html$/i, '') || 'index';
  const current = file === 'index' || file === '' ? 'index.html' : file + '.html';
  document.querySelectorAll('.nav-list a[href]').forEach((link) => {
    const href = (link.getAttribute('href') || '').split('#')[0];
    if (href === current || (current === 'index.html' && (href === './' || href === '/' || href === 'index.html'))) {
      link.classList.add('active');
      const item = link.closest('.nav-item');
      const top = item && item.querySelector(':scope > a.nav-link, :scope > .submenu-toggle');
      if (top) top.classList.add('active');
    }
  });
})();
document.querySelectorAll('.submenu-toggle').forEach(button => button.addEventListener('click', () => {
  if (innerWidth <= 1180) button.parentElement.classList.toggle('mobile-open');
}));

// Hero slider
const slides = [...document.querySelectorAll('.hero .slide')];
const dots = [...document.querySelectorAll('.hero-controls .dot')];
window.__heroContent = window.__heroContent || [
  ['Building systems that power businesses in Tanzania', 'I build websites, management systems, and cloud apps — from interface to database, backend, and deployment.'],
  ['Digital solutions for institutions and businesses', 'School systems, e-commerce, travel, and agriculture platforms — built with PHP, Yii2, MySQL, and cloud hosting.'],
  ['Digital Matrix Technology — Full Stack Development', 'From idea to live system: design, development, hosting, and support for clients across Tanzania.']
];
let current = 0, sliderTimer;
function showSlide(index) {
  if (!slides.length) return;
  current = (index + slides.length) % slides.length;
  slides.forEach((slide, i) => slide.classList.toggle('active', i === current));
  dots.forEach((dot, i) => dot.classList.toggle('active', i === current));
  const copy = window.__heroContent[current];
  const titleEl = document.getElementById('heroTitle');
  const textEl = document.getElementById('heroText');
  if (copy && titleEl) titleEl.textContent = copy[0];
  if (copy && textEl) textEl.textContent = copy[1];
}
window.__refreshHeroCopy = () => showSlide(current);
function autoPlay() {
  if (!slides.length) return;
  clearInterval(sliderTimer);
  sliderTimer = setInterval(() => showSlide(current + 1), 6000);
}
const nextArrow = document.querySelector('.hero-arrow.next');
const prevArrow = document.querySelector('.hero-arrow.prev');
if (nextArrow) nextArrow.onclick = () => { showSlide(current + 1); autoPlay(); };
if (prevArrow) prevArrow.onclick = () => { showSlide(current - 1); autoPlay(); };
dots.forEach((dot, i) => dot.onclick = () => { showSlide(i); autoPlay(); });
autoPlay();

// Dark/light theme
const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
  themeToggle.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    const dark = document.documentElement.classList.contains('dark');
    themeToggle.innerHTML = dark ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
    localStorage.setItem('site-theme', dark ? 'dark' : 'light');
  });
}
if (localStorage.getItem('site-theme') === 'dark') {
  document.documentElement.classList.add('dark');
  if (themeToggle) themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
}

// Text size
const sizes = [16, 18, 20]; let sizeIndex = 0;
const textSizeBtn = document.getElementById('textSize');
if (textSizeBtn) {
  textSizeBtn.addEventListener('click', () => {
    sizeIndex = (sizeIndex + 1) % sizes.length;
    document.documentElement.style.fontSize = sizes[sizeIndex] + 'px';
  });
}

// Search modal
const modal = document.getElementById('searchModal');
function toggleSearch(open) {
  if (!modal) return;
  modal.classList.toggle('open', open);
  document.body.classList.toggle('no-scroll', open);
  if (open) setTimeout(() => document.getElementById('siteSearchInput')?.focus(), 50);
}
const openSearchBtn = document.getElementById('openSearch');
if (openSearchBtn) {
  openSearchBtn.onclick = (e) => {
    e.preventDefault();
    toggleSearch(true);
  };
}
const headerSearchForm = document.getElementById('headerSearchForm');
if (headerSearchForm) {
  headerSearchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const query = document.getElementById('headerSearch');
    const dest = document.getElementById('siteSearchInput');
    if (query && dest) dest.value = query.value;
    toggleSearch(true);
  });
}
const closeSearch = document.getElementById('closeSearch');
if (closeSearch) closeSearch.onclick = () => toggleSearch(false);
if (modal) {
  modal.addEventListener('click', e => { if (e.target === modal) toggleSearch(false); });
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') toggleSearch(false); });

// Animated statistics
const stats = document.querySelectorAll('[data-count]');
let counted = false;
const statsEl = document.querySelector('.stats');
if (statsEl) {
  const statObserver = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting && !counted) {
      counted = true;
      stats.forEach(el => {
        const target = +el.dataset.count, start = performance.now(), duration = 1600;
        function tick(now) {
          const p = Math.min((now - start) / duration, 1);
          el.textContent = Math.floor(target * (1 - Math.pow(1 - p, 3))).toLocaleString();
          if (p < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      });
    }
  }, { threshold: .25 });
  statObserver.observe(statsEl);
}

// Back to top and current year
const toTop = document.getElementById('toTop');
if (toTop) {
  const sendButtons = document.querySelectorAll('.php-email-form button[type="submit"]');
  let sendInView = false;
  if (sendButtons.length && 'IntersectionObserver' in window) {
    const hideWhenSendVisible = new IntersectionObserver((entries) => {
      sendInView = entries.some((entry) => entry.isIntersecting);
      toTop.classList.toggle('show', window.scrollY > 550 && !sendInView);
    }, { threshold: 0.2 });
    sendButtons.forEach((btn) => hideWhenSendVisible.observe(btn));
  }
  window.addEventListener('scroll', () => {
    toTop.classList.toggle('show', window.scrollY > 550 && !sendInView);
  });
  toTop.onclick = () => scrollTo({ top: 0, behavior: 'smooth' });
}
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

// Showcase auto-scroll — continuous loop right → left (transform, no scrollbar)
(function () {
  const scroller = document.getElementById('showcaseScroll');
  const track = document.getElementById('showcaseTrack');
  if (!scroller || !track) return;

  Array.from(track.children).forEach((node) => {
    track.appendChild(node.cloneNode(true));
  });

  let paused = false;
  let offset = 0;
  const speed = 0.7;

  function tick() {
    if (!paused) {
      const half = track.scrollWidth / 2;
      if (half > 4) {
        offset += speed;
        if (offset >= half) offset -= half;
        track.style.transform = 'translateX(' + (-offset) + 'px)';
      }
    }
    requestAnimationFrame(tick);
  }

  scroller.addEventListener('mouseenter', () => { paused = true; });
  scroller.addEventListener('mouseleave', () => { paused = false; });
  scroller.addEventListener('touchstart', () => { paused = true; }, { passive: true });
  scroller.addEventListener('touchend', () => { paused = false; }, { passive: true });
  requestAnimationFrame(tick);
})();

document.querySelectorAll('.qual-card').forEach((card, i) => {
  card.style.setProperty('--qual-delay', (i * 80) + 'ms');
});
if ('IntersectionObserver' in window) {
  const qualObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-in');
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.2 });
  document.querySelectorAll('.qual-card').forEach((card) => qualObserver.observe(card));
} else {
  document.querySelectorAll('.qual-card').forEach((card) => card.classList.add('is-in'));
}
