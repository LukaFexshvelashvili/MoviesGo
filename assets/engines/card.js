$(document).on("click", ".mg_card_bookmark, .movie_bookmark", function () {
  let movie_id = $(this).attr("data-movie");
  if (movie_id) {
    $.get(server_start_local + "/actions/bookmark.php", { id: movie_id });
    $(this).toggleClass("bookmarked");
  }
});

const mg_card = document.querySelectorAll(".mg_card, .mg_card_wide");

function loadCards() {
  document.querySelectorAll(".mg_card_image").forEach((item) => {
    const loader = item
      .closest(".mg_img_side")
      ?.querySelector(".mg_card_loader");
    if (item.complete) {
      loader?.remove();
    } else {
      item.addEventListener("load", () => loader?.remove(), { once: true });
    }
  });
}
loadCards();
