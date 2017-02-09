<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'conexion/datos.php';
$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

if(isset($_POST['zona'])){

	$zona = $_POST['zona'];
	
	$result = $con->query("SELECT fila FROM morelos where seccion = '".$zona."' group by fila");

	if ($row = mysqli_fetch_array($result)){
		$html = "<option value='' disabled selected>Seleccione una fila</option>";

		do {
			$html .= "<option value='".$row['fila']."'>".$row['fila']."</option>";
		} while ($row = mysqli_fetch_array($result));

		echo $html;
		// $respuesta = array("html"=>$html);
		// echo json_encode($respuesta);
	}
}

if(isset($_POST['fila'])){

	$fila = $_POST['fila'];
	
	$result = $con->query("SELECT asiento FROM morelos where fila = '".$fila."' and status = 0");

	if ($row = mysqli_fetch_array($result)){
		$html = "<option value='' disabled selected>Seleccione una fila</option>";

		do {
			$html .= "<option value='".$row['asiento']."'>".$row['asiento']."</option>";
		} while ($row = mysqli_fetch_array($result));

		// $respuesta = array("html"=>$html);
		// echo json_encode($respuesta);
		echo $html;
	}
}

?>