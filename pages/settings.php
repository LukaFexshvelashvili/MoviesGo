<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>settings</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/settings/settings.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
</head>

<body>

    <?php include_once "../components/nav.php"?>
    <div class="content_manager">
        <div class="sidebar">
            <div class="setting interface_setting activesetting">
                <p class="settingstarter">ინტერფეისი</p>
                <p>მთავარი ფერი</p>
                <p>თემები</p>
                <p>სინათლე</p>
                <p>ქასთომი</p>
                <p>რეჟიმები</p>
            </div>
        </div>
        <div class="settings_content">
            <div class="starter_content">
                <div class="mobile_back">უკან</div>
                <h2>ინტერფეისი</h2>
            </div>
            <div class="interface_blocks">
                <div class="interface_block">
                    <p>მთავარი ფერი</p>
                    <div class="select_row colors_selector"></div>
                </div>
                <div class="interface_block">
                    <p>თემები</p>
                    <div class="select_row themes_selector"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const mobile_back = document.querySelector(".mobile_back");
    const interface_setting = document.querySelector(".interface_setting");
    const sidebar = document.querySelector(".sidebar");
    mobile_back.addEventListener("click", function() {
        sidebar.classList.remove("sidebar_hide");
    });
    interface_setting.addEventListener("click", function() {
        sidebar.classList.add("sidebar_hide");
    });
    </script>
    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script type="module" src="../ui/engine.js"></script>
</body>

</html>