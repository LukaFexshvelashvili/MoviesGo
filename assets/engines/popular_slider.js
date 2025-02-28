const popular_slider = document.querySelector(".popular_slider");

const popular_slider_row = document.querySelector(".popular_slider_row");
const popular_slider_indicators = document.querySelector(
  ".popular_slider_indicators"
);

function initializeSlider() {
  let userSlided = false;
  let activeSlider = 0;
  let autoslidetime = 4000;
  let intslide;

  intslide = setInterval(() => {
    if (!userSlided) {
      changeSlider("right", true);
    } else {
      userSlided = false;
    }
  }, autoslidetime);

  function changeSlider(slide, notUser) {
    if (!notUser) {
      userSlided = true;
    }
    let maxSlider = popular_slider_row.children.length;
    if (slide === "right") {
      if (activeSlider < maxSlider - 1) {
        activeSlider++;
      } else {
        activeSlider = 0;
      }
    } else if (slide === "left") {
      if (activeSlider > 0) {
        activeSlider--;
      } else {
        activeSlider = maxSlider - 1;
      }
    }

    Array.from(popular_slider_row.children).forEach((item) =>
      item.classList.remove("popular_slider_card_active")
    );
    popular_slider_row.children[activeSlider].classList.add(
      "popular_slider_card_active"
    );

    changeIndicators();
  }
  function changeActiveSlide(id) {
    activeSlider = id;
    Array.from(popular_slider_row.children).forEach((item) =>
      item.classList.remove("popular_slider_card_active")
    );
    popular_slider_row.children[activeSlider].classList.add(
      "popular_slider_card_active"
    );
    changeIndicators();
  }

  initializePlayer();

  // SLIDES
  let startX;
  let isMouseDown = false;

  // Touch Events
  popular_slider.addEventListener(
    "touchstart",
    (e) => {
      startSwipe(e.touches[0].clientX);
    },
    { passive: true }
  );
  popular_slider.addEventListener(
    "touchend",
    (e) => {
      endSwipe(e.changedTouches[0].clientX);
    },
    { passive: true }
  );

  // Mouse Events
  popular_slider.addEventListener(
    "mousedown",
    (e) => {
      isMouseDown = true;
      startSwipe(e.clientX);
    },
    { passive: true }
  );

  popular_slider.addEventListener(
    "mouseup",
    (e) => {
      if (isMouseDown) {
        endSwipe(e.clientX);
        isMouseDown = false;
      }
    },
    { passive: true }
  );

  function startSwipe(x) {
    startX = x;
  }

  function endSwipe(endX) {
    let deltaX = startX - endX;

    if (Math.abs(deltaX) > 50) {
      if (deltaX > 0) {
        //   "right"
        changeSlider("right");
      } else {
        // "left"
        changeSlider("left");
      }
    }
  }
  function changeIndicators() {
    const indicators = Array.from(popular_slider_indicators.children);
    indicators.forEach((item) =>
      item.classList.remove("popular_slider_indicator_active")
    );

    indicators[activeSlider].classList.add("popular_slider_indicator_active");
  }
  // ${item.genres.map((genre) => `<div>${genre}</div>`).join("")}
  function initializePlayer() {
    const indicators = Array.from(popular_slider_indicators.children);
    indicators.forEach((item, index) => {
      item.addEventListener("click", () => {
        changeActiveSlide(index);
      });
    });
  }

  function initializeBookmarks() {
    if (!localStorage.getItem("popular_bookmarks")) {
      localStorage.setItem("popular_bookmarks", JSON.stringify([]));
    }
  }
  initializeBookmarks();

  const popular_slider_bookmarks = document.querySelectorAll(
    ".popular_slider_bookmark"
  );

  popular_slider_bookmarks.forEach((item) => {
    item.addEventListener("click", function () {
      let movie_id = this.getAttribute("data-movie");
      if (movie_id) {
        $.get(server_start_local + "/actions/bookmark.php", {
          id: movie_id,
        });
        this.classList.toggle("bookmarked");
      }
    });
  });
}
initializeSlider();
