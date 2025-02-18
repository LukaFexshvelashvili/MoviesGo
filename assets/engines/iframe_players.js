const iframe_players = document.querySelectorAll(".iframe_player_box");

iframe_players.forEach((iframe_player) => {
  initializeIframePlayer(iframe_player);
});

function initializeIframePlayer(iframe_player) {
  let active_season = 1;
  let active_episode = 1;
  const player_index = iframe_player.getAttribute("data-player");

  const iframe_player_seasons = iframe_player.querySelector(
    ".iframe_player_seasons"
  );
  const iframe_loader = iframe_player.querySelector(".iframe_loader");
  const iframe_player_eps_scroll = iframe_player.querySelector(
    ".iframe_player_eps_scroll"
  );
  const iframe_player_ep_button = iframe_player.querySelector(
    ".iframe_player_ep_button"
  );
  const iframe_player_eps_container = iframe_player.querySelector(
    ".iframe_player_eps_container"
  );
  const iframe_eps_closer = iframe_player.querySelector(".iframe_eps_closer");
  const iframe = iframe_player.querySelector("iframe");

  if (localStorage.getItem("iframe_player")) {
    let iframe_save_ = localStorage.getItem("iframe_player");
    let iframe_save = JSON.parse(iframe_save_);
    let get_cur = iframe_save.filter((item) => {
      return item.id == IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index;
    });
    if (get_cur.length !== 0) {
      movetoFirstItem(
        iframe_save,
        iframe_save.findIndex((item) => item.id == get_cur[0].id)
      );

      if (
        get_cur[0].season <=
          Object.keys(IFRAME_PLAYERS.PLAYERS[player_index]).length &&
        get_cur[0].episode <=
          IFRAME_PLAYERS.PLAYERS[player_index][get_cur[0].season].length
      ) {
        active_season = get_cur[0].season;
        active_episode = get_cur[0].episode;
        setTimeout(() => {
          const seasonElement = iframe_player_seasons.querySelector(
            `[data-season="${get_cur[0]?.season}"]`
          );
          const episodeElement = iframe_player_eps_scroll.querySelector(
            `[data-ep="${get_cur[0]?.episode}"]`
          );

          if (seasonElement && iframe_player_seasons) {
            iframe_player_seasons.scrollTop =
              seasonElement.offsetTop - iframe_player_seasons.offsetTop - 100;
          }

          if (episodeElement && iframe_player_eps_scroll) {
            iframe_player_eps_scroll.scrollTop =
              episodeElement.offsetTop -
              iframe_player_eps_scroll.offsetTop -
              100;
          }
        }, 0);

        changeEpisode(getEpisodeRequest());
      } else {
        active_season = 1;
        active_episode = 1;
      }
    } else {
      iframe_save.unshift({
        id: IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index,
        episode: 1,
        season: 1,
      });
    }
  } else {
    localStorage.setItem(
      "iframe_player",
      JSON.stringify([
        {
          id: IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index,
          episode: 1,
          season: 1,
        },
      ])
    );
  }

  iframe_player_ep_button.addEventListener("click", () => {
    iframe_player_eps_container.classList.add(
      "iframe_player_eps_container_show"
    );
    iframe_player_ep_button.classList.add("iframe_player_ep_button_hide");
  });
  iframe_eps_closer.addEventListener("click", () => {
    close_episodes();
  });
  function close_episodes() {
    iframe_player_eps_container.classList.remove(
      "iframe_player_eps_container_show"
    );
    iframe_player_ep_button.classList.remove("iframe_player_ep_button_hide");
  }

  function initialiseEpisodes() {
    if (active_season == null && active_episode == null) {
      active_season = 1;
      active_episode = 1;
    }
    printSeasons();
    printEpisodes();
  }
  initialiseEpisodes();

  function printSeasons() {
    iframe_player_seasons.innerHTML = "";
    for (const [season] of Object.entries(
      IFRAME_PLAYERS.PLAYERS[player_index]
    )) {
      iframe_player_seasons.innerHTML += `<div data-season="${season}" class="iframe_se_button ${
        active_season == season ? "iframe_se_button_active" : ""
      } ">
            ${season}
          </div>`;
    }
    let iframe_ses_childrens = Array.from(iframe_player_seasons.children);
    iframe_ses_childrens.forEach((item) => {
      item.addEventListener("click", () => {
        active_season = item.getAttribute("data-season");
        printEpisodes();
        iframe_ses_childrens.forEach((k) =>
          k.classList.remove("iframe_se_button_active")
        );
        item.classList.add("iframe_se_button_active");
      });
    });
  }
  function printEpisodes() {
    const curSE = getCurStorage() == null ? 1 : getCurStorage().season;
    iframe_player_eps_scroll.innerHTML = "";
    IFRAME_PLAYERS.PLAYERS[player_index][active_season].forEach(
      (item, index) => {
        index += 1;
        iframe_player_eps_scroll.innerHTML += `<div data-ep="${index}" class="iframe_ep_button ${
          active_episode == index && curSE == active_season
            ? "iframe_ep_button_active"
            : ""
        } ">
              ${index} ეპიზოდი
              </div>`;
      }
    );
    let iframe_eps_childrens = Array.from(iframe_player_eps_scroll.children);
    iframe_eps_childrens.forEach((item) => {
      item.addEventListener("click", () => {
        active_episode = item.getAttribute("data-ep");

        changeEpisode(getEpisodeRequest());
        iframe_eps_childrens.forEach((k) =>
          k.classList.remove("iframe_ep_button_active")
        );
        item.classList.add("iframe_ep_button_active");
        close_episodes();
      });
    });
  }
  iframe.addEventListener("load", () => {
    iframe_loader.classList.add("iframe_loader_hide");
  });
  function changeEpisode(episode) {
    iframe_loader.classList.remove("iframe_loader_hide");
    iframe.src = episode;
    close_episodes();
    localsave();
  }

  function getEpisodeRequest() {
    return IFRAME_PLAYERS.PLAYERS[player_index][active_season][
      active_episode - 1
    ].languages["GEO"]
      ? IFRAME_PLAYERS.PLAYERS[player_index][active_season][active_episode - 1]
          .languages["GEO"]["HD"]
        ? IFRAME_PLAYERS.PLAYERS[player_index][active_season][
            active_episode - 1
          ].languages["GEO"]["HD"]
        : Object.values(
            IFRAME_PLAYERS.PLAYERS[player_index][active_season][
              active_episode - 1
            ].languages["GEO"]
          )[0]
      : Object.values(
          Object.values(
            IFRAME_PLAYERS.PLAYERS[player_index][active_season][
              active_episode - 1
            ].languages
          )[0]
        )[0];
  }
  function movetoFirstItem(array, fromIndex) {
    if (fromIndex < 0 || fromIndex >= array.length) {
      return array;
    }

    const item = array.splice(fromIndex, 1)[0];
    array.splice(0, 0, item);
    return array;
  }
  function cutIfTooLarge(list, number) {
    if (list.length > number) {
      list.splice(number);
    }
  }

  function getCurStorage() {
    if (localStorage.getItem("iframe_player")) {
      let iframe_save_ = localStorage.getItem("iframe_player");
      let iframe_save = JSON.parse(iframe_save_);
      let get_cur = iframe_save.filter((item) => {
        return item.id == IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index;
      });
      if (get_cur.length == 0) {
        return null;
      }
      return get_cur[0];
    } else {
      return null;
    }
  }
  function localsave() {
    if (localStorage.getItem("iframe_player")) {
      let iframe_save_ = localStorage.getItem("iframe_player");
      let iframe_save = JSON.parse(iframe_save_);
      let is_saved = getCurStorage() == null ? false : true;
      if (is_saved) {
        let ind = iframe_save.findIndex(
          (item) => item.id == IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index
        );
        iframe_save[ind].episode = parseInt(active_episode);
        iframe_save[ind].season = parseInt(active_season);
      } else {
        iframe_save.unshift({
          id: IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index,
          episode: parseInt(active_episode),
          season: parseInt(active_season),
        });
      }
      cutIfTooLarge(iframe_save, 5);
      localStorage.setItem("iframe_player", JSON.stringify(iframe_save));
    } else {
      localStorage.setItem(
        "iframe_player",
        JSON.stringify([
          {
            id: IFRAME_PLAYERS.PLAYER_ID + "p=" + player_index,
            episode: parseInt(active_episode),
            season: parseInt(active_season),
          },
        ])
      );
    }
  }
}
