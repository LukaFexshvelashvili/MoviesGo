import { mg_slider_items } from "../../ui/slideritems.js";

const mg_slider = document.querySelector(".mg_slider");

const mg_slider_row = document.createElement("div");
mg_slider_row.classList.add("mg_slider_row");
mg_slider.appendChild(mg_slider_row);

const mg_slider_indicators = document.createElement("div");
mg_slider_indicators.classList.add("mg_slider_indicators");
mg_slider.appendChild(mg_slider_indicators);

let activeSlider = 0;
function changeSlider(slide) {
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
mg_slider.addEventListener("touchstart", (e) =>
  startSwipe(e.touches[0].clientX)
);
mg_slider.addEventListener("touchend", (e) =>
  endSwipe(e.changedTouches[0].clientX)
);

// Mouse Events
mg_slider.addEventListener("mousedown", (e) => {
  isMouseDown = true;
  startSwipe(e.clientX);
});

mg_slider.addEventListener("mouseup", (e) => {
  if (isMouseDown) {
    endSwipe(e.clientX);
    isMouseDown = false;
  }
});

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

function initializePlayer() {
  mg_slider_items.forEach((item, index) => {
    mg_slider_indicators.innerHTML += `<div class="mg_slider_indicator${
      index == 0 ? " mg_slider_indicator_active" : ""
    }"></div>`;
    mg_slider_row.innerHTML += `  <div class="mg_slider_card${
      index == 0 ? " mg_slider_card_active" : ""
    }">
      <div class="mg_slider_shadow"></div>

            <img loading="lazy" src="${item.image}" alt="${
      item.altimage
    }" class="mg_slider_img" />
            <div class="mg_slider_info">
              <div class="mg_slider_genres">
                 ${item.genres.map((genre) => `<div>${genre}</div>`).join("")}
              </div>
              <div class="mg_slider_subtitle">${item.subtitle}</div>
              <div class="mg_slider_title">${item.title}</div>
              <div class="mg_slider_imdb">IMDB: ${item.imdb}</div>
            </div>
            <div class="mg_slider_actions">
              <div data-id="${item.id}" class="mg_slider_icon mg_slider_love">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"></path></svg>
              </div>
              <div data-id="${
                item.id
              }" class="mg_slider_icon mg_slider_watchlater">
                <svg
                  
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12 2C9.43639 2.00731 6.97349 2.99891 5.12 4.77V3C5.12 2.73478 5.01464 2.48043 4.82711 2.29289C4.63957 2.10536 4.38522 2 4.12 2C3.85478 2 3.60043 2.10536 3.41289 2.29289C3.22536 2.48043 3.12 2.73478 3.12 3V7.5C3.12 7.76522 3.22536 8.01957 3.41289 8.20711C3.60043 8.39464 3.85478 8.5 4.12 8.5H8.62C8.88522 8.5 9.13957 8.39464 9.32711 8.20711C9.51464 8.01957 9.62 7.76522 9.62 7.5C9.62 7.23478 9.51464 6.98043 9.32711 6.79289C9.13957 6.60536 8.88522 6.5 8.62 6.5H6.22C7.50578 5.15636 9.21951 4.30266 11.0665 4.08567C12.9136 3.86868 14.7785 4.30198 16.3407 5.31105C17.9028 6.32012 19.0646 7.84191 19.6263 9.61479C20.188 11.3877 20.1145 13.3009 19.4184 15.0254C18.7223 16.7499 17.4472 18.1781 15.8122 19.0643C14.1772 19.9505 12.2845 20.2394 10.4596 19.8813C8.63463 19.5232 6.99147 18.5405 5.81259 17.1022C4.63372 15.6638 3.99279 13.8597 4 12C4 11.7348 3.89464 11.4804 3.70711 11.2929C3.51957 11.1054 3.26522 11 3 11C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 13.9778 2.58649 15.9112 3.6853 17.5557C4.78412 19.2002 6.3459 20.4819 8.17317 21.2388C10.0004 21.9957 12.0111 22.1937 13.9509 21.8079C15.8907 21.422 17.6725 20.4696 19.0711 19.0711C20.4696 17.6725 21.422 15.8907 21.8079 13.9509C22.1937 12.0111 21.9957 10.0004 21.2388 8.17317C20.4819 6.3459 19.2002 4.78412 17.5557 3.6853C15.9112 2.58649 13.9778 2 12 2ZM12 8C11.7348 8 11.4804 8.10536 11.2929 8.29289C11.1054 8.48043 11 8.73478 11 9V12C11 12.2652 11.1054 12.5196 11.2929 12.7071C11.4804 12.8946 11.7348 13 12 13H14C14.2652 13 14.5196 12.8946 14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12C15 11.7348 14.8946 11.4804 14.7071 11.2929C14.5196 11.1054 14.2652 11 14 11H13V9C13 8.73478 12.8946 8.48043 12.7071 8.29289C12.5196 8.10536 12.2652 8 12 8Z"
                    fill="var(--iconlow)"
                  />
                </svg>
              </div>
            </div>
          </div>`;
  });
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

// function add_history(id) {
//   let saved_bookmarks = JSON.parse(localStorage.getItem("mg_bookmarks")) || [];
//   const maxLength = 20;
//   if (!saved_bookmarks.includes(id)) {
//     saved_bookmarks.unshift(id);
//   } else {
//     saved_bookmarks = saved_bookmarks.filter((item) => item !== id);
//     saved_bookmarks.unshift(id);
//     if (saved_bookmarks.length > maxLength) {
//       saved_bookmarks = saved_bookmarks.slice(0, maxLength);
//     }
//     localStorage.setItem("mg_bookmarks", JSON.stringify(saved_bookmarks));
//   }
// }
