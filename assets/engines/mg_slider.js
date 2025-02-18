const mg_slider = document.querySelector(".mg_slider");

const mg_slider_left = document.querySelector(".mg_slider_left");
const mg_slider_right = document.querySelector(".mg_slider_right");
const mg_slider_row = document.querySelector(".mg_slider_row");
const mg_slider_indicators = document.querySelector(".mg_slider_indicators");

mg_slider_left.addEventListener("click", () => changeSlider("left"));
mg_slider_right.addEventListener("click", () => changeSlider("right"));

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
  let maxSlider = mg_slider_row.children.length;
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

  Array.from(mg_slider_row.children).forEach((item) =>
    item.classList.remove("mg_slider_card_active")
  );
  mg_slider_row.children[activeSlider].classList.add("mg_slider_card_active");

  changeIndicators();
}
function changeActiveSlide(id) {
  activeSlider = id;
  Array.from(mg_slider_row.children).forEach((item) =>
    item.classList.remove("mg_slider_card_active")
  );
  mg_slider_row.children[activeSlider].classList.add("mg_slider_card_active");
  changeIndicators();
}

initializePlayer();

// SLIDES
let startX;
let isMouseDown = false;

// Touch Events
mg_slider.addEventListener(
  "touchstart",
  (e) => {
    startSwipe(e.touches[0].clientX);
  },
  { passive: true }
);
mg_slider.addEventListener(
  "touchend",
  (e) => {
    endSwipe(e.changedTouches[0].clientX);
  },
  { passive: true }
);

// Mouse Events
mg_slider.addEventListener(
  "mousedown",
  (e) => {
    isMouseDown = true;
    startSwipe(e.clientX);
  },
  { passive: true }
);

mg_slider.addEventListener(
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
  const indicators = Array.from(mg_slider_indicators.children);
  indicators.forEach((item) =>
    item.classList.remove("mg_slider_indicator_active")
  );

  indicators[activeSlider].classList.add("mg_slider_indicator_active");
}
// ${item.genres.map((genre) => `<div>${genre}</div>`).join("")}
function initializePlayer() {
  const indicators = Array.from(mg_slider_indicators.children);
  indicators.forEach((item, index) => {
    item.addEventListener("click", () => {
      changeActiveSlide(index);
    });
  });
}

function initializeBookmarks() {
  if (!localStorage.getItem("mg_bookmarks")) {
    localStorage.setItem("mg_bookmarks", JSON.stringify([]));
  }
}
initializeBookmarks();

const mg_slider_bookmarks = document.querySelectorAll(".mg_slider_bookmark");

mg_slider_bookmarks.forEach((item) => {
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
