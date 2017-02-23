<?php
session_start();

include 'datos.php';

$password_administrador=$_POST['password_administrador'];
$id=$_POST['id_eliminar'];

$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

$res = mysqli_query($con, "SELECT password FROM users WHERE id = '".$_SESSION["id"]."'");

if(mysqli_num_rows($res)>0){
	$aux = mysqli_fetch_array($res);

	if($aux["password"]==sha1($password_administrador)){

		$res = mysqli_query($con, "UPDATE users SET status = '0' where id = '".$id."'");

		header('Location: http://localhost/taquilla/admin/usuarios.php?eliminar=correcto');
	}
	else{
		header('Location: http://localhost/taquilla/admin/usuarios.php?error=passadmin');
	}
}
?>