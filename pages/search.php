<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo isset($_GET['title']) ? $_GET['title'] : "ძიება" ?> - MoviesGo</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/search/search.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
</head>

<body>

    <?php include_once "../components/nav.php"?>
    <div class="mg_ai_web_loader mg_ai_web_loader_hidden">
        <div class="popcorn_container">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
                <path fill="var(--main)"
                    d="M7 22H4.75s-.75 0-.94-1.35L2.04 3.81L2 3.5C2 2.67 2.9 2 4 2s2 .67 2 1.5C6 2.67 6.9 2 8 2s2 .67 2 1.5c0-.83.9-1.5 2-1.5c1.09 0 2 .66 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5l-.04.31l-1.77 16.84C20 22 19.25 22 19.25 22H7M17.85 4.93C17.55 4.39 16.84 4 16 4c-.81 0-1.64.36-2 .87L13.78 20h2.88l1.19-15.07M10 4.87C9.64 4.36 8.81 4 8 4c-.84 0-1.55.39-1.85.93L7.34 20h2.88L10 4.87Z" />
            </svg>
        </div>
    </div>
    <div class="container">
        <form class="searchform" onsubmit="return false">
            <input class="searchinput" type="text" value="<?php echo isset($_GET['title']) ? $_GET['title'] : "" ?>"
                placeholder="ძებნა..." />
            <button class="cnt searchbutton">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.0772 14.1L16.6439 16.6667M15.9031 9.65083C15.9031 13.14 13.0839 15.9683 9.60638 15.9683C6.12971 15.9683 3.31055 13.14 3.31055 9.65166C3.31055 6.16083 6.12971 3.33333 9.60638 3.33333C13.0839 3.33333 15.9031 6.16166 15.9031 9.65083Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" class="filtershowbutton">
                <p>ფილტრები</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4 7a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1zm2 5a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1zm2 5a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1z" />
                </svg>
            </button>
        </form>

        <div class="filter_container cnt">
            <div class="filter_shadow"></div>
            <div class="filter_block_c">
                <div class="mobile_addon">
                    <div class="mobile_line"></div>
                </div>
                <div class="close_filters cnt">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.2694 12.3151L19.5612 7.02322C19.8123 6.77252 19.9536 6.43231 19.9539 6.07745C19.9542 5.72258 19.8136 5.38212 19.5629 5.13098C19.3122 4.87983 18.972 4.73856 18.6171 4.73824C18.2622 4.73793 17.9218 4.8786 17.6706 5.1293L12.3788 10.4211L7.08695 5.1293C6.8358 4.87816 6.49516 4.73706 6.13999 4.73706C5.78481 4.73706 5.44417 4.87816 5.19303 5.1293C4.94188 5.38045 4.80078 5.72109 4.80078 6.07626C4.80078 6.43144 4.94188 6.77208 5.19303 7.02322L10.4849 12.3151L5.19303 17.6069C4.94188 17.858 4.80078 18.1987 4.80078 18.5539C4.80078 18.909 4.94188 19.2497 5.19303 19.5008C5.44417 19.752 5.78481 19.8931 6.13999 19.8931C6.49516 19.8931 6.8358 19.752 7.08695 19.5008L12.3788 14.209L17.6706 19.5008C17.9218 19.752 18.2624 19.8931 18.6176 19.8931C18.9728 19.8931 19.3134 19.752 19.5645 19.5008C19.8157 19.2497 19.9568 18.909 19.9568 18.5539C19.9568 18.1987 19.8157 17.858 19.5645 17.6069L14.2694 12.3151Z"
                            fill="var(--texthead)" />
                    </svg>
                </div>
                <div class="filter_confirm_block">
                    <button id="clearfilters" class="dbts">გასუფთავება</button>
                    <button id="filterit" class="dbt">გაფილტვრა</button>
                </div>
                <div class="filter_block">
                    <div class="filter_cont">
                        <h2>აირჩიეთ წელი</h2>
                        <div class="filter_inp">
                            <input type="number" id="year_from" value="1900" />-დან
                            <input type="number" id="year_to" value="2025" />-მდე
                        </div>
                    </div>
                    <div class="filter_cont">
                        <h2>აირჩიეთ IMDb</h2>
                        <div class="filter_inp">
                            <input type="number" id="imdb_from" value="0.0" />-დან
                            <input type="number" id="imdb_to" value="10" />-მდე
                        </div>
                    </div>
                    <div class="filter_cont">
                        <h2>აირჩიეთ ტიპი</h2>
                        <div class="filter_types_row filters_rower"></div>
                    </div>
                    <div class="filter_cont">
                        <h2>აირჩიეთ ჟანრები</h2>
                        <div class="select_block">
                            <input class="search_genres_row" type="text" placeholder="ჟანრი" />
                            <div class="filter_genres_row filters_rower select_row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search_ascdesc">
            <p class="founded">ნაპოვნია: <span id="search_nums_rows"></span> შედეგი</p>
            <div class="ascdesc_row">
                <div data-years-sort="to_down" class="ascdesc_year ascdesc_button">წელი ↓</div>
            </div>
        </div>

        <div class="cardrows">

        </div>
    </div>
    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/engines/card.js"></script>
    <script type="module" src="../assets/engines/search.js"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
</body>

</html>