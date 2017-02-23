<?php
session_start();

include 'datos.php';
require('../fpdf/fpdf.php');

$artista=utf8_decode($_POST['artista']);
$lugar=utf8_decode($_POST['lugar']);
$fecha_evento=$_POST['fecha_evento'];
$hora_evento=$_POST['hora_evento'];
$fecha_impresion=$_POST['fecha_impresion'];
$hora_impresion=$_POST['hora_impresion'];
$zona=$_POST['zona'];
$fila=$_POST['fila'];
$asiento=$_POST['asiento_inicial'];

$no_boletos=$_POST['no_boletos'];

$precio=$_POST['precio'];
$servicio=$_POST['servicio'];
$folio_inicial=$_POST['folio_inicial'];
$folio_final = $folio_inicial + $no_boletos;

$target_path = "../../images/eventos/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name'] ); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

	$pdf = new FPDF('P','mm', array(73.5, 180));

	$pdf->SetMargins(10, 10, 10);

	$total = $precio + $servicio;

	for($i=$folio_inicial; $i<=$folio_final; $i++){
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->SetFont('Arial','B', 8);

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
		$pdf->Cell(0, 3, "Mesa: ".$fila, 0, 0, 'L', false);
		$pdf->Ln(5);
		$pdf->Cell(0, 3, "Asiento: ".$fila."-".$asiento, 0, 0, 'L', false);
		$pdf->Ln(5);
		$pdf->Cell(0, 3, "Precio: $".$precio, 0, 0, 'L', false);
		$pdf->Cell(0, 3, "Servicio: $".$servicio, 0, 0, 'R', false);
		$pdf->Ln(4);
		$pdf->Cell(0, 3, "Total: $".$total, 0, 0, 'C', false);
		$pdf->Image($target_path, 18, 82, 40, 45);
		$pdf->Ln(57);
		$pdf->SetFont('Arial','B', 6);
		$pdf->Cell(0, 3, $artista." - ".$fecha_evento." - ".$hora_evento, 0, 0, 'C', false);
		$pdf->Ln(4);
		$pdf->SetFont('Arial','B', 8);
		$pdf->Cell(0, 3, "Zona: ".$zona, 0, 0, 'L', false);
		$pdf->Cell(0, 3, "Folio: ".$folio, 0, 0, 'R', false);
		$pdf->Ln(4);
		$pdf->Cell(18, 3, "Mesa: ".$fila, 0, 0, 'L', false);
		$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asiento, 0, 0, 'C', false);
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
		$pdf->Cell(18, 3, "Mesa: ".$fila, 0, 0, 'L', false);
		$pdf->Cell(18, 3, "Asiento: ".$fila."-".$asiento, 0, 0, 'C', false);
		$pdf->Ln(4);
		$pdf->Cell(18, 3, "Precio: $".$precio, 0, 0, 'L', false);
		$pdf->Cell(18, 3, "Servicio: $".$servicio, 0, 0, 'C', false);
		$pdf->Cell(18, 3, "Total: $".$total, 0, 0, 'R', false);

		if(isset($asiento)){
			$asiento++;
		}
	}
	$pdf->Output();
}
?>