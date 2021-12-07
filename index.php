<?php
include "config/main.php";
include "libs/main.php";
if($server_status == 0) {
?>
<html>
    <head>
        <title>GDPS Setup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <style>
            body {
                background: #36393f;
                color: white;
                font-family: Whitney,Helvetica,Arial,sans-serif;
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
              width: 500px;
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
              transform: scale(1.010);
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
              justify-content: center;

              min-height: 100%;
            }
           
            .logo {
              font-size: 18px;
              color: #ffffff52;
            }
            
            .services__card h1 span {
                word-break: break-all;
                background: -webkit-linear-gradient(to right #00DEFF, #4D90FF);
                background: linear-gradient(to right, #00DEFF, #4D90FF);
                background-size: 100%;
                -webkit-background-clip: text;
                -moz-background-clip: text;
                -webkit-text-fill-color: transparent;
                -mo-text-fill-color: transparent;
            }
            
            input {
                background-color: #303339;
                border: 1px solid #00000000;
                color: white;
                outline: none;
                padding: 3px;
                color: white;
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
                <?php
                if($mysql_status == 1) {
                    echo 'color: lime;';
                } else {
                    echo 'color: #FF7575;';
                }
                ?>
            }
            
            #status2 {
                <?php
                if($reg_status == 1) {
                    echo 'color: lime;';
                } else {
                    echo 'color: #FF7575;';
                }
                ?>
            }
            
            .input .error {
              border-left: 2px solid #FF7575;
            }
            
            .error {
                color: #FF7575;
            }
            
            .button {
                padding: 8px;
                border-radius: 10px;
                cursor: pointer;
                background-color: #3ba55d;
            }
            
            .button:hover {
                padding: 8px;
                border-radius: 10px;
                cursor: pointer;
                background-color: #4EAF6D;
            }
            
            .button:focus {
                padding: 8px;
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
              border-color: #fff transparent #fff transparent;
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
                  width: 450px;
                  border-radius: 25px;
                  display: flex;
                  flex-direction: column;
                  justify-content: top;
                  color: #fff;
                  background: #292b2f;
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
        <img src="https://media.discordapp.net/attachments/881485225627099146/916691053514469396/updlogo.png" class="title">
      <h1 class="title">Connection</h1>
        <div class="services">
        <div class="services__wrapper">
          <div class="services__card" id="connect">
          <h1><span>MySQL</span> Setup:</h1>
          <p class="center">Status: <span id="status"><?php
              if($mysql_status == 1) {
                  echo "Connected";
              } else {
                  echo "Not done yet";
              }
              ?></span></p>
              <?php
              if($mysql_status == 0) {
              ?>
              <form method="post" id="mysql_form" action="" >
                  <p class="center"><input id="mysql_hostname" name="mysql_hostname" placeholder="MySQL hostname" required/></p>
                  <p class="center"><input id="mysql_username" name="mysql_username" placeholder="MySQL username" required/></p>
                  <p class="center"><input id="mysql_password" name="mysql_password" type="password" placeholder="MySQL password" required/></p>
                  <p class="center"><input id="mysql_database" name="mysql_database" placeholder="MySQL database" required/></p>
                  <p class="center"><input type="submit" class="button" value="Check connection"></p>
              </form>
              <?php
              }
              ?>
          </div>
          <div class="services__card">
          <h1><span>Registration</span> Setup:</h1>
              
              <p class="center">Status: <span id="status2"><?php
              if($reg_status == 1) {
                  echo "Connected";
              } else {
                  echo "Not done yet";
              }
              ?></span></p>
              <?php
              if($reg_status == 0) {
              ?>
              <form method="post" id="reg_form" action="" >
                  <p class="center">E-mail verification: <input type="checkbox" id="reg_email" onclick="reg_email_a()" /></p>
                  <div id="reg_email_form">
                      
                  </div>
                  <p class="center">Captcha: <input type="checkbox" id="reg_captcha" onclick="reg_captcha_a()"/></p>
                  <div id="reg_captcha_form">
                      
                  </div>
                  <p class="center"><input type="submit" class="button" value="Check connection"></p>
              </form>
              <?php
              }
              ?>
          </div>
        </div>
        <p class="logo">Vulpine GDPS core © Foxodever x Keisi</p>
    </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>
    function reg_captcha_a() {
        if(document.getElementById("reg_captcha").checked) {
            document.getElementById("reg_captcha_form").innerHTML = `
            
            <p class="center">
            Type:
                <select id="reg_captcha_type">
                    <option value="hCaptcha">hCaptcha</option>
                </select>
            </p>
            <p class="center"><input id="reg_captcha_public" placeholder="Captcha key" required/></p>
            <p class="center"><input id="reg_captcha_secret" placeholder="Captcha secret key" required/></p>`;
        } else {
            document.getElementById("reg_captcha_form").innerHTML = ``;
        }
    }
    function reg_email_a() {
        if(document.getElementById("reg_email").checked) {
            document.getElementById("reg_email_form").innerHTML = `
            <p class="center"><input id="reg_email_smtp" placeholder="SMTP server address" required/></p>
            <p class="center"><input id="reg_email_email" placeholder="E-mail address" type="email" required/></p>
            <p class="center"><input id="reg_email_password" placeholder="E-mail password" type="password" required/></p>
            <p class="center">
            Type:
                <select id="reg_email_type">
                    <option value="ssl">SSL</option>
                    <option value="tls">TLS</option>
                </select>
            </p>
            <p class="center"><input id="reg_email_port" type="number" placeholder="SMTP server port" required/></p>`;
        } else {
            document.getElementById("reg_email_form").innerHTML = ``;
        }
    }
    $( document ).ready(function() {
        $("#mysql_form").submit(
        		function(){
        			mysql_check();
        			return false; 
        		}
    	);
    });
    function mysql_check() {
        document.getElementById("status").style.color = "white";
        $("#status").html('<div class="lds-dual-ring"></div> Loading');
        let mysql_hostname = document.getElementById("mysql_hostname").value;
        let mysql_username = document.getElementById("mysql_username").value;
        let mysql_password = document.getElementById("mysql_password").value;
        let mysql_database = document.getElementById("mysql_database").value;
        $.ajax({
            type: "POST",
            url: "/setup_mysql.php",
            data: { mysql_hostname, mysql_username, mysql_password, mysql_database }
        }).done(function(r) {
            if(r == "1") {
                document.getElementById("status").style.color = "lime";
                $("#status").html("Connected");
                $("#mysql_form").html("");
            } else {
                document.getElementById("status").style.color = "red";
                $("#status").html(r);
            }
        });
    }
    $( document ).ready(function() {
        $("#reg_form").submit(
        		function(){
        			reg_check();
        			return false; 
        		}
    	);
    });
    function reg_check() {
        let reg_email = false;
        if(document.getElementById("reg_email").checked) reg_email = true;
        let reg_email_smtp, reg_email_email, reg_email_password, reg_email_type, reg_email_port = "";
        if(reg_email) {
            reg_email_smtp = document.getElementById("reg_email_smtp").value;
            reg_email_email = document.getElementById("reg_email_email").value;
            reg_email_password = document.getElementById("reg_email_password").value;
            reg_email_type = document.getElementById("reg_email_type").value;
            reg_email_port = document.getElementById("reg_email_port").value;
        }
        
        let reg_captcha = false;
        if(document.getElementById("reg_captcha").checked) reg_captcha = true;
        let reg_captcha_secret, reg_captcha_public, reg_captcha_type = "";
        if(reg_captcha) {
            reg_captcha_type = document.getElementById("reg_captcha_type").value;
            reg_captcha_secret = document.getElementById("reg_captcha_secret").value;
            reg_captcha_public = document.getElementById("reg_captcha_public").value;
        }
        document.getElementById("status2").style.color = "white";
        $("#status2").html('<div class="lds-dual-ring"></div> Loading');
        $.ajax({
            type: "POST",
            url: "/setup_reg.php",
            data: { reg_email, reg_captcha, reg_email_smtp, reg_email_email, reg_email_password, reg_email_type, reg_email_port, reg_captcha_public, reg_captcha_secret }
        }).done(function(r) {
            if(r == "1") {
                document.getElementById("status2").style.color = "lime";
                $("#status2").html("Connected");
                $("#reg_form").html("");
            } else {
                document.getElementById("status2").style.color = "red";
                $("#status2").html(r);
            }
        });
    }
</script>
<?php
} else {
    if($session_account_id == 0) {
        include "login.php";
    } else {
        if(main::isAdmin($session_account_id)) {
            exit("1");
        } else {
            exit("2");
        }
    }
}
?>
