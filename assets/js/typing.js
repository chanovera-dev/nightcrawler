document.addEventListener("DOMContentLoaded", function () {
  const titleEl = document.querySelector(".site-main header.block .content .subtitle");

  if (titleEl) {
    const titleText = titleEl.textContent.trim();

    titleEl.textContent = "";

    function typeText(el, text, speed, callback) {
      let i = 0;
      function type() {
        if (i < text.length) {
          el.textContent += text.charAt(i);
          i++;
          setTimeout(type, speed);
        } else if (typeof callback === 'function') {
          callback();
        }
      }
      type();
    }

    setTimeout(() => {
      typeText(titleEl, titleText, 40, () => {
        setTimeout(() => {}, 500);
      });
    }, 600);
  }
});