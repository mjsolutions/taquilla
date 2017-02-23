<?php
session_start();

include 'datos.php';

$password_administrador=$_POST['password_administrador'];
$password=$_POST['password'];
$password_confirmation=$_POST['password_confirmation'];
$id=$_POST['id'];


if($password != $password_confirmation){
	header('Location: http://localhost/taquilla/admin/usuarios.php?error=pass');
}

else{

	$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

	$res = mysqli_query($con, "SELECT id, name, email, password FROM users WHERE id = '".$_SESSION["id"]."'");

	if(mysqli_num_rows($res)>0){
		$aux = mysqli_fetch_array($res);

		if($aux["password"]==sha1($password_administrador)){

			$res = mysqli_query($con, "UPDATE users SET password = '".sha1($password)."' where id = '".$id."'");

			header('Location: http://localhost/taquilla/admin/usuarios.php?cambio=correcto');
		}
		else{
			header('Location: http://localhost/taquilla/admin/usuarios.php?error=passadmin');
		}
	}
}
?>