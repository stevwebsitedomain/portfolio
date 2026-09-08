// Mobile menu
const menuBtn = document.getElementById('menuBtn');
const navList = document.getElementById('navList');
menuBtn.addEventListener('click', () => {
  navList.classList.toggle('open');
  const open = navList.classList.contains('open');
  menuBtn.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
});
document.querySelectorAll('.submenu-toggle').forEach(button => button.addEventListener('click', () => {
  if (innerWidth <= 850) button.parentElement.classList.toggle('mobile-open');
}));

// Hero slider
const slides = [...document.querySelectorAll('.slide')];
const dots = [...document.querySelectorAll('.dot')];
window.__heroContent = window.__heroContent || [
  ['Building systems that power businesses in Tanzania', 'I build websites, management systems, and cloud apps — from interface to database, backend, and deployment.'],
  ['Digital solutions for institutions and businesses', 'School systems, e-commerce, travel, and agriculture platforms — built with PHP, Yii2, MySQL, and cloud hosting.'],
  ['Digital Matrix Technology — Full Stack Development', 'From idea to live system: design, development, hosting, and support for clients across Tanzania.']
];
let current = 0, sliderTimer;
function showSlide(index) {
  current = (index + slides.length) % slides.length;
  slides.forEach((slide, i) => slide.classList.toggle('active', i === current));
  dots.forEach((dot, i) => dot.classList.toggle('active', i === current));
  const copy = window.__heroContent[current];
  if (copy) {
    document.getElementById('heroTitle').textContent = copy[0];
    document.getElementById('heroText').textContent = copy[1];
  }
}
window.__refreshHeroCopy = () => showSlide(current);
function autoPlay() { clearInterval(sliderTimer); sliderTimer = setInterval(() => showSlide(current + 1), 6000); }
document.querySelector('.hero-arrow.next').onclick = () => { showSlide(current + 1); autoPlay(); };
document.querySelector('.hero-arrow.prev').onclick = () => { showSlide(current - 1); autoPlay(); };
dots.forEach((dot, i) => dot.onclick = () => { showSlide(i); autoPlay(); });
autoPlay();

// Dark/light theme
const themeToggle = document.getElementById('themeToggle');
themeToggle.addEventListener('click', () => {
  document.documentElement.classList.toggle('dark');
  const dark = document.documentElement.classList.contains('dark');
  themeToggle.innerHTML = dark ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
  localStorage.setItem('site-theme', dark ? 'dark' : 'light');
});
if (localStorage.getItem('site-theme') === 'dark') {
  document.documentElement.classList.add('dark');
  themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
}

// Text size
const sizes = [14, 16, 18]; let sizeIndex = 0;
document.getElementById('textSize').addEventListener('click', () => {
  sizeIndex = (sizeIndex + 1) % sizes.length;
  document.documentElement.style.fontSize = sizes[sizeIndex] + 'px';
});

// Search modal
const modal = document.getElementById('searchModal');
function toggleSearch(open) {
  modal.classList.toggle('open', open);
  document.body.classList.toggle('no-scroll', open);
  if (open) setTimeout(() => document.getElementById('siteSearchInput').focus(), 50);
}
document.getElementById('openSearch').onclick = () => toggleSearch(true);
document.getElementById('closeSearch').onclick = () => toggleSearch(false);
modal.addEventListener('click', e => { if (e.target === modal) toggleSearch(false); });
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
window.addEventListener('scroll', () => toTop.classList.toggle('show', scrollY > 550));
toTop.onclick = () => scrollTo({ top: 0, behavior: 'smooth' });
document.getElementById('year').textContent = new Date().getFullYear();

// Showcase auto-scroll (unique cards only — ping-pong, no duplicates)
(function () {
  const scroller = document.getElementById('showcaseScroll');
  if (!scroller) return;
  let dir = 1;
  let paused = false;
  let raf = 0;
  const speed = 0.55;

  function tick() {
    if (!paused) {
      const max = scroller.scrollWidth - scroller.clientWidth;
      if (max > 4) {
        scroller.scrollLeft += dir * speed;
        if (scroller.scrollLeft >= max - 1) dir = -1;
        if (scroller.scrollLeft <= 0) dir = 1;
      }
    }
    raf = requestAnimationFrame(tick);
  }

  scroller.addEventListener('mouseenter', () => { paused = true; });
  scroller.addEventListener('mouseleave', () => { paused = false; });
  scroller.addEventListener('touchstart', () => { paused = true; }, { passive: true });
  scroller.addEventListener('touchend', () => { paused = false; }, { passive: true });
  raf = requestAnimationFrame(tick);
})();
