<?php
session_start();

if(!$_SESSION["autentificado"]){
  header("Location: conexion/salir.php");
} 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bolematico</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
</head>