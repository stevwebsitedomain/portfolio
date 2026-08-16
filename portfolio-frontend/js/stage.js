(function () {
  "use strict";

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var vids = Array.prototype.slice.call(document.querySelectorAll(".stage video"));
  var master = vids[0];

  function syncVideos() {
    if (!master) return;
    var t = master.currentTime;
    vids.forEach(function (v) {
      if (v === master) return;
      if (Math.abs(v.currentTime - t) > 0.12) {
        try {
          v.currentTime = t;
        } catch (e) {}
      }
    });
  }

  if (master) {
    master.addEventListener("timeupdate", syncVideos);
  }

  if (reduce) {
    vids.forEach(function (v) {
      v.removeAttribute("autoplay");
      v.pause();
    });
    document.documentElement.classList.remove("intro");
  }

  var burger = document.querySelector(".burger");
  var menu = document.getElementById("menu");

  function closeMenu() {
    document.body.classList.remove("nav-open");
    if (burger) burger.setAttribute("aria-label", "Open menu");
    if (burger) burger.setAttribute("aria-expanded", "false");
    document.querySelectorAll(".macc.open").forEach(function (el) {
      el.classList.remove("open");
    });
  }

  function openMenu() {
    document.body.classList.add("nav-open");
    if (burger) burger.setAttribute("aria-label", "Close menu");
    if (burger) burger.setAttribute("aria-expanded", "true");
  }

  if (burger) {
    burger.addEventListener("click", function () {
      if (document.body.classList.contains("nav-open")) closeMenu();
      else openMenu();
    });
  }

  document.querySelectorAll(".macc .mrow").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var acc = btn.parentNode;
      var was = acc.classList.contains("open");
      document.querySelectorAll(".macc.open").forEach(function (el) {
        el.classList.remove("open");
      });
      if (!was) acc.classList.add("open");
    });
  });

  document.querySelectorAll("#menu a").forEach(function (a) {
    a.addEventListener("click", closeMenu);
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeMenu();
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 1023) closeMenu();
  });

  function measureS() {
    var probe = document.querySelector(".s-probe");
    if (!probe) return 1;
    var w = probe.getBoundingClientRect().width;
    return w / 100 || 1;
  }

  function playIntro() {
    if (reduce || !document.documentElement.classList.contains("intro")) return;
    if (!window.Element || !Element.prototype.animate) {
      document.documentElement.classList.remove("intro");
      return;
    }

    var phone = window.matchMedia("(max-width:599px)").matches;
    var m = phone ? 0.86 : 1;
    var EXPO = "cubic-bezier(.16,1,.3,1)";
    var QUINT = "cubic-bezier(.22,1,.36,1)";
    var QUART = "cubic-bezier(.25,1,.5,1)";
    var TYPE = "cubic-bezier(.22,.85,.24,1)";
    var s = measureS();
    var anims = [];

    function go(el, keyframes, delay, dur, ease) {
      if (!el) return;
      anims.push(
        el.animate(keyframes, {
          delay: delay * 1000 * m,
          duration: dur * 1000 * m,
          easing: ease,
          fill: "forwards",
        })
      );
    }

    var logo = document.querySelector(".logo-mark");
    var word = document.querySelector(".wordmark");
    go(
      logo,
      [
        { opacity: 0, transform: "scale(.9)" },
        { opacity: 1, transform: "scale(1)" },
      ],
      0,
      0.7,
      EXPO
    );
    go(
      word,
      [
        { opacity: 0, transform: "scale(.9)" },
        { opacity: 1, transform: "scale(1)" },
      ],
      0,
      0.7,
      EXPO
    );

    document.querySelectorAll(".stage-nav a").forEach(function (a, i) {
      go(
        a,
        [
          { opacity: 0, transform: "translateY(" + 7 * s + "px)" },
          { opacity: 1, transform: "translateY(0)" },
        ],
        0.12 + i * 0.055,
        0.62,
        QUINT
      );
    });

    go(
      document.querySelector(".burger"),
      [{ opacity: 0 }, { opacity: 1 }],
      0.18,
      0.55,
      QUART
    );

    go(
      document.querySelector(".btn-top"),
      [{ clipPath: "inset(0 100% 0 0)" }, { clipPath: "inset(0 0 0 0)" }],
      0.28,
      0.66,
      EXPO
    );

    document.querySelectorAll(".hero-copy h1 .ln > span").forEach(function (span, i) {
      go(
        span,
        [{ transform: "translateY(120%)" }, { transform: "translateY(0)" }],
        0.34 + i * 0.09,
        0.98,
        TYPE
      );
    });

    go(
      document.querySelector(".hero-copy .sub"),
      [
        { opacity: 0, transform: "translateY(" + 14 * s + "px)" },
        { opacity: 1, transform: "translateY(0)" },
      ],
      0.74,
      0.72,
      QUINT
    );

    go(
      document.querySelector(".btn-cta"),
      [{ clipPath: "inset(0 100% 0 0)" }, { clipPath: "inset(0 0 0 0)" }],
      0.9,
      0.7,
      EXPO
    );

    document.querySelectorAll(".rule").forEach(function (r, i) {
      go(r, [{ transform: "scaleY(0)" }, { transform: "scaleY(1)" }], 0.98 + i * 0.07, 0.6, QUART);
    });

    document.querySelectorAll(".stat .num").forEach(function (n, i) {
      go(
        n,
        [
          { opacity: 0, transform: "translateY(" + 12 * s + "px)" },
          { opacity: 1, transform: "translateY(0)" },
        ],
        1.04 + i * 0.085,
        0.66,
        QUINT
      );
    });

    document.querySelectorAll(".stat .lbl").forEach(function (n, i) {
      go(
        n,
        [
          { opacity: 0, transform: "translateY(" + 10 * s + "px)" },
          { opacity: 1, transform: "translateY(0)" },
        ],
        1.1 + i * 0.085,
        0.62,
        QUINT
      );
    });

    function finish() {
      anims.forEach(function (a) {
        try {
          a.cancel();
        } catch (e) {}
      });
      document.documentElement.classList.remove("intro");
    }

    setTimeout(finish, 1900 * m + 200);
    setTimeout(finish, 4000);
  }

  function startWhenReady() {
    var started = false;
    function start() {
      if (started) return;
      started = true;
      requestAnimationFrame(function () {
        playIntro();
      });
    }

    var fontWait = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();
    var t1 = setTimeout(start, 1000);
    fontWait.then(function () {
      clearTimeout(t1);
      var t2 = setTimeout(start, 0);
      setTimeout(function () {
        clearTimeout(t2);
        start();
      }, 1200);
      requestAnimationFrame(start);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", startWhenReady);
  } else {
    startWhenReady();
  }
})();
