const mg_cardslider = document.querySelectorAll(".mg_cardslider");
mg_cardslider.forEach((currentSlider) => {
  const mg_cardslider_row = currentSlider.querySelector(".mg_cardslider_row");
  const mg_cardslider_left = currentSlider.querySelector(".mg_cardslider_left");
  const mg_cardslider_right = currentSlider.querySelector(
    ".mg_cardslider_right"
  );
  const gap = 20;

  // EVENTS
  mg_cardslider_left.addEventListener("click", scrollSliderLeft);
  mg_cardslider_right.addEventListener("click", scrollSliderRight);

  let isDragging = false;
  let isMouseDown = false;
  let startX = 0;
  let scrollLeft = 0;

  // Mouse drag events
  mg_cardslider_row.addEventListener("mousedown", (e) => {
    isMouseDown = true;
    startX = e.pageX - mg_cardslider_row.offsetLeft;
    scrollLeft = mg_cardslider_row.scrollLeft;
  });

  mg_cardslider_row.addEventListener("click", (e) => {
    if (isDragging) {
      e.preventDefault();
    }
  });

  document.addEventListener("mouseup", (e) => {
    isMouseDown = false;
    setTimeout(() => {
      isDragging = false;
    }, 50);
  });

  document.addEventListener("mousemove", (e) => {
    if (!isMouseDown) return;
    isDragging = true;
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
  // initializeSlider();

  // function initializeSlider() {
  //   list.forEach((item) => {
  //     mg_cardslider_row.innerHTML += `<div class="mg_card">
  //   <div class="mg_info_grab">
  //    <h3 id="mg_card_display_description">
  //       მოკლე აღწერა:
  //       <span class="mg_card_description_p">
  //         სერიალი კოკაინის ეპიდემიის დაწყებაზე ლოს ანჯელესში 1980-იან
  //         წლებში. როდესაც ამერიკის ქუჩებში გაჩნდა იაფიანი კრეკი და
  //         კანონდარღვევები გაიზარდა. სამი განსხვავებული ადამიანის
  //         თვალით დანახული მოვლენები.
  //       </span>
  //     </h3>
  //     <p id="mg_card_display_genres"><span>ჟანრები:</span> დრამა, მძაფრსიუჟეტიანი, დეტექტივი</p>
  //   </div>
  //           <div class="mg_img_side">

  //             <div class="mg_card_play">
  //               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
  //                 <path
  //                   fill="currentColor"
  //                   d="M133 440a35.37 35.37 0 0 1-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0 1 35.77.45l247.85 148.36a36 36 0 0 1 0 61l-247.89 148.4A35.5 35.5 0 0 1 133 440Z"
  //                 />
  //               </svg>
  //             </div>
  //             <img loading="lazy" src="../assets/images/Snowfall.webp" />
  //             <div class="mg_card_shadow "></div>
  //             <div class="mg_card_bookmark cnt">
  //                          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"/></svg>

  //             </div>
  //             <div class="mg_card_type cnt">სერიალი</div>
  //             <div class="mg_card_year cnt">2024წ</div>
  //             <div class="mg_card_imdb cnt">IMDB: 8.4</div>

  //           </div>
  //           <div class="mg_card_info">
  //               <div class="mg_card_info_f">
  //                 <div class="card_info_text">SNOWFALL</div>
  //                 <div class="card_info_text">თოვა</div>
  //                 </div>
  //                 <div class="mg_card_info_e">
  //                 <div class="mg_card_bookmark cnt">
  //            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"/></svg>
  //           </div>
  //         </div>`;
  //   });
  // }
});
