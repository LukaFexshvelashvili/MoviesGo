const mg_card_description = document.createElement("div");
const mg_card = document.querySelectorAll(".mg_card, .mg_card_wide");
mg_card_description.classList.add("mg_card_description");
document.body.appendChild(mg_card_description);
function initializeCardDesc() {
  mg_card.forEach((item) => {
    const mg_card_display_description = item.querySelector(
      "#mg_card_display_description"
    );
    const mg_card_display_genres = item.querySelector(
      "#mg_card_display_genres"
    );
    item.addEventListener("mouseenter", function (e) {
      mg_card_description.classList.add("mg_card_description_active");
      mg_card_description.innerHTML = `  <h3> ${mg_card_display_description.innerHTML}
      </h3>
      <p> ${mg_card_display_genres.innerHTML}</p>`;
      let X = e.screenX;
      let Y = e.screenY;

      mg_card_description.style.left = X + 20 + "px";
      mg_card_description.style.top = Y + "px";
    });

    item.addEventListener("mousemove", function (e) {
      let X = e.screenX;
      let Y = e.screenY;

      mg_card_description.style.left = X + 20 + "px";
      mg_card_description.style.top = Y + "px";
    });
    item.addEventListener("mouseleave", function () {
      mg_card_description.innerHTML = ``;
      mg_card_description.classList.remove("mg_card_description_active");
    });
  });
}
initializeCardDesc();

document.querySelectorAll(".mg_card_image").forEach((item) => {
  if (item.complete) {
    item.closest(".mg_img_side")?.querySelector(".mg_card_loader")?.remove();
  } else {
    item.addEventListener("load", () => {
      item.closest(".mg_img_side")?.querySelector(".mg_card_loader")?.remove();
    });
  }
});
