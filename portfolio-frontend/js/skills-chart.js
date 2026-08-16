(function () {
  "use strict";

  var chart;
  var SKILLS = [
    { name: "HTML", value: 95 },
    { name: "CSS", value: 90 },
    { name: "JavaScript", value: 85 },
    { name: "Bootstrap", value: 90 },
    { name: "PHP", value: 88 },
    { name: "Yii2", value: 82 },
    { name: "MySQL", value: 85 },
    { name: "Git", value: 80 },
    { name: "Cloud", value: 78 },
    { name: "API", value: 80 },
    { name: "Responsive", value: 92 },
  ];

  function buildWaterfallOption() {
    var labels = SKILLS.map(function (s) {
      return s.name;
    });
    var values = SKILLS.map(function (s) {
      return s.value;
    });
    // Transparent helper series (ECharts waterfall2 pattern).
    // All zeros = bars rise from the baseline like proficiency levels.
    var placeholder = values.map(function () {
      return 0;
    });

    return {
      title: {
        text: "Skills Analysis",
        subtext: "Proficiency by technology (out of 100)",
        left: "center",
        textStyle: {
          fontFamily: "Montserrat, Poppins, sans-serif",
          fontWeight: 700,
          fontSize: 16,
          color: "#32353a",
        },
        subtextStyle: {
          fontFamily: "Poppins, Open Sans, sans-serif",
          fontSize: 12,
          color: "#6b7280",
        },
      },
      tooltip: {
        trigger: "axis",
        axisPointer: { type: "shadow" },
        formatter: function (params) {
          var tar = params[1] || params[0];
          if (!tar) return "";
          return tar.name + "<br/>" + tar.seriesName + " : " + tar.value + "%";
        },
      },
      grid: {
        left: "3%",
        right: "4%",
        bottom: "8%",
        top: 70,
        containLabel: true,
      },
      xAxis: {
        type: "category",
        splitLine: { show: false },
        data: labels,
        axisLabel: {
          interval: 0,
          rotate: 28,
          fontSize: 10,
          color: "#4b5563",
        },
      },
      yAxis: {
        type: "value",
        max: 100,
        axisLabel: {
          formatter: "{value}%",
          color: "#6b7280",
        },
        splitLine: {
          lineStyle: { color: "rgba(0,0,0,0.06)" },
        },
      },
      series: [
        {
          name: "Placeholder",
          type: "bar",
          stack: "Total",
          itemStyle: {
            borderColor: "transparent",
            color: "transparent",
          },
          emphasis: {
            itemStyle: {
              borderColor: "transparent",
              color: "transparent",
            },
          },
          data: placeholder,
        },
        {
          name: "Proficiency",
          type: "bar",
          stack: "Total",
          label: {
            show: true,
            position: "inside",
            formatter: "{c}%",
            color: "#fff",
            fontSize: 10,
            fontWeight: 600,
          },
          itemStyle: {
            color: "#e84545",
            borderRadius: [4, 4, 0, 0],
          },
          data: values,
        },
      ],
    };
  }

  function initChart() {
    var el = document.getElementById("skillsWaterfallChart");
    if (!el || typeof echarts === "undefined") return;

    if (!chart) {
      chart = echarts.init(el, null, {
        renderer: "canvas",
        useDirtyRect: false,
      });
    }
    chart.setOption(buildWaterfallOption());
    chart.resize();
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
    if (chart) chart.resize();
  });
})();
