(function () {
  "use strict";

  var burger = document.querySelector(".jw-burger");
  var menu = document.getElementById("menu");

  function closeMenu() {
    if (menu) menu.hidden = true;
    if (burger) {
      burger.setAttribute("aria-label", "Open menu");
      burger.setAttribute("aria-expanded", "false");
    }
  }

  function openMenu() {
    if (menu) menu.hidden = false;
    if (burger) {
      burger.setAttribute("aria-label", "Close menu");
      burger.setAttribute("aria-expanded", "true");
    }
  }

  if (burger) {
    burger.addEventListener("click", function () {
      if (menu && !menu.hidden) closeMenu();
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
