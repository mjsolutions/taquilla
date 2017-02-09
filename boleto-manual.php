<?php
require('fpdf/fpdf.php');

$pdf = new FPDF('P','mm', array(73.5, 180));

$pdf->SetMargins(10, 10, 10);

$precio = 450;
$servicio = 20;
$total = $precio + $servicio;
$zona = "Oro";
$asiento = "";
$mesa = "";
$hora_evento = "21:00:00";
$fecha_evento = "10/02/2017";
$hora_impresion = "13:00:00";
$fecha_impresion = "07/02/2017";
$lugar = utf8_decode("BAR SHASA");
$artista = utf8_decode("EDGAR OCERANSKY");

for($i=101; $i<=120; $i++){
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false, 0);
	$pdf->SetFont('Arial','B', 8);
// do{
	$folio = str_pad($i, 6, "0", STR_PAD_LEFT);
	$pdf->Ln(14);
	$pdf->Cell(0, 3, "Folio: ".$folio, 0, 0, 'R', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, $artista, 0, 0, 'C', false);
	$pdf->Ln(5);
	$pdf->Cell(26, 3, utf8_decode("Fecha de impresión:"), 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(26, 3, $fecha_impresion, 0, 0, 'C', false);
	$pdf->Ln(-2);
	$pdf->Cell(0, 3, "Hora: ".$hora_impresion, 0, 0, 'R', false);
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
	$pdf->Cell(0, 3, "Zona: ".$zona, 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Mesa: ".$mesa, 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Asiento: ".$asiento, 0, 0, 'L', false);
	$pdf->Ln(5);
	$pdf->Cell(0, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Servicio: $".$servicio, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(0, 3, "Total: $".$total, 0, 0, 'C', false);
	$pdf->Image('img/oceransky.jpeg', 18, 82, 40, 45);
	$pdf->Ln(57);
	$pdf->SetFont('Arial','B', 6);
	$pdf->Cell(0, 3, $artista." - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B', 8);
	$pdf->Cell(0, 3, "Zona: ".$zona, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa: ".$mesa, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$asiento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);
	$pdf->Ln(11);
	$pdf->SetFont('Arial','B', 6);
	$pdf->Cell(0, 3, $artista." - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B', 8);
	$pdf->Cell(0, 3, "Zona: ".$zona, 0, 0, 'L', false);
	$pdf->Cell(0, 3, "Folio: ".$folio, 0, 0, 'R', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Mesa: ".$mesa, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Asiento: ".$asiento, 0, 0, 'C', false);
	$pdf->Ln(4);
	$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
	$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
	$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);
// }while($i<=1);
}
$pdf->Output();
?>