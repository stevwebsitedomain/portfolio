(function () {
  "use strict";

  var COLORS = [
    "#e84545",
    "#6b46c1",
    "#3182ce",
    "#38a169",
    "#d69e2e",
    "#dd6b20",
    "#319795",
    "#805ad5",
    "#e53e3e",
    "#2b6cb0",
    "#c05621",
  ];

  function readSkills() {
    return Array.prototype.slice
      .call(document.querySelectorAll("#skills .skill-item[data-skill]"))
      .map(function (el) {
        return {
          label: el.getAttribute("data-skill"),
          value: Number(el.getAttribute("data-value")) || 0,
        };
      })
      .filter(function (s) {
        return s.label && s.value > 0;
      });
  }

  function drawPie(canvas, skills) {
    if (!canvas || !skills.length) return;
    var ctx = canvas.getContext("2d");
    var dpr = window.devicePixelRatio || 1;
    var size = Math.min(320, canvas.parentElement ? canvas.parentElement.clientWidth - 16 : 320);
    canvas.width = size * dpr;
    canvas.height = size * dpr;
    canvas.style.width = size + "px";
    canvas.style.height = size + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    var total = skills.reduce(function (sum, s) {
      return sum + s.value;
    }, 0);
    var cx = size / 2;
    var cy = size / 2;
    var radius = size * 0.38;
    var start = -Math.PI / 2;

    ctx.clearRect(0, 0, size, size);

    skills.forEach(function (skill, i) {
      var slice = (skill.value / total) * Math.PI * 2;
      var end = start + slice;
      ctx.beginPath();
      ctx.moveTo(cx, cy);
      ctx.arc(cx, cy, radius, start, end);
      ctx.closePath();
      ctx.fillStyle = COLORS[i % COLORS.length];
      ctx.fill();
      start = end;
    });

    ctx.beginPath();
    ctx.arc(cx, cy, radius * 0.52, 0, Math.PI * 2);
    ctx.fillStyle = "#fff";
    ctx.fill();

    ctx.fillStyle = "#32353a";
    ctx.font = "600 13px Poppins, Open Sans, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.fillText("Skills", cx, cy - 8);
    ctx.fillStyle = "#e84545";
    ctx.font = "700 18px Montserrat, sans-serif";
    ctx.fillText(skills.length + "", cx, cy + 12);
  }

  function renderLegend(el, skills, total) {
    if (!el) return;
    el.innerHTML = skills
      .map(function (skill, i) {
        var pct = Math.round((skill.value / total) * 100);
        return (
          '<li><span class="dot" style="background:' +
          COLORS[i % COLORS.length] +
          '"></span><span class="lbl">' +
          skill.label +
          '</span><span class="val">' +
          skill.value +
          "% · " +
          pct +
          "%</span></li>"
        );
      })
      .join("");
  }

  function initChart() {
    var skills = readSkills();
    if (!skills.length) return;
    var total = skills.reduce(function (sum, s) {
      return sum + s.value;
    }, 0);
    drawPie(document.getElementById("skillsPieChart"), skills);
    renderLegend(document.getElementById("skillsPieLegend"), skills, total);
  }

  function enhanceProjectCards() {
    document.querySelectorAll(".work-done .org-card").forEach(function (card) {
      if (card.querySelector(".org-hover")) return;
      var tags = Array.prototype.slice.call(card.querySelectorAll(".org-tags span")).map(function (s) {
        return s.textContent.trim();
      });
      var link = card.querySelector(".btn-live a");
      var href = link ? link.getAttribute("href") : "#";
      var blank = href && href.indexOf("http") === 0;

      var hover = document.createElement("div");
      hover.className = "org-hover";
      hover.innerHTML =
        '<p class="org-hover-title">Features</p><ul class="org-hover-list">' +
        tags
          .map(function (t) {
            return "<li>" + t + "</li>";
          })
          .join("") +
        '</ul><a class="org-hover-btn" href="' +
        href +
        '"' +
        (blank ? ' target="_blank" rel="noopener"' : "") +
        ">View project</a>";
      card.appendChild(hover);
    });
  }

  function boot() {
    initChart();
    enhanceProjectCards();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }

  window.addEventListener("resize", function () {
    initChart();
  });
})();
