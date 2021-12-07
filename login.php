<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <style>
        body {
            background: #36393f;
            color: white;
            font-family: Whitney, Helvetica, Arial, sans-serif;
        }

        .services__wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        .services__card {
            border-top: 3px solid #41A8FF;
            margin: 30px;
            height: 500px;
            width: 400px;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            justify-content: top;
            color: #fff;
            background: #292b2f;
            transition: 0.3s ease-in;
        }

        .services__card button:hover {
            cursor: pointer;
        }

        .services__card h1 {
            margin-top: 30px;
        }

        .services__card:hover {
            box-shadow: 0 0 50px #00000030;
            transition: 0.3s ease-in;
            cursor: pointer;
        }

        .main {
            background: #303339;
            border-top: 3px solid #525965;
            border-radius: 100px 100px 10px 10px;
            align-items: center;
            justify-content: center;
            text-align: center;
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .logo {
            font-size: 18px;
            color: #ffffff52;
        }

        .services__card h1 span {
            word-break: break-all;
            background: -webkit-linear-gradient(to right, #00DEFF, #4D90FF);
            background: linear-gradient(to right, #00DEFF, #4D90FF);
            background-size: 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -mo-text-fill-color: transparent;
        }

        .inputblock {
            margin-top: 40px;
        }

        input {
            background-color: #303339;
            border: 1px solid #00000000;
            color: white;
            outline: none;
            padding: 3px;
            font-size: 24px;
            border-radius: 3px;
        }

        input:hover {
            background-color: #3A3E45;
            border: 1px solid #00000000;
            color: white;
            outline: none;
            padding: 3px;
            border-radius: 3px;
        }

        input:focus {
            background-color: #303339;
            border: 1px solid #494D55ff;
            padding: 3px;
            outline: none;
            color: white;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .center {
            text-align: center;
        }

        #status {
            color: #FF7575;
        }

        .button {
            padding: 8px 30px;
            border-radius: 10px;
            cursor: pointer;
            background-color: #3ba55d;
            transition: all 0.3s ease;
        }

        .button:hover {
            padding: 8px 30px;
            border-radius: 10px;
            cursor: pointer;
            background-color: #4EAF6D;
        }

        .button:focus {
            padding: 8px 30px;
            border-radius: 10px;
            cursor: pointer;
            background-color: #4EAF6D;
        }

        .lds-dual-ring {
            display: inline-block;
            margin-bottom: -2px;
            margin-left: 10px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #fff;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 1000px) {
            .main {
                margin-top: 100px;
            }

            .title {
                margin-top: 1em;
            }

            .services__wrapper {
                align-items: center;
                display: grid;
                grid-template-columns: 1fr;
                grid-template-rows: 1fr 1fr;
            }

            .services__card {
                margin: 30px;
                height: 500px;
                width: 300px;
                border-radius: 25px;
                display: flex;
                flex-direction: column;
                color: #fff;
                background: #292b2f;
            }

            p {
                font-size: 24px;
            }

            input {
                width: 280px;
            }

            .main {
                width: 100%;
            }
        }

        @media only screen and (min-width: 1001px) {
            .main {
                margin-left: 20%;
                margin-right: 20%;
            }
        }
    </style>
</head>
<body>
<div class="main">
    <img src="https://media.discordapp.net/attachments/881485225627099146/916691053514469396/updlogo.png" class="sisya">
    <h1 class="title">Registration hub</h1>
    <div class="services">
        <div class="services__wrapper">
            <div class="services__card" id="connect">
                <h1><span>Login</span> into gdps:</h1>
                <p class="center">Status: <span id="status">Not logged in</span></p>
                <form method="post" id="login_forms" action="">
                    <div class="inputblock">
                        <p class="center"><input id="login_login" placeholder="Nickname" required/></p>
                        <p class="center"><input id="login_password" type="password" placeholder="Password" required/>
                        </p>
                    </div>
                    <p class="center"><input type="submit" class="button" value="Login"></p>
                </form>
            </div>
            <div class="services__card">
                <h1><span>Register</span> into gdps:</h1>
                <p>You must download gdps and register inside game first.</p>
            </div>
        </div>
        <p class="logo">Vulpine © Foxodever x Keisi</p>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(function () {
        $("#login_forms").submit(
            function () {
                login_check();
                return false;
            }
        );
    });

    function login_check() {
        document.getElementById("status").style.color = "white";
        $("#status").html('<div class="lds-dual-ring"></div> Loading');
        let username = document.getElementById("login_login").value;
        let password = document.getElementById("login_password").value;
        $.ajax({
            type: "POST",
            url: "/accounts/login.php",
            data: {username, password}
        }).done(function (r) {
            if (r.includes("1")) {
                location.reload();
            } else {
                document.getElementById("status").style.color = "red";
                $("#status").html(r);
            }
        });
    }
</script>
