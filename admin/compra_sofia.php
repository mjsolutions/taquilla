<?php
session_start();
require('fpdf/fpdf.php');

include 'conexion/datos.php';
$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

date_default_timezone_set("America/Mexico_city");

$seccion = $_POST['zona'];
$fila = $_POST['fila'];
$forma_pago = $_POST['forma_pago'];

$folio = 0;
$servicio = 30;

$hora_evento = "21:00:00";
$fecha_evento = "02/03/2017";

$lugar = "TEATRO MORELOS";

$artista = utf8_decode("SOFIA NIÑO DE RIVERA");

if($seccion == "Diamante"){
	$precio = 500;
}
if($seccion == "Oro"){
	$precio = 400;
}
if($seccion == "Plata"){
	$precio = 300;
}

if($forma_pago == 1){
	$forma_pago = "Efectivo";
}
if($forma_pago == 2){
	$forma_pago = "Tarjeta";
}
if($forma_pago == 3){
	$forma_pago = "Cortesía";
	$precio = 0;
	$servicio = 0;
}

$total = $precio + $servicio;

foreach ($_POST['asiento'] as $asientos){
	$result = $con->query("SELECT id, status FROM sofia where seccion = '".$seccion."' and fila = '".$fila."' and asiento = ".$asientos);
	if ($row = mysqli_fetch_array($result)){
		if($row["status"] == 1){
			header('Location: form_compra_sofia.php?error=ocupado');
		}
	}
}

$result = $con->query("SELECT MAX(folio) as folio FROM sofia");
if ($row = mysqli_fetch_array($result)){
	$folio = $row["folio"];
}

$folio++;

$pdf = new FPDF('P','mm', array(73.5, 180));

foreach ($_POST['asiento'] as $asientos){
	mysqli_query($con, "UPDATE sofia set status = 1, confirmacion = 1, forma_pago = '".$forma_pago."', folio = ".$folio.", user = '".$_SESSION["id"]."' where seccion = '".$seccion."' and fila = '".$fila."' and asiento = ".$asientos);

	$folio_nuevo = str_pad($folio, 6, "0", STR_PAD_LEFT);

	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false, 0);
	$pdf->SetFont('Arial','B', 8);

	$pdf->Ln(14);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, $artista, 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->Cell(26, 3, utf8_decode("Fecha de impresión:"), 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(26, 3, date("d/m/y"), 0, 0, 'C', false);
	$pdf->Ln(-2);
	$pdf->Cell(0, 3, "Hora: ".date("G:i:s"), 0, 0, 'R', false);
	$pdf->Ln(6);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(25, 3, "Fecha del evento", 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->Cell(25, 3, $fecha_evento, 0, 0, 'C', false);
	$pdf->Ln(-2);
	$pdf->Cell(0, 3, "Hora: ".$hora_evento, 0, 0, 'R', false);
	$pdf->Ln(7);
	$pdf->Cell(0, 3, $lugar, 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0, 3, "Zona: ".$seccion, 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Mesa: ", 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Asiento: ".$fila."-".$asientos, 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Servicio: $".$servicio, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(0, 3, "Total: $".$total, 0, 0, 'C', false);
	$pdf->Image('../images/eventos/sofia.jpeg', 18, 82, 40, 45);
	$pdf->Ln(57);
	$pdf->SetFont('Arial','B', 6);
	$pdf->Cell(0, 3, $artista." - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B', 8);
	$pdf->Cell(0, 3, "Zona: ".$seccion, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa: ", 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asientos, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);
	$pdf->Ln(11);
	$pdf->SetFont('Arial','B', 6);
	$pdf->Cell(0, 3, $artista." - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B', 8);
	$pdf->Cell(0, 3, "Zona: ".$seccion, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa: ", 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asientos, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);

	$folio++;
}

$pdf->Output();
?>