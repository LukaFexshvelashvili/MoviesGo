const mg_card_bookmark = document.querySelectorAll(
  ".mg_card_bookmark, .movie_bookmark"
);

mg_card_bookmark.forEach((item) =>
  item.addEventListener("click", function () {
    let movie_id = this.getAttribute("data-movie");
    if (movie_id) {
      $.get(server_start_local + "/actions/bookmark.php", {
        id: movie_id,
      });
      this.classList.toggle("bookmarked");
    }
  })
);

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

function loadCards() {
  document.querySelectorAll(".mg_card_image").forEach((item) => {
    const loader = item
      .closest(".mg_img_side")
      ?.querySelector(".mg_card_loader");

    if (item.complete) {
      loader?.remove();
    } else {
      item.addEventListener(
        "load",
        () => loader?.remove(),
        { once: true } // Ensures the event listener is only triggered once
      );
    }
  });
}
loadCards();
