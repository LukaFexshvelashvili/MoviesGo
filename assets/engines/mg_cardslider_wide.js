const mg_cardslider_wide = document.querySelectorAll(".mg_cardslider_wide");

mg_cardslider_wide.forEach((currentSlider) => {
  const mg_cardslider_row = currentSlider.querySelector(
    ".mg_cardslider_wide_row"
  );
  const mg_cardslider_left = currentSlider.querySelector(".mg_cardslider_left");
  const mg_cardslider_right = currentSlider.querySelector(
    ".mg_cardslider_right"
  );
  const gap = 10;
  const list = ["", "", "", "", "", "", "", "", "", "", "", ""];

  // EVENTS
  mg_cardslider_left.addEventListener("click", scrollSliderLeft);
  mg_cardslider_right.addEventListener("click", scrollSliderRight);

  let isMouseDown = false;
  let startX = 0;
  let scrollLeft = 0;

  // Mouse drag events
  mg_cardslider_row.addEventListener("mousedown", (e) => {
    isMouseDown = true;
    startX = e.pageX - mg_cardslider_row.offsetLeft;
    scrollLeft = mg_cardslider_row.scrollLeft;
  });

  mg_cardslider_row.addEventListener("mouseleave", () => {
    isMouseDown = false;
  });

  mg_cardslider_row.addEventListener("mouseup", () => {
    isMouseDown = false;
  });

  mg_cardslider_row.addEventListener("mousemove", (e) => {
    if (!isMouseDown) return;
    const x = e.pageX - mg_cardslider_row.offsetLeft;
    const walk = (x - startX) * 1;
    mg_cardslider_row.scrollLeft = scrollLeft - walk;
  });

  function scrollSliderLeft() {
    mg_cardslider_row.style.scrollBehavior = "smooth";
    mg_cardslider_row.scrollLeft -=
      mg_cardslider_row.firstElementChild.clientWidth + gap;
    mg_cardslider_row.style.scrollBehavior = "unset";
  }
  function scrollSliderRight() {
    mg_cardslider_row.style.scrollBehavior = "smooth";

    mg_cardslider_row.scrollLeft +=
      mg_cardslider_row.firstElementChild.clientWidth + gap;
    mg_cardslider_row.style.scrollBehavior = "unset";
  }
  initializeSlider();

  function initializeSlider() {
    list.forEach((item) => {
      mg_cardslider_row.innerHTML += `<div class="mg_card_wide">
            <div class="mg_info_grab">
              <h3 id="mg_card_display_description">
                მოკლე აღწერა:
                <span class="mg_card_description_p">
                  სერიალი კოკაინის ეპიდემიის დაწყებაზე ლოს ანჯელესში 1980-იან
                  წლებში. როდესაც ამერიკის ქუჩებში გაჩნდა იაფიანი კრეკი და
                  კანონდარღვევები გაიზარდა. სამი განსხვავებული ადამიანის თვალით
                  დანახული მოვლენები.
                </span>
              </h3>
              <p id="mg_card_display_genres">
                <span>ჟანრები:</span> დრამა, მძაფრსიუჟეტიანი, დეტექტივი
              </p>
            </div>
            <div class="mg_img_side">
              <img loading="lazy" src="../assets/images/snowfallwide.png" />
              <div class="mg_card_shadow"></div>
              <div class="mg_card_bookmark cnt">
             <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"/></svg>
              </div>
              <div class="mg_card_info">
                <div class="starter">
                  <div>SNOWFALL</div>
                  <div>თოვა</div>
                </div>
                <div class="laster">
                  <div class="mg_card_imdb">IMDB: 8.4</div>
                </div>
              </div>
            </div>
          </div>`;
    });
  }
});
