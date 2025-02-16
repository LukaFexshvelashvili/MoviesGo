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
});
