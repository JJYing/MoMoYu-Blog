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

  function initDraftLightbox() {
    var draftImages = document.querySelectorAll(".draft-list .draft-item img");
    if (!draftImages.length) return;

    var overlay = document.createElement("div");
    overlay.className = "lightbox";
    overlay.setAttribute("aria-hidden", "true");

    var closeBtn = document.createElement("button");
    closeBtn.className = "lightbox-close";
    closeBtn.type = "button";
    closeBtn.setAttribute("aria-label", "Close image preview");
    closeBtn.textContent = "×";

    var content = document.createElement("div");
    content.className = "lightbox-content";

    var image = document.createElement("img");
    image.className = "lightbox-image";
    image.alt = "";

    var caption = document.createElement("p");
    caption.className = "lightbox-caption";

    content.appendChild(image);
    overlay.appendChild(closeBtn);
    overlay.appendChild(content);
    overlay.appendChild(caption);
    document.body.appendChild(overlay);

    function closeLightbox() {
      overlay.classList.remove("is-open");
      overlay.setAttribute("aria-hidden", "true");
      image.removeAttribute("src");
      image.alt = "";
      caption.textContent = "";
      document.body.classList.remove("lightbox-open");
    }

    function openLightbox(src, alt) {
      if (!src) return;
      image.src = src;
      image.alt = alt || "";
      caption.textContent = alt || "";
      overlay.classList.add("is-open");
      overlay.setAttribute("aria-hidden", "false");
      document.body.classList.add("lightbox-open");
    }

    overlay.addEventListener("click", function (event) {
      if (!overlay.classList.contains("is-open")) return;
      if (event.target === image || closeBtn.contains(event.target)) return;
      closeLightbox();
    });

    closeBtn.addEventListener("click", closeLightbox);

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && overlay.classList.contains("is-open")) {
        closeLightbox();
      }
    });

    for (var i = 0; i < draftImages.length; i++) {
      (function (img) {
        var trigger = img.closest(".draft-item");
        if (!trigger) return;

        trigger.addEventListener("click", function (event) {
          event.preventDefault();
          var fullSrc = trigger.getAttribute("href") || img.currentSrc || img.src;
          var draftTextNode = trigger.querySelector(".draft-text");
          var captionText = draftTextNode ? draftTextNode.textContent.trim() : "";
          openLightbox(fullSrc, captionText);
        });
      })(draftImages[i]);
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () {
      updateRelativeTimes();
      initDraftLightbox();
    });
  } else {
    updateRelativeTimes();
    initDraftLightbox();
  }
})();
