(function () {
  function formatFullDate(date) {
    var year = date.getFullYear();
    var monthNum = date.getMonth() + 1;
    var dayNum = date.getDate();
    return year + " 年 " + monthNum + " 月 " + dayNum + " 日";
  }

  function formatRelative(date, now) {
    var diffMs = now - date;
    if (!isFinite(diffMs)) return null;

    var sec = Math.floor(diffMs / 1000);
    if (sec < 60) return "刚刚";

    var min = Math.floor(sec / 60);
    if (min < 60) return min + " 分钟以前";

    var hour = Math.floor(min / 60);
    if (hour < 24) return hour + " 小时以前";

    var day = Math.floor(hour / 24);
    if (day < 7) return day + " 天以前";

    var week = Math.floor(day / 7);
    if (week === 1) return "上周";
    if (week < 5) return week + " 周以前";

    var month = Math.floor(day / 30);
    
    // 如果是 5 个月以上并且是去年的，显示完整日期
    if (month >= 5 && date.getFullYear() < now.getFullYear()) {
      return formatFullDate(date);
    }
    
    if (month < 12) return month + " 个月以前";

    var year = Math.floor(month / 12);
    // 超过 1 年的都显示完整日期
    return formatFullDate(date);
  }

  function updateRelativeTimes() {
    var nodes = document.querySelectorAll("time[data-relative='true']");
    if (!nodes.length) return;

    var now = new Date();
    for (var i = 0; i < nodes.length; i++) {
      var node = nodes[i];
      var iso = node.getAttribute("datetime");
      if (!iso) continue;

      var date = new Date(iso);
      var text = formatRelative(date, now);
      if (!text) continue;

      node.textContent = text;
      if (!node.getAttribute("title")) {
        node.setAttribute("title", node.getAttribute("data-absolute") || iso);
      }
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", updateRelativeTimes);
  } else {
    updateRelativeTimes();
  }
})();
