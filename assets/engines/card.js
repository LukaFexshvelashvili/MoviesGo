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

const mg_card = document.querySelectorAll(".mg_card, .mg_card_wide");

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
