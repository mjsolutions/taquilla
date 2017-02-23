<?php

include 'datos.php';

$usuario=$_POST['usuario'];
$password_usuario=$_POST['password'];

$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

$res = mysqli_query($con, "SELECT id, name, email, type FROM users WHERE email = '".$usuario."' AND password = '".sha1($password_usuario)."'");

    if(mysqli_num_rows($res)>0){
        session_start();

        $aux = mysqli_fetch_array($res);
        
        $_SESSION["autentificado"]=true;                     
        $_SESSION["id"]=$aux["id"];
        $_SESSION["nombre"]=$aux["name"];
        $_SESSION["email"]=$aux["email"];
        $_SESSION["type"]=$aux["type"];

        
        header('Location: http://localhost/taquilla/admin/panel.php');
    }
    else{
        header('Location: http://localhost/taquilla/index.php?error=si');
    }
?>