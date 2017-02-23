<?php
session_start();

include 'datos.php';

$nombre=$_POST['nombre'];
$email=$_POST['email'];
$password=$_POST['password'];
$password_confirmation=$_POST['password_confirmation'];



if($password != $password_confirmation){
	header('Location: http://localhost/taquilla/admin/nuevo_usuario.php?error=pass');
}
else{
	$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

	$res = mysqli_query($con, "INSERT INTO users VALUES (Null, '".$email."', '".sha1($password)."', 'p_venta', '".$nombre."', null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, null);" );

	header('Location: http://localhost/taquilla/admin/usuarios.php?registro=correcto');
}
?>