<?php
require('fpdf/fpdf.php');

include 'conexion/datos.php';
$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

date_default_timezone_set("America/Mexico_city");

$seccion = $_POST['zona'];
$fila = $_POST['fila'];
$forma_pago = $_POST['forma_pago'];

$folio = 0;
$servicio = 20;

$hora_evento = "21:30:00";
$fecha_evento = "23/02/2017";

// $lugar = utf8_decode("LA REINA DISCOTEQUE");
$artista = utf8_decode("MIKE SALAZAR");

if($seccion == "Diamante"){
	$precio = 430;
}
if($seccion == "Oro"){
	$precio = 330;
}
if($seccion == "Plata"){
	$precio = 230;
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

$result = $con->query("SELECT MAX(folio) as folio FROM morelos");
if ($row = mysqli_fetch_array($result)){
	$folio = $row["folio"];
}

$folio++;

$pdf = new FPDF('P','mm', array(73.5, 180));

foreach ($_POST['asiento'] as $asientos){
	mysqli_query($con, "UPDATE morelos set status = 1, confirmacion = 1, forma_pago = '".$forma_pago."', folio = ".$folio.", user = 'Taquilla' where seccion = '".$seccion."' and fila = '".$fila."' and asiento = ".$asientos);

	$folio_nuevo = str_pad($folio, 6, "0", STR_PAD_LEFT);

	$pdf->AddPage();

	$pdf->SetMargins(10, 10, 10);
	$pdf->SetAutoPageBreak(false, 0);
	$pdf->SetFont('Arial','B', 7);

	$pdf->Ln(10);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, $artista, 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->Cell(26, 3, utf8_decode("Fecha de impresión:"), 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(26, 3, date("d/m/y"), 0, 0, 'C', false);
	$pdf->Ln(-2);
	$pdf->Cell(0, 3, "Hora: ".date("G:i:s") , 0, 0, 'R', false);
	$pdf->Ln(6);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(25, 3, "Fecha del evento", 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->Cell(25, 3, $fecha_evento, 0, 0, 'C', false);
	$pdf->Ln(-2);
	$pdf->Cell(0, 3, $hora_evento, 0, 0, 'R', false);
	$pdf->Ln(8);
	$pdf->Cell(0, 3, "CENTRO DE CONVENCIONES - ", 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(0, 3, "TEATRO MORELOS, MORELIA, MICH.", 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',9);
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
	$pdf->Image('img/mike_salazar.jpeg', 18, 82, 40, 45);
	$pdf->Ln(57);
	$pdf->SetFont('Arial','B', 7);
	$pdf->Cell(0, 3, "MIKE SALAZAR - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(0, 3, "Zona: ".$seccion, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa:", 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asientos, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);
	$pdf->Ln(10);
	$pdf->Cell(0, 3, "MIKE SALAZAR - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(0, 3, "Zona: ".$seccion, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio_nuevo, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa:", 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asientos, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);

	$folio++;
}

$pdf->Output();
?>