<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Bolematico | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
    <style type="text/css">
        body {
            position: relative;
        }

        body:before {
            content: " ";
            display: block;
            position: absolute; /* could also be absolute */ 
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 0;
            background: rgba(0,0,0,0.4);
        }

        main section {
            position: relative;
            width: 100%;
            height: 100vh;
        }
        form {
            padding-top: 40px!important;
            padding-left: 0px!important;
            padding-right: 0px!important;
            margin-top: 8%;
            background: #FFF;
        }
        input[type=submit]{
            display: block;
            width: 100%;
        }
        form 
        /* label color */
        .input-field label {
            color: #01376b;
        }
        /* label focus color */
        .input-field input[type=password]:focus + label, 
        .input-field input[type=email]:focus + label,
        #textarea1:focus + label {
            color: #1467B7;
        }
        /* label underline focus color */
        .input-field input[type=password]:focus,
        .input-field input[type=email]:focus,
        #textarea1:focus {
            border-bottom: 1px solid #1467B7;
            box-shadow: 0 1px 0 0 #1467B7;
        }
        /* valid color */
        .input-field input[type=password].valid,
        .input-field input[type=email].valid,
        #textarea1.valid {
            border-bottom: 1px solid #1467B7;
            box-shadow: 0 1px 0 0 #1467B7;
        }
        /* invalid color */
        .input-field input[type=password].invalid,
        .input-field input[type=email].invalid,
        #textarea1.invalid {
            border-bottom: 1px solid #FF4000;
            box-shadow: 0 1px 0 0 #FF4000;
        }
        /* icon prefix focus color */
        .input-field .prefix.active {
            color: #1467B7;
        }
        .input-field .prefix {
            color: #01376b;
        }
    </style>
</head>
<body>
    <main>
        <section>
            <div class="row">
                <div class="col s6 offset-s3">
                    <form id="form1" action="admin/conexion/login.php" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
                        <div class="row">
                            <div class="col s12 center">
                                <img src="images/logotipo-nuevo-negro.svg" alt="" id="foto" class="responsive-img" style="max-width: 50%;">
                            </div>
                            <div class="col s6 offset-s3 divider mt-10"></div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 offset-s1">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="email" type="email" class="validate" name="usuario" required>
                                <label for="email"> Email </label>
                            </div>                  
                        </div>
                        <div class="row mb-30">
                            <div class="input-field col s10 offset-s1">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password">Contraseña</label>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col s6 center-align mt-15">
                                <a class="disabled" href="#!">Olvide mi contraseña</a>
                            </div>
                            <div class="col s6 nopadding">
                                <button type="submit" class="btn btn-large blue darken-3 waves-effect waves-light" style="display: block; width: 100%;">Login</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    error_reporting(E_ALL ^ E_NOTICE);
                    if($_GET["error"]=="si"){echo "<span style='COLOR: RED;'>Usuario no encontrado</span>";}
                    ?>
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>