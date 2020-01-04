<?php
require('fpdf.php');

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
 	//$pdf->SetFillColor(255,0,0);
	$this->SetTextColor(1,13,231);
	//$pdf->SetDrawColor(128,0,0);
	
	//Logo
	$this->Image('../imag/encabezado.png',20,20,70);
	//Arial bold 15
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
	$this->Cell(60);
	//Título
	$this->Cell(60,80,'LISTADO DE OBJETIVOS ESTRATEGICOS - DIRECCION',0,1,'C');
	//Salto de línea
	$this->Ln(1);
}

//Pie de página
function Footer()
{
	//Posición: a 1,5 cm del final
	$this->SetY(-20);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,'C');
    $this->Cell(190,10,'Contraloria del Estado Nueva Esparta - Hacia un Control Eficaz',0,0,'C');
	
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',6);


 
 	//$pdf->SetFillColor(25,12,255);
	$pdf->SetTextColor(12,78,120);
	//$pdf->SetDrawColor(1,100,255); //color borde de linea
	$pdf->SetLineWidth(.3); //ancho de linea de celda

include "../conexion/conectar.php";
$result=mysql_query("select * from gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$_GET[seleccionado]",$link);

	//Salto de línea
	$pdf->Ln(-36);
	
    $pdf->Cell(28); //especifica margen
    $pdf->Cell(15,5,"CODIGO",1,0,'C');
	$pdf->Cell(100,5,"NOMBRE",1,1,'C');
	
    $pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Times','',8);
	while ($row=mysql_fetch_array($result))
   {
    $pdf->Cell(28); //especifica margen
    $pdf->Cell(15,5,$row[1],1,0,'C');
	$pdf->Cell(100,5,$row[2],1,1);
   }       
   
$pdf->Output();
?>
