<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Register</title>

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
            <form class="auth_form">
                <h1>ანგარიშის შექმნა</h1>
                <div class="error_auth"></div>
                <div class="auth_controls">
                    <div class="auth_inputs">
                        <input class="dfi" placeholder="მეილი" name="email" id="email" type="email"
                            autocomplete="email" />
                        <input class="dfi" placeholder="სახელი (nickname)" name="nickname" id="nickname" type="text"
                            autocomplete="username" />
                        <input class="dfi" placeholder="პაროლი" autocomplete="current-password" name="password"
                            id="password" type="password" />
                    </div>
                </div>
                <button>რეგისტრაცია</button>
                <a href="login." class="register_auth">ავტორიზაცია</a>
            </form>
        </div>
        <div class="auth_block auth_last">
            <img src="../assets/images/decor/auth.png" alt="" />
        </div>
    </div>
    <script type="module" src="../ui/mg_engine.js"></script>

    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    const server_start = "http://localhost/moviesgo/v1/";

    const auth_form = document.querySelector(".auth_form");
    const email = document.getElementById("email");
    const nickname = document.getElementById("nickname");
    const password = document.getElementById("password");
    const error_auth = document.querySelector(".error_auth");
    auth_form.addEventListener("submit", (e) => {
        e.preventDefault();
        error_auth.classList.remove("error_auth_show");
        error_auth.innerText = "";

        if (
            email.value.length > 7 &&
            nickname.value.length >= 3 &&
            password.value.length > 7
        ) {
            const formData = new FormData(auth_form);
            $.ajax({
                url: server_start + "auth/register.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                xhrFields: {
                    withCredentials: true,
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status == 100) {
                        // REGISTERED
                    } else if (data.status == 3) {
                        error_auth.classList.add("error_auth_show");
                        error_auth.innerText = "ასეთი მეილით ანგარიში უკვე არსებობს";
                    } else if (data.status == 4) {
                        error_auth.classList.add("error_auth_show");
                        error_auth.innerText = "ასეთი სახელით ანგარიში უკვე არსებობს";
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