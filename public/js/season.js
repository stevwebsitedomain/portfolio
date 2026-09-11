(function () {
  "use strict";

  /**
   * Dynamic seasonal decorations for the hero.
   * Tanzania annual days + Christmas / New Year / Eid windows.
   */
  var ICON = {
    christmas: ["🎄", "❄️", "🎁", "⭐", "🎅", "🔔"],
    newyear: ["✨", "🎉", "🥳", "🕛", "🎇", "🥂"],
    eid: ["🌙", "⭐", "🕌", "✨", "🪔", "🤲"],
    nanenane: ["🌾", "🚜", "🌱", "🌽", "🌻", "🏞️"],
    sabasaba: ["🏛️", "🇹🇿", "🤝", "📣", "🟩", "🟨"],
    independence: ["🇹🇿", "🎆", "🕊️", "🟩", "🟨", "🔵"],
    workers: ["🛠️", "👷", "💪", "⚙️", "🏭", "🙌"],
    union: ["🤝", "🇹🇿", "🔗", "💙", "🕊️", "✨"],
    karume: ["🕯️", "🇹🇿", "📜", "💙", "🕊️", "⭐"],
    revolution: ["🇹🇿", "🔥", "📜", "🟩", "🟨", "⭐"],
  };

  var LABELS = {
    christmas: "Merry Christmas",
    newyear: "Happy New Year",
    eid: "Eid Mubarak",
    nanenane: "Nane Nane",
    sabasaba: "Saba Saba",
    independence: "Independence Day",
    workers: "Workers' Day",
    union: "Union Day",
    karume: "Karume Day",
    revolution: "Revolution Day",
  };

  // Approximate Eid windows (Gregorian) for upcoming years
  var EID_WINDOWS = [
    // Eid al-Fitr
    { y: 2025, m: 3, d1: 28, d2: 2 }, // Mar 28 - Apr 2
    { y: 2026, m: 3, d1: 18, d2: 24 },
    { y: 2027, m: 3, d1: 8, d2: 14 },
    // Eid al-Adha
    { y: 2025, m: 6, d1: 5, d2: 9 },
    { y: 2026, m: 5, d1: 25, d2: 30 },
    { y: 2027, m: 5, d1: 15, d2: 20 },
  ];

  function inRange(month, day, m, d1, d2) {
    if (d2 >= d1) return month === m && day >= d1 && day <= d2;
    // wraps month (e.g. Mar 28 - Apr 2)
    return (month === m && day >= d1) || (month === m + 1 && day <= d2);
  }

  function inEid(now) {
    var y = now.getFullYear();
    var m = now.getMonth() + 1;
    var d = now.getDate();
    for (var i = 0; i < EID_WINDOWS.length; i++) {
      var w = EID_WINDOWS[i];
      if (w.y !== y) continue;
      if (inRange(m, d, w.m, w.d1, w.d2)) return true;
    }
    return false;
  }

  function detectSeason(now) {
    var m = now.getMonth() + 1;
    var d = now.getDate();

    if (m === 12 && d >= 20 && d <= 27) return "christmas";
    if ((m === 12 && d >= 28) || (m === 1 && d <= 3)) return "newyear";
    if (inEid(now)) return "eid";
    if (m === 8 && d >= 6 && d <= 10) return "nanenane";
    if (m === 7 && d >= 5 && d <= 9) return "sabasaba";
    if (m === 12 && d >= 7 && d <= 11) return "independence";
    if (m === 5 && d >= 1 && d <= 3) return "workers";
    if (m === 4 && d >= 25 && d <= 28) return "union";
    if (m === 4 && d >= 6 && d <= 9) return "karume";
    if (m === 1 && d >= 11 && d <= 14) return "revolution";
    return null;
  }

  function applySeason(season) {
    var hero = document.querySelector(".bk-hero");
    var layer = document.getElementById("bkSeason");
    if (!hero || !layer || !season || !ICON[season]) return;

    document.body.setAttribute("data-season", season);
    hero.classList.add("has-season", "season-" + season);
    layer.innerHTML = "";

    var badge = document.createElement("div");
    badge.className = "bk-season-badge";
    badge.textContent = LABELS[season] || season;
    layer.appendChild(badge);

    var icons = ICON[season];
    for (var i = 0; i < 14; i++) {
      var span = document.createElement("span");
      span.className = "bk-season-icon";
      span.textContent = icons[i % icons.length];
      span.style.left = (4 + ((i * 7.1) % 92)) + "%";
      span.style.top = (6 + ((i * 11.3) % 78)) + "%";
      span.style.animationDelay = (i * 0.35) + "s";
      span.style.fontSize = (1 + (i % 3) * 0.35) + "rem";
      layer.appendChild(span);
    }
  }

  function boot() {
    applySeason(detectSeason(new Date()));
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }

  // Expose for quick manual testing: window.__setSeason('christmas')
  window.__setSeason = applySeason;
})();
