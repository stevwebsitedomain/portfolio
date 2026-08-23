(function () {
  "use strict";

  var chart;

  // Skill levels — converted to income/expense deltas for an accumulated waterfall
  var SKILLS = [
    { name: "HTML", value: 95 },
    { name: "CSS", value: 90 },
    { name: "JS", value: 85 },
    { name: "Bootstrap", value: 90 },
    { name: "PHP", value: 88 },
    { name: "Yii2", value: 82 },
    { name: "MySQL", value: 85 },
    { name: "Git", value: 80 },
    { name: "Cloud", value: 78 },
    { name: "API", value: 80 },
    { name: "Responsive", value: 92 },
  ];

  function buildWaterfallSeries(skills) {
    var labels = [];
    var help = [];
    var income = [];
    var expenses = [];
    var level = 0;

    skills.forEach(function (skill, i) {
      labels.push(skill.name);
      var prev = i === 0 ? 0 : skills[i - 1].value;
      var delta = i === 0 ? skill.value : skill.value - prev;

      if (delta >= 0) {
        help.push(level);
        income.push(delta);
        expenses.push("-");
        level += delta;
      } else {
        help.push(level + delta);
        income.push("-");
        expenses.push(-delta);
        level += delta;
      }
    });

    return { labels: labels, help: help, income: income, expenses: expenses };
  }

  function buildWaterfallOption() {
    var w = buildWaterfallSeries(SKILLS);

    return {
      title: {
        text: "Accumulated Waterfall Chart",
        left: "center",
        textStyle: {
          fontFamily: "Montserrat, Poppins, sans-serif",
          fontWeight: 700,
          fontSize: 18,
          color: "#4b5563",
        },
      },
      tooltip: {
        trigger: "axis",
        axisPointer: { type: "shadow" },
        formatter: function (params) {
          var tar;
          if (params[1] && params[1].value !== "-") tar = params[1];
          else tar = params[2];
          if (!tar || tar.value === "-") return "";
          return tar.name + "<br/>" + tar.seriesName + " : " + tar.value;
        },
      },
      legend: {
        data: ["Expenses", "Income"],
        bottom: 0,
        textStyle: {
          fontFamily: "Poppins, Open Sans, sans-serif",
          color: "#4b5563",
        },
      },
      grid: {
        left: "3%",
        right: "4%",
        bottom: "12%",
        top: 56,
        containLabel: true,
      },
      xAxis: {
        type: "category",
        splitLine: { show: false },
        data: w.labels,
        axisLabel: {
          interval: 0,
          rotate: 28,
          fontSize: 10,
          color: "#4b5563",
        },
        axisTick: { alignWithLabel: true },
      },
      yAxis: {
        type: "value",
        splitLine: {
          lineStyle: { color: "rgba(0,0,0,0.08)" },
        },
        axisLabel: { color: "#6b7280" },
      },
      series: [
        {
          name: "Placeholder",
          type: "bar",
          stack: "Total",
          silent: true,
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
          data: w.help,
        },
        {
          name: "Income",
          type: "bar",
          stack: "Total",
          label: {
            show: true,
            position: "top",
            color: "#4b5563",
            fontSize: 11,
            fontWeight: 600,
          },
          itemStyle: {
            color: "#5470c6",
          },
          data: w.income,
        },
        {
          name: "Expenses",
          type: "bar",
          stack: "Total",
          label: {
            show: true,
            position: "bottom",
            color: "#4b5563",
            fontSize: 11,
            fontWeight: 600,
          },
          itemStyle: {
            color: "#91cc75",
          },
          data: w.expenses,
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
    chart.setOption(buildWaterfallOption(), true);
    chart.resize();
  }

  function boot() {
    initChart();
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
