const nav = document.querySelector(".navbar");

nav.innerHTML = `
     <div class="container navc">
        <div class="navcont">
          <div class="navwrap">
            <a href="index.html" class="navlogo cnt"> M </a>
            <div class="navinputblock">
              <div class="navsearchshadow nav_mb"></div>
              <div class="navsearch">
                <div class="mg_nav_card">
                  <div class="mg_nav_image">
                    <img src="../assets/images/Snowfall.webp" alt="" />
                  </div>
                  <div class="mg_nav_info">
                    <div class="info_top">
                      <h3>SNOWFALL</h3>
                      <h3>თოვა</h3>
                      <div class="p_info">
                        <p>წელი: <span>2017</span></p>
                        <p>რეჟისორი: <span>ანტონიო</span></p>
                        <div class="nav_card_imdb">IMDb: 8.7</div>
                      </div>
                    </div>
                    <div class="info_bottom">
                      <div class="nav_card_type cnt">სერიალი</div>
                    </div>
                  </div>
                </div>
                <div class="mg_nav_card">
                  <div class="mg_nav_image">
                    <img src="../assets/images/Snowfall.webp" alt="" />
                  </div>
                  <div class="mg_nav_info">
                    <div class="info_top">
                      <h3>SNOWFALL</h3>
                      <h3>თოვა</h3>
                      <div class="p_info">
                        <p>წელი: <span>2017</span></p>
                        <p>რეჟისორი: <span>ანტონიო</span></p>
                        <div class="nav_card_imdb">IMDb: 8.7</div>
                      </div>
                    </div>
                    <div class="info_bottom">
                      <div class="nav_card_type cnt">სერიალი</div>
                    </div>
                  </div>
                </div>
                <div class="mg_nav_card">
                  <div class="mg_nav_image">
                    <img src="../assets/images/Snowfall.webp" alt="" />
                  </div>
                  <div class="mg_nav_info">
                    <div class="info_top">
                      <h3>SNOWFALL</h3>
                      <h3>თოვა</h3>
                      <div class="p_info">
                        <p>წელი: <span>2017</span></p>
                        <p>რეჟისორი: <span>ანტონიო</span></p>
                        <div class="nav_card_imdb">IMDb: 8.7</div>
                      </div>
                    </div>
                    <div class="info_bottom">
                      <div class="nav_card_type cnt">სერიალი</div>
                    </div>
                  </div>
                </div>
              </div>
              <input type="text" class="navinput" placeholder="ძებნა..." />
              <button class="cnt searchnavinput">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M14.0775 14.1L16.6441 16.6667M15.9033 9.65084C15.9033 13.14 13.0841 15.9683 9.60663 15.9683C6.12996 15.9683 3.31079 13.14 3.31079 9.65167C3.31079 6.16083 6.12996 3.33333 9.60663 3.33333C13.0841 3.33333 15.9033 6.16167 15.9033 9.65084Z"
                    stroke="var(--icon)"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
              <button class="cnt nav_mb nav_mb_search_close">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M11.8905 10.315L16.3003 5.90514C16.5096 5.69622 16.6274 5.41271 16.6276 5.11699C16.6279 4.82127 16.5107 4.53755 16.3017 4.32826C16.0928 4.11897 15.8093 4.00125 15.5136 4.00098C15.2179 4.00072 14.9342 4.11795 14.7249 4.32687L10.315 8.73673L5.90514 4.32687C5.69585 4.11758 5.41199 4 5.116 4C4.82002 4 4.53616 4.11758 4.32687 4.32687C4.11758 4.53616 4 4.82002 4 5.116C4 5.41199 4.11758 5.69585 4.32687 5.90514L8.73673 10.315L4.32687 14.7249C4.11758 14.9342 4 15.218 4 15.514C4 15.81 4.11758 16.0938 4.32687 16.3031C4.53616 16.5124 4.82002 16.63 5.116 16.63C5.41199 16.63 5.69585 16.5124 5.90514 16.3031L10.315 11.8933L14.7249 16.3031C14.9342 16.5124 15.218 16.63 15.514 16.63C15.81 16.63 16.0938 16.5124 16.3031 16.3031C16.5124 16.0938 16.63 15.81 16.63 15.514C16.63 15.218 16.5124 14.9342 16.3031 14.7249L11.8905 10.315Z"
                    fill="var(--iconlow)"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div class="navcats">
            <p>ფილმები</p>
            <p>სერიალები</p>
            <p>ანიმაციები</p>
            <p>ანიმეები</p>
          </div>
          <div class="navactions">
            <div class="nav_pc cnt navicons notifications">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.125 19C3.80625 19 3.53888 18.904 3.32288 18.712C3.10688 18.52 2.99925 18.2827 3 18C3 17.7167 3.108 17.479 3.324 17.287C3.54 17.095 3.807 16.9993 4.125 17H5.25V10C5.25 8.61667 5.71875 7.38733 6.65625 6.312C7.59375 5.23667 8.8125 4.53267 10.3125 4.2V3.5C10.3125 3.08334 10.4768 2.729 10.8053 2.437C11.1338 2.145 11.532 1.99934 12 2C12.4688 2 12.8674 2.146 13.1959 2.438C13.5244 2.73 13.6882 3.084 13.6875 3.5V4.2C15.1875 4.53333 16.4062 5.23767 17.3437 6.313C18.2812 7.38833 18.75 8.61733 18.75 10V17H19.875C20.1937 17 20.4611 17.096 20.6771 17.288C20.8931 17.48 21.0007 17.7173 21 18C21 18.2833 20.892 18.521 20.676 18.713C20.46 18.905 20.193 19.0007 19.875 19H4.125ZM12 22C11.3813 22 10.8514 21.804 10.4104 21.412C9.96938 21.02 9.74925 20.5493 9.75 20H14.25C14.25 20.55 14.0295 21.021 13.5885 21.413C13.1475 21.805 12.618 22.0007 12 22ZM7.5 17H16.5V10C16.5 8.9 16.0594 7.95833 15.1781 7.175C14.2969 6.39167 13.2375 6 12 6C10.7625 6 9.70313 6.39167 8.82188 7.175C7.94063 7.95833 7.5 8.9 7.5 10V17Z"
                  fill="#8B8B8B"
                />
              </svg>
            </div>
            <div class="nav_pc cnt navicons bookmarks">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.527 20.841C6.861 21.274 6 20.772 6 19.952V3.942C6 3.422 6.336 3 6.75 3H17.25C17.664 3 18 3.422 18 3.942V19.952C18 20.772 17.139 21.274 16.473 20.842L12.527 18.28C12.3704 18.1774 12.1872 18.1228 12 18.1228C11.8128 18.1228 11.6296 18.1774 11.473 18.28L7.527 20.841Z"
                  stroke="#8B8B8B"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </div>
            <div class="nav_pc cnt navicons watchlater">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12 2C9.43639 2.00731 6.97349 2.99891 5.12 4.77V3C5.12 2.73478 5.01464 2.48043 4.82711 2.29289C4.63957 2.10536 4.38522 2 4.12 2C3.85478 2 3.60043 2.10536 3.41289 2.29289C3.22536 2.48043 3.12 2.73478 3.12 3V7.5C3.12 7.76522 3.22536 8.01957 3.41289 8.20711C3.60043 8.39464 3.85478 8.5 4.12 8.5H8.62C8.88522 8.5 9.13957 8.39464 9.32711 8.20711C9.51464 8.01957 9.62 7.76522 9.62 7.5C9.62 7.23478 9.51464 6.98043 9.32711 6.79289C9.13957 6.60536 8.88522 6.5 8.62 6.5H6.22C7.50578 5.15636 9.21951 4.30266 11.0665 4.08567C12.9136 3.86868 14.7785 4.30198 16.3407 5.31105C17.9028 6.32012 19.0646 7.84191 19.6263 9.61479C20.188 11.3877 20.1145 13.3009 19.4184 15.0254C18.7223 16.7499 17.4472 18.1781 15.8122 19.0643C14.1772 19.9505 12.2845 20.2394 10.4596 19.8813C8.63463 19.5232 6.99147 18.5405 5.81259 17.1022C4.63372 15.6638 3.99279 13.8597 4 12C4 11.7348 3.89464 11.4804 3.70711 11.2929C3.51957 11.1054 3.26522 11 3 11C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 13.9778 2.58649 15.9112 3.6853 17.5557C4.78412 19.2002 6.3459 20.4819 8.17317 21.2388C10.0004 21.9957 12.0111 22.1937 13.9509 21.8079C15.8907 21.422 17.6725 20.4696 19.0711 19.0711C20.4696 17.6725 21.422 15.8907 21.8079 13.9509C22.1937 12.0111 21.9957 10.0004 21.2388 8.17317C20.4819 6.3459 19.2002 4.78412 17.5557 3.6853C15.9112 2.58649 13.9778 2 12 2ZM12 8C11.7348 8 11.4804 8.10536 11.2929 8.29289C11.1054 8.48043 11 8.73478 11 9V12C11 12.2652 11.1054 12.5196 11.2929 12.7071C11.4804 12.8946 11.7348 13 12 13H14C14.2652 13 14.5196 12.8946 14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12C15 11.7348 14.8946 11.4804 14.7071 11.2929C14.5196 11.1054 14.2652 11 14 11H13V9C13 8.73478 12.8946 8.48043 12.7071 8.29289C12.5196 8.10536 12.2652 8 12 8Z"
                  fill="#8B8B8B"
                />
              </svg>
            </div>
            <div class="nav_pc navprofile">
              <div class="navprofileblock">
                <div class="c_profile">
                  <div class="cnt c_profile_block">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                        stroke="var(--icon)"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="c_profile_name">სტუმარი</div>
                </div>
                <div class="navline"></div>
                <div class="navprofileblockactions"></div>
                <button class="navsign">შესვლა</button>
              </div>
              <div class="cnt navprofilebutton">
                <svg
                  width="14"
                  height="20"
                  viewBox="0 0 14 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1 19V17C1 15.9391 1.42143 14.9217 2.17157 14.1716C2.92172 13.4214 3.93913 13 5 13H9C10.0609 13 11.0783 13.4214 11.8284 14.1716C12.5786 14.9217 13 15.9391 13 17V19M3 5C3 6.06087 3.42143 7.07828 4.17157 7.82843C4.92172 8.57857 5.93913 9 7 9C8.06087 9 9.07828 8.57857 9.82843 7.82843C10.5786 7.07828 11 6.06087 11 5C11 3.93913 10.5786 2.92172 9.82843 2.17157C9.07828 1.42143 8.06087 1 7 1C5.93913 1 4.92172 1.42143 4.17157 2.17157C3.42143 2.92172 3 3.93913 3 5Z"
                    stroke="var(--icon)"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
            </div>
            <div class="nav_mb">
              <a href="./bookmarked.html" class="nav_mb_button cnt">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                >
                  <path
                    fill="none"
                    stroke="var(--icon)"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"
                  />
                </svg>
              </a>
              <a href="./watchhistory.html" class="nav_mb_button cnt">
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 18 18"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M9 1.5C7.07729 1.50548 5.23012 2.24919 3.84 3.5775V2.25C3.84 2.05109 3.76098 1.86032 3.62033 1.71967C3.47968 1.57902 3.28891 1.5 3.09 1.5C2.89109 1.5 2.70032 1.57902 2.55967 1.71967C2.41902 1.86032 2.34 2.05109 2.34 2.25V5.625C2.34 5.82391 2.41902 6.01468 2.55967 6.15533C2.70032 6.29598 2.89109 6.375 3.09 6.375H6.465C6.66391 6.375 6.85468 6.29598 6.99533 6.15533C7.13598 6.01468 7.215 5.82391 7.215 5.625C7.215 5.42609 7.13598 5.23532 6.99533 5.09467C6.85468 4.95402 6.66391 4.875 6.465 4.875H4.665C5.62933 3.86727 6.91463 3.22699 8.2999 3.06425C9.68517 2.90151 11.0839 3.22648 12.2555 3.98328C13.4271 4.74009 14.2985 5.88143 14.7197 7.21109C15.141 8.54075 15.0859 9.97564 14.5638 11.269C14.0417 12.5625 13.0854 13.6336 11.8591 14.2982C10.6329 14.9629 9.21337 15.1796 7.84467 14.911C6.47597 14.6424 5.2436 13.9054 4.35944 12.8266C3.47529 11.7479 2.99459 10.3948 3 9C3 8.80109 2.92098 8.61032 2.78033 8.46967C2.63968 8.32902 2.44891 8.25 2.25 8.25C2.05109 8.25 1.86032 8.32902 1.71967 8.46967C1.57902 8.61032 1.5 8.80109 1.5 9C1.5 10.4834 1.93987 11.9334 2.76398 13.1668C3.58809 14.4001 4.75943 15.3614 6.12987 15.9291C7.50032 16.4968 9.00832 16.6453 10.4632 16.3559C11.918 16.0665 13.2544 15.3522 14.3033 14.3033C15.3522 13.2544 16.0665 11.918 16.3559 10.4632C16.6453 9.00832 16.4968 7.50032 15.9291 6.12987C15.3614 4.75943 14.4001 3.58809 13.1668 2.76398C11.9334 1.93987 10.4834 1.5 9 1.5ZM9 6C8.80109 6 8.61032 6.07902 8.46967 6.21967C8.32902 6.36032 8.25 6.55109 8.25 6.75V9C8.25 9.19891 8.32902 9.38968 8.46967 9.53033C8.61032 9.67098 8.80109 9.75 9 9.75H10.5C10.6989 9.75 10.8897 9.67098 11.0303 9.53033C11.171 9.38968 11.25 9.19891 11.25 9C11.25 8.80109 11.171 8.61032 11.0303 8.46967C10.8897 8.32902 10.6989 8.25 10.5 8.25H9.75V6.75C9.75 6.55109 9.67098 6.36032 9.53033 6.21967C9.38968 6.07902 9.19891 6 9 6Z"
                    fill="var(--icon)"
                  />
                </svg>
              </a>
              <div class="nav_mb_button cnt nav_mb_search_opener">
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 18 18"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12.6705 12.69L14.9805 15M14.3137 8.68575C14.3137 11.826 11.7765 14.3715 8.64672 14.3715C5.51772 14.3715 2.98047 11.826 2.98047 8.6865C2.98047 5.54475 5.51772 3 8.64672 3C11.7765 3 14.3137 5.5455 14.3137 8.68575Z"
                    stroke="var(--icon)"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
              <div class="nav_mb_button cnt nav_mb_menu_opener">
                <svg
                  id="nav_mb_menu_open_svg"
                  class="getshow"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M5 17H13M5 12H19M11 7H19"
                    stroke="var(--icon)"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <svg
                  id="nav_mb_menu_close_svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M11.8905 10.315L16.3003 5.90514C16.5096 5.69622 16.6274 5.41271 16.6276 5.11699C16.6279 4.82127 16.5107 4.53755 16.3017 4.32826C16.0928 4.11897 15.8093 4.00125 15.5136 4.00098C15.2179 4.00072 14.9342 4.11795 14.7249 4.32687L10.315 8.73673L5.90514 4.32687C5.69585 4.11758 5.41199 4 5.116 4C4.82002 4 4.53616 4.11758 4.32687 4.32687C4.11758 4.53616 4 4.82002 4 5.116C4 5.41199 4.11758 5.69585 4.32687 5.90514L8.73673 10.315L4.32687 14.7249C4.11758 14.9342 4 15.218 4 15.514C4 15.81 4.11758 16.0938 4.32687 16.3031C4.53616 16.5124 4.82002 16.63 5.116 16.63C5.41199 16.63 5.69585 16.5124 5.90514 16.3031L10.315 11.8933L14.7249 16.3031C14.9342 16.5124 15.218 16.63 15.514 16.63C15.81 16.63 16.0938 16.5124 16.3031 16.3031C16.5124 16.0938 16.63 15.81 16.63 15.514C16.63 15.218 16.5124 14.9342 16.3031 14.7249L11.8905 10.315Z"
                    fill="var(--icon)"
                    fill-opacity="0.9"
                  />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mobile_nav">
        <div class="mobile_nav_shadow"></div>
        <div class="mobile_nav_content">
          <div class="mobile_nav_content_start">
            <div class="c_profile">
              <div class="cnt c_profile_block">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                    stroke="var(--icon)"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
              <div class="c_profile_name">სტუმარი</div>
            </div>
            <div class="cnt c_profile_badge">დეველოპერი</div>
            <div class="navline"></div>
            <div class="mob_nav_actions_row"></div>
          </div>
          <div class="mobile_nav_content_end">
            <div class="mob_nav_sign cnt mob_nav_sign_out">
              ანგარიშიდან გასვლა
            </div>
          </div>
        </div>
      </div>
    `;
const nav_mb_menu_opener = document.querySelector(".nav_mb_menu_opener");
const mobile_nav_shadow = document.querySelector(".mobile_nav_shadow");
const mobile_nav = document.querySelector(".mobile_nav");
const nav_mb_menu_open_svg = document.querySelector("#nav_mb_menu_open_svg");
const nav_mb_menu_close_svg = document.querySelector("#nav_mb_menu_close_svg");
const navprofilebutton = document.querySelector(".navprofilebutton");
const navinput = document.querySelector(".navinput");
const navsearch = document.querySelector(".navsearch");
const navinputblock = document.querySelector(".navinputblock");
const nav_mb_search_opener = document.querySelector(".nav_mb_search_opener");
const nav_mb_search_close = document.querySelector(".nav_mb_search_close");
const navsearchshadow = document.querySelector(".navsearchshadow");

const navprofileblock = document.querySelector(".navprofileblock");
const navprofileblockactions = document.querySelectorAll(
  ".navprofileblockactions, .mob_nav_actions_row"
);

nav_mb_search_opener.addEventListener("click", function () {
  navinputblock.classList.add("navinputblockshow");
});
nav_mb_search_close.addEventListener("click", closemobilesearch);
navsearchshadow.addEventListener("click", closemobilesearch);
function closemobilesearch() {
  navinputblock.classList.remove("navinputblockshow");
  navsearch.classList.remove("navsearchshow");
}
mobile_nav_shadow.addEventListener("click", function () {
  mobile_nav.classList.remove("mobile_nav_show");
  nav_mb_menu_open_svg.classList.add("getshow");
  nav_mb_menu_close_svg.classList.remove("getshow");
});

nav_mb_menu_opener.addEventListener("click", function () {
  if (mobile_nav.classList.contains("mobile_nav_show")) {
    mobile_nav.classList.remove("mobile_nav_show");
    nav_mb_menu_open_svg.classList.add("getshow");
    nav_mb_menu_close_svg.classList.remove("getshow");
  } else {
    mobile_nav.classList.add("mobile_nav_show");
    nav_mb_menu_open_svg.classList.remove("getshow");
    nav_mb_menu_close_svg.classList.add("getshow");
  }
});

navinput.addEventListener("input", () => {
  if (navinput.value.length >= 2) {
    // request
  }
});

navinput.addEventListener("click", () => {
  navsearch.classList.add("navsearchshow");
});

document.addEventListener("click", (event) => {
  if (!navinputblock.contains(event.target)) {
    navsearch.classList.remove("navsearchshow");
  }
});

function initializeNavBlock() {
  navprofileblockactions.forEach((lister) => {
    profileactions.forEach((action) => {
      lister.innerHTML += `<a href="${action.link}" class="navblockaction">${action.icon} ${action.title}</a>`;
    });
  });
}

navprofilebutton.addEventListener("click", toggleProfileBlock);

function toggleProfileBlock() {
  if (navprofileblock.classList.contains("navprofileblockshow")) {
    navprofileblock.classList.remove("navprofileblockshow");
  } else {
    navprofileblock.classList.add("navprofileblockshow");
    document.addEventListener("click", removeProfileBlock);
  }
}
function removeProfileBlock(e) {
  if (
    !e.target.closest(".navprofileblock") &&
    !e.target.closest(".navprofilebutton")
  ) {
    navprofileblock.classList.remove("navprofileblockshow");
  }
}

const profileactions = [
  {
    link: "profile.html",
    title: "პროფილი",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 14V12.6667C4 11.9594 4.28095 11.2811 4.78105 10.781C5.28115 10.281 5.95942 10 6.66667 10H9.33333C10.0406 10 10.7189 10.281 11.219 10.781C11.719 11.2811 12 11.9594 12 12.6667V14M5.33333 4.66667C5.33333 5.37391 5.61428 6.05219 6.11438 6.55229C6.61448 7.05238 7.29276 7.33333 8 7.33333C8.70724 7.33333 9.38552 7.05238 9.88562 6.55229C10.3857 6.05219 10.6667 5.37391 10.6667 4.66667C10.6667 3.95942 10.3857 3.28115 9.88562 2.78105C9.38552 2.28095 8.70724 2 8 2C7.29276 2 6.61448 2.28095 6.11438 2.78105C5.61428 3.28115 5.33333 3.95942 5.33333 4.66667Z" stroke="var(--icon)"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
`,
  },
  {
    link: "profile.html",
    title: "მოწონებულები",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.05747 3.14347C2.76867 2.36227 3.78413 1.93294 4.976 1.93294C6.0624 1.93294 7.22253 2.44627 8 3.45054C8.7728 2.4472 9.92827 1.93294 11.024 1.93294C12.2131 1.93294 13.2267 2.3604 13.9397 3.13974C14.6453 3.91254 15 4.97094 15 6.14507C15 8.16667 13.9612 9.79347 12.6461 11.0581C11.3348 12.32 9.68747 13.2823 8.322 13.9888C8.22199 14.0405 8.11097 14.0674 7.99837 14.0671C7.88577 14.0667 7.77491 14.0392 7.6752 13.9869C6.30973 13.2729 4.6624 12.3181 3.35107 11.0628C2.036 9.80187 1 8.18067 1 6.146C1 4.97467 1.3528 3.91627 2.05747 3.14347ZM3.09253 4.08614C2.66787 4.5528 2.4 5.25 2.4 6.146C2.4 7.66174 3.1616 8.94227 4.31987 10.0511C5.38947 11.0759 6.74653 11.9037 8.00187 12.5757C9.24787 11.9131 10.6059 11.0787 11.6764 10.0492C12.8365 8.932 13.6 7.64587 13.6 6.146C13.6 5.2472 13.3312 4.55 12.9056 4.08334C12.4875 3.62694 11.864 3.33387 11.024 3.33387C10.1131 3.33387 9.07053 3.92 8.66547 5.15387C8.61966 5.29426 8.53062 5.41657 8.41109 5.50329C8.29157 5.59002 8.14767 5.63672 8 5.63672C7.85233 5.63672 7.70843 5.59002 7.58891 5.50329C7.46938 5.41657 7.38034 5.29426 7.33453 5.15387C6.9304 3.92187 5.87667 3.33387 4.976 3.33387C4.1332 3.33387 3.51067 3.62694 3.09253 4.08614Z" fill="var(--icon)" />
</svg>
`,
  },
  {
    link: "bookmarked.html",
    title: "ჩანიშნული ფილმები",
    icon: `
<svg
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
>
  <path
    fill="none"
    stroke="var(--icon)"
    stroke-linecap="round"
    stroke-linejoin="round"
    stroke-width="2"
    d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"
  />
</svg>
`,
  },
  {
    link: "watchhistory.html",
    title: "ბოლოს ნანახი",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.99968 1.33333C6.2906 1.3382 4.64867 1.99927 3.41301 3.18V1.99999C3.41301 1.82318 3.34277 1.65361 3.21775 1.52859C3.09272 1.40357 2.92315 1.33333 2.74634 1.33333C2.56953 1.33333 2.39996 1.40357 2.27494 1.52859C2.14991 1.65361 2.07967 1.82318 2.07967 1.99999V5C2.07967 5.17681 2.14991 5.34638 2.27494 5.4714C2.39996 5.59642 2.56953 5.66666 2.74634 5.66666H5.74634C5.92315 5.66666 6.09272 5.59642 6.21775 5.4714C6.34277 5.34638 6.41301 5.17681 6.41301 5C6.41301 4.82318 6.34277 4.65362 6.21775 4.52859C6.09272 4.40357 5.92315 4.33333 5.74634 4.33333H4.14634C5.00353 3.43757 6.14601 2.86843 7.37736 2.72377C8.60872 2.57912 9.852 2.86798 10.8934 3.54069C11.9349 4.2134 12.7094 5.22794 13.0839 6.40986C13.4584 7.59177 13.4093 8.86723 12.9453 10.0169C12.4812 11.1666 11.6311 12.1187 10.5411 12.7095C9.45111 13.3003 8.18933 13.4929 6.97271 13.2542C5.75609 13.0155 4.66065 12.3604 3.87474 11.4015C3.08882 10.4426 2.66153 9.23981 2.66634 8C2.66634 7.82318 2.5961 7.65362 2.47108 7.52859C2.34605 7.40357 2.17649 7.33333 1.99967 7.33333C1.82286 7.33333 1.65329 7.40357 1.52827 7.52859C1.40325 7.65362 1.33301 7.82318 1.33301 8C1.33301 9.31854 1.724 10.6075 2.45654 11.7038C3.18909 12.8001 4.23028 13.6546 5.44845 14.1592C6.66663 14.6638 8.00707 14.7958 9.30028 14.5386C10.5935 14.2813 11.7814 13.6464 12.7137 12.714C13.6461 11.7817 14.281 10.5938 14.5382 9.3006C14.7955 8.00739 14.6635 6.66695 14.1589 5.44877C13.6543 4.2306 12.7998 3.18941 11.7035 2.45686C10.6071 1.72432 9.31822 1.33333 7.99968 1.33333ZM7.99968 5.33333C7.82286 5.33333 7.6533 5.40357 7.52827 5.52859C7.40325 5.65362 7.33301 5.82318 7.33301 6V8C7.33301 8.17681 7.40325 8.34638 7.52827 8.4714C7.6533 8.59642 7.82286 8.66666 7.99968 8.66666H9.33301C9.50982 8.66666 9.67939 8.59642 9.80441 8.4714C9.92944 8.34638 9.99968 8.17681 9.99968 8C9.99968 7.82318 9.92944 7.65362 9.80441 7.52859C9.67939 7.40357 9.50982 7.33333 9.33301 7.33333H8.66634V6C8.66634 5.82318 8.5961 5.65362 8.47108 5.52859C8.34606 5.40357 8.17649 5.33333 7.99968 5.33333Z" fill="var(--icon)" />
</svg>
`,
  },
  {
    link: "settings.html",
    title: "პარამეტრები",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.3327 8.00001C10.3327 8.30642 10.2723 8.60984 10.1551 8.89293C10.0378 9.17603 9.86593 9.43325 9.64926 9.64992C9.43259 9.86659 9.17537 10.0385 8.89228 10.1557C8.60918 10.273 8.30577 10.3333 7.99935 10.3333C7.69293 10.3333 7.38951 10.273 7.10642 10.1557C6.82333 10.0385 6.5661 9.86659 6.34943 9.64992C6.13276 9.43325 5.96089 9.17603 5.84363 8.89293C5.72637 8.60984 5.66602 8.30642 5.66602 8.00001C5.66602 7.38117 5.91185 6.78767 6.34943 6.35009C6.78702 5.9125 7.38051 5.66667 7.99935 5.66667C8.61819 5.66667 9.21168 5.9125 9.64926 6.35009C10.0868 6.78767 10.3327 7.38117 10.3327 8.00001Z" stroke="var(--icon)"  stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14.007 9.398C14.355 9.304 14.529 9.25667 14.5977 9.16734C14.6663 9.07734 14.6663 8.93334 14.6663 8.64467V7.35534C14.6663 7.06667 14.6663 6.922 14.5977 6.83267C14.529 6.74334 14.355 6.696 14.007 6.60267C12.707 6.252 11.893 4.89267 12.2283 3.60067C12.321 3.24534 12.367 3.06734 12.323 2.96334C12.279 2.85934 12.1523 2.78734 11.8997 2.644L10.7497 1.99067C10.5017 1.85067 10.3777 1.78 10.2663 1.79467C10.155 1.80934 10.029 1.93467 9.77767 2.186C8.80501 3.156 7.19567 3.156 6.22234 2.186C5.97101 1.93534 5.84567 1.81 5.73434 1.79467C5.62301 1.78 5.49901 1.85 5.25101 1.99134L4.10101 2.644C3.84767 2.78734 3.72101 2.85934 3.67767 2.964C3.63367 3.06734 3.67967 3.24534 3.77167 3.60067C4.10701 4.89267 3.29301 6.252 1.99234 6.60267C1.64434 6.696 1.47034 6.74267 1.40167 6.83267C1.33301 6.92267 1.33301 7.06667 1.33301 7.35534V8.64467C1.33301 8.93334 1.33301 9.078 1.40167 9.16734C1.47034 9.25667 1.64434 9.304 1.99234 9.398C3.29234 9.74867 4.10634 11.108 3.77101 12.3993C3.67834 12.7547 3.63234 12.9327 3.67634 13.0367C3.72034 13.1407 3.84701 13.2127 4.09967 13.3567L5.24967 14.0087C5.49767 14.15 5.62167 14.22 5.73301 14.2053C5.84434 14.1907 5.97034 14.0653 6.22167 13.814C7.19501 12.8427 8.80567 12.8427 9.77901 13.814C10.0303 14.0647 10.1557 14.19 10.267 14.2053C10.3783 14.22 10.5023 14.15 10.751 14.0087L11.9003 13.356C12.1537 13.2127 12.2803 13.1407 12.3237 13.036C12.367 12.9313 12.3217 12.7547 12.2297 12.3993C11.8937 11.108 12.707 9.74867 14.007 9.398Z" stroke="var(--icon)"  stroke-linecap="round" stroke-linejoin="round"/>
</svg>
`,
  },
  {
    link: "settings.html",
    title: "ინტერფეისი",
    icon: `
    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path fill="none" stroke="var(--icon)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12m0-3h19M13 13h4m-4 4h2M7 6h.009M11 6h.009M9 9v12.5" color="currentColor"/></svg>
`,
  },
  {
    link: "help.html",
    title: "დახმარება",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 15C4.14 15 1 11.86 1 8C1 4.14 4.14 1 8 1C11.86 1 15 4.14 15 8C15 11.86 11.86 15 8 15ZM8 2C4.69 2 2 4.69 2 8C2 11.31 4.69 14 8 14C11.31 14 14 11.31 14 8C14 4.69 11.31 2 8 2Z" fill="var(--icon)" />
<path d="M8 4.5C6.89 4.5 6 5.39 6 6.5H7C7 5.95 7.45 5.5 8 5.5C8.55 5.5 9 5.95 9 6.5C9 7.5 7.5 7.38 7.5 9H8.5C8.5 7.88 10 7.75 10 6.5C10 5.39 9.11 4.5 8 4.5Z" fill="var(--icon)" />
<path d="M7.99988 11.62C8.3423 11.62 8.61988 11.3424 8.61988 11C8.61988 10.6576 8.3423 10.38 7.99988 10.38C7.65747 10.38 7.37988 10.6576 7.37988 11C7.37988 11.3424 7.65747 11.62 7.99988 11.62Z" fill="var(--icon)" />
<path d="M6.5 7C6.77614 7 7 6.77614 7 6.5C7 6.22386 6.77614 6 6.5 6C6.22386 6 6 6.22386 6 6.5C6 6.77614 6.22386 7 6.5 7Z" fill="var(--icon)" />
<path d="M8 9.5C8.27614 9.5 8.5 9.27614 8.5 9C8.5 8.72386 8.27614 8.5 8 8.5C7.72386 8.5 7.5 8.72386 7.5 9C7.5 9.27614 7.72386 9.5 8 9.5Z" fill="var(--icon)" />
</svg>
`,
  },
];
initializeNavBlock();
