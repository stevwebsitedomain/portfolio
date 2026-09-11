(function () {
  "use strict";

  var burger = document.querySelector(".bk-burger");
  var menu = document.getElementById("menu");

  function closeMenu() {
    document.body.classList.remove("nav-open");
    if (menu) menu.hidden = true;
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
    if (window.innerWidth >= 992) closeMenu();
  });
})();
