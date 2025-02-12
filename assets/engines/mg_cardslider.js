const mg_cardslider = document.querySelectorAll(".mg_cardslider");
mg_cardslider.forEach((currentSlider) => {
  const mg_cardslider_row = currentSlider.querySelector(".mg_cardslider_row");
  const mg_cardslider_left = currentSlider.querySelector(".mg_cardslider_left");
  const mg_cardslider_right = currentSlider.querySelector(
    ".mg_cardslider_right"
  );
  const gap = 20;
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
      mg_cardslider_row.innerHTML += `<div class="mg_card">
    <div class="mg_info_grab">
     <h3 id="mg_card_display_description">
        მოკლე აღწერა:
        <span class="mg_card_description_p">
          სერიალი კოკაინის ეპიდემიის დაწყებაზე ლოს ანჯელესში 1980-იან
          წლებში. როდესაც ამერიკის ქუჩებში გაჩნდა იაფიანი კრეკი და
          კანონდარღვევები გაიზარდა. სამი განსხვავებული ადამიანის
          თვალით დანახული მოვლენები.
        </span>
      </h3>
      <p id="mg_card_display_genres"><span>ჟანრები:</span> დრამა, მძაფრსიუჟეტიანი, დეტექტივი</p>
    </div>
            <div class="mg_img_side">

                
              <div class="mg_card_play">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    fill="currentColor"
                    d="M133 440a35.37 35.37 0 0 1-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0 1 35.77.45l247.85 148.36a36 36 0 0 1 0 61l-247.89 148.4A35.5 35.5 0 0 1 133 440Z"
                  />
                </svg>
              </div>
              <img src="../assets/images/Snowfall.webp" />
              <div class="mg_card_shadow"></div>
              <div class="mg_card_bookmark cnt">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M2.04125 3.49503C2.99375 2.44878 4.35375 1.87378 5.95 1.87378C7.405 1.87378 8.95875 2.56128 10 3.90628C11.035 2.56253 12.5825 1.87378 14.05 1.87378C15.6425 1.87378 17 2.44628 17.955 3.49003C18.9 4.52503 19.375 5.94253 19.375 7.51503C19.375 10.2225 17.9837 12.4013 16.2225 14.095C14.4662 15.785 12.26 17.0738 10.4313 18.02C10.2973 18.0893 10.1486 18.1253 9.99782 18.1248C9.84702 18.1244 9.69854 18.0876 9.565 18.0175C7.73625 17.0613 5.53 15.7825 3.77375 14.1013C2.0125 12.4125 0.625 10.2413 0.625 7.51628C0.625 5.94753 1.0975 4.53003 2.04125 3.49503ZM3.4275 4.75753C2.85875 5.38253 2.5 6.31628 2.5 7.51628C2.5 9.54628 3.52 11.2613 5.07125 12.7463C6.50375 14.1188 8.32125 15.2275 10.0025 16.1275C11.6712 15.24 13.49 14.1225 14.9237 12.7438C16.4775 11.2475 17.5 9.52503 17.5 7.51628C17.5 6.31253 17.14 5.37878 16.57 4.75378C16.01 4.14253 15.175 3.75003 14.05 3.75003C12.83 3.75003 11.4338 4.53503 10.8913 6.18753C10.8299 6.37555 10.7107 6.53935 10.5506 6.6555C10.3905 6.77165 10.1978 6.8342 10 6.8342C9.80222 6.8342 9.60951 6.77165 9.44943 6.6555C9.28935 6.53935 9.1701 6.37555 9.10875 6.18753C8.5675 4.53753 7.15625 3.75003 5.95 3.75003C4.82125 3.75003 3.9875 4.14253 3.4275 4.75753Z"
                    fill="#8B8B8B"
                  ></path>
                </svg>
              </div>
              <div class="mg_card_type cnt">სერიალი</div>
              <div class="mg_card_year cnt">2024წ</div>
            </div>
            <div class="mg_card_info">
              <div>SNOWFALL</div>
              <div>თოვა</div>
              <div class="mg_card_imdb">IMDB: 8.4</div>
            </div>
          </div>`;
    });
  }
});
