<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>search</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/profile/profile.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
</head>

<body>

    <?php include_once "../components/nav.php"?>

    <div class="container loved_movies">
        <div class="profile">
            <div class="p_starter">
                <div class="c_profile">
                    <div class="cnt c_profile_block">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                                stroke="white" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="c_profile_name">ლუკა ფეხშველაშვილი</div>
                    <div class="cnt c_profile_badge">დეველოპერი</div>
                </div>
                <div class="profile_blocks">
                    <div class="profile_block">
                        <p>ვებგვერდზე გატარებული დრო</p>
                        <h3>32სთ 53წთ</h3>
                    </div>
                    <div class="profile_block">
                        <p>კინომოყვარულის ქულა</p>
                        <h3>240</h3>
                    </div>
                    <div class="profile_block">
                        <p>შეფასებული ფილმები</p>
                        <h3>52</h3>
                    </div>
                    <div class="profile_block">
                        <p>ვებგვერდზე მოღვაწეობს</p>
                        <h3>2024 / 12 / 07 -დან</h3>
                    </div>
                </div>
            </div>
        </div>
        <h2>მოწონებული ფილმები:</h2>
        <div class="card_row">
            <div class="mg_card">
                <div class="mg_info_grab">
                    <h3 id="mg_card_display_description">
                        მოკლე აღწერა:
                        <span class="mg_card_description_p">
                            სერიალი კოკაინის ეპიდემიის დაწყებაზე ლოს ანჯელესში 1980-იან
                            წლებში. როდესაც ამერიკის ქუჩებში გაჩნდა იაფიანი კრეკი და
                            კანონდარღვევები გაიზარდა. სამი განსხვავებული ადამიანის თვალით
                            დანახული მოვლენები.
                        </span>
                    </h3>
                    <p id="mg_card_display_genres">
                        <span>ჟანრები:</span> დრამა, მძაფრსიუჟეტიანი, დეტექტივი
                    </p>
                </div>
                <div class="mg_img_side">
                    <div class="mg_card_play">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M133 440a35.37 35.37 0 0 1-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0 1 35.77.45l247.85 148.36a36 36 0 0 1 0 61l-247.89 148.4A35.5 35.5 0 0 1 133 440Z" />
                        </svg>
                    </div>
                    <img loading="lazy" src="../assets/images/Snowfall.webp" />
                    <div class="mg_card_shadow"></div>
                    <div class="mg_card_bookmark cnt">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24">
                            <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z" />
                        </svg>
                    </div>
                    <div class="mg_card_type cnt">სერიალი</div>
                    <div class="mg_card_year cnt">2024წ</div>
                    <div class="mg_card_imdb cnt">IMDB: 8.4</div>
                </div>
                <div class="mg_card_info">
                    <div class="mg_card_info_f">
                        <div class="card_info_text">SNOWFALL</div>
                        <div class="card_info_text">თოვა</div>
                    </div>
                    <div class="mg_card_info_e">
                        <div class="mg_card_bookmark cnt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24">
                                <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script src="../assets/engines/card.js"></script>
</body>

</html>