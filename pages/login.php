<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/auth/auth.css" />
</head>

<body class="bg-bodybg">
    <nav>
        <a href="./" class="nav_starter">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="10" fill="var(--main)" />
                <path
                    d="M9 14.8824L11.4549 25.8846C11.6682 26.8406 12.9864 26.9517 13.3567 26.0449L18.5023 13.4435C18.8503 12.5911 20.0678 12.6222 20.3719 13.4911L24.8325 26.2356C25.1475 27.1357 26.4239 27.126 26.7251 26.2211L30.5 14.8824"
                    stroke="white" stroke-width="3" stroke-linecap="round" />
            </svg>
            MOVIES<span>GO</span>
        </a>
    </nav>
    <div class="auth_split">
        <div class="auth_block auth_first cnt">
            <form onsubmit="return false" class="auth_form">
                <h1>ავტორიზაცია</h1>
                <div class="error_auth"></div>

                <div class="auth_controls">
                    <div class="auth_inputs">
                        <input class="dfi" placeholder="სახელი (nickname)" id="nickname" name="nickname" type="text"
                            autocomplete="username" />
                        <input class="dfi" placeholder="პაროლი" id="password" type="password" name="password"
                            autocomplete="current-password" />
                    </div>
                    <p class="forgot_password">დაგავიწყდა პაროლი?</p>
                </div>
                <button>შესვლა</button>
                <a href="register." class="register_auth">ანგარიშის შექმნა</a>
            </form>
        </div>
        <div class="auth_block auth_last">
            <img src="../assets/images/decor/auth.png" alt="" />
        </div>
    </div>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script>
    const server_start = "http://localhost/moviesgo/v1/";

    const auth_form = document.querySelector(".auth_form");
    const nickname = document.getElementById("nickname");
    const password = document.getElementById("password");
    const error_auth = document.querySelector(".error_auth");
    auth_form.addEventListener("submit", (e) => {
        e.preventDefault();
        error_auth.classList.remove("error_auth_show");
        error_auth.innerText = "";

        if (nickname.value.length >= 3 && password.value.length > 7) {
            const formData = new FormData(auth_form);
            $.ajax({
                url: server_start + "auth/login.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                xhrFields: {
                    withCredentials: true,
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status == 100) {} else if (data.status == 0) {
                        error_auth.classList.add("error_auth_show");
                        error_auth.innerText =
                            "მომხმარებლის სახელი ან პაროლი არასწორია";
                    }
                },
            });
        } else {
            error_auth.classList.add("error_auth_show");
            error_auth.innerText = "შეავსეთ ყველა ველი !";
        }
    });
    </script>
</body>

</html>