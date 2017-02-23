<?php
require('fpdf/fpdf.php');

include 'conexion/datos.php';
$con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

date_default_timezone_set("America/Mexico_city");

$precio = 430;
$servicio = 20;
$total = $precio + $servicio;
$seccion = "Diamante";
$fila = utf8_decode("Ñ");
$asientos = 20;
$mesa = "";
$hora_evento = "21:30:00";
$fecha_evento = "23/02/2017";
$hora_impresion = "16:50:00";
$fecha_impresion = "22/02/2017";
$artista = utf8_decode("MIKE SALAZAR");


$pdf = new FPDF('P','mm', array(73.5, 180));

for($i=417; $i<=420; $i++){
	$folio_nuevo = str_pad($i, 6, "0", STR_PAD_LEFT);

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
	$pdf->Image('../images/eventos/mike_salazar.jpeg', 18, 82, 40, 45);
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

	$asientos++;
}

$pdf->Output();
?>