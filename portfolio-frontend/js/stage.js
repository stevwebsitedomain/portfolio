(function () {
  "use strict";

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var burger = document.querySelector(".serene-burger");
  var menu = document.getElementById("menu");

  function closeMenu() {
    document.body.classList.remove("nav-open");
    if (burger) {
      burger.setAttribute("aria-label", "Open menu");
      burger.setAttribute("aria-expanded", "false");
    }
  }

  function openMenu() {
    document.body.classList.add("nav-open");
    if (menu) menu.hidden = false;
    if (burger) {
      burger.setAttribute("aria-label", "Close menu");
      burger.setAttribute("aria-expanded", "true");
    }
  }

  if (burger) {
    burger.addEventListener("click", function () {
      if (document.body.classList.contains("nav-open")) closeMenu();
      else openMenu();
    });
  }

  document.querySelectorAll("#menu a").forEach(function (a) {
    a.addEventListener("click", closeMenu);
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeMenu();
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth >= 1024) closeMenu();
  });

  function clamp(n, min, max) {
    return Math.min(max, Math.max(min, n));
  }

  function lerp(current, target, factor) {
    return current + (target - current) * factor;
  }

  var quote = document.querySelector(".serene-quote");
  var rainbow = document.querySelector(".serene-rainbow");
  var cloudL = document.querySelector(".serene-cloud-l");
  var cloudR = document.querySelector(".serene-cloud-r");

  var rainbowY = 120;
  var cloudLX = -200;
  var cloudRX = 200;
  var cloudY = 0;

  function tick() {
    if (!quote) return;

    var rect = quote.getBoundingClientRect();
    var windowHeight = window.innerHeight;
    var progress = clamp((windowHeight - rect.top) / (windowHeight + rect.height), 0, 1);

    var rainbowTarget = 120 + ( -160 - 120) * progress;
    rainbowY = lerp(rainbowY, rainbowTarget, 0.06);

    var inView = progress > 0.12 && progress < 0.92;
    cloudLX = lerp(cloudLX, inView ? 0 : -200, 0.04);
    cloudRX = lerp(cloudRX, inView ? 0 : 200, 0.04);
    cloudY = lerp(cloudY, progress * -50, 0.04);

    var lOpacity = clamp(1 - Math.abs(cloudLX) / 200, 0, 1);
    var rOpacity = clamp(1 - Math.abs(cloudRX) / 200, 0, 1);

    if (reduce) {
      rainbowY = 0;
      cloudLX = 0;
      cloudRX = 0;
      cloudY = 0;
      lOpacity = 1;
      rOpacity = 1;
    }

    if (rainbow) {
      rainbow.style.transform = "translate3d(0," + rainbowY + "px,0)";
    }
    if (cloudL) {
      cloudL.style.opacity = String(lOpacity);
      cloudL.style.transform = "translate3d(" + cloudLX + "px," + cloudY + "px,0)";
    }
    if (cloudR) {
      cloudR.style.opacity = String(rOpacity);
      cloudR.style.transform = "translate3d(" + cloudRX + "px," + cloudY + "px,0) scaleX(-1)";
    }

    if (!reduce) requestAnimationFrame(tick);
  }

  if (quote) requestAnimationFrame(tick);
})();
