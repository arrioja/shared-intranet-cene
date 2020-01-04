<?php
require('fpdf.php');

class PDF extends FPDF
{
//Cabecera de p�gina
function Header()
{
 	//$pdf->SetFillColor(255,0,0);
	$this->SetTextColor(1,13,231);
	//$pdf->SetDrawColor(128,0,0);
	
	//Logo
	//$this->Image('../imag/add_group.png',10,10,30);
	//Arial bold 15
	$this->SetFont('Arial','B',15);
	//Movernos a la derecha
	$this->Cell(60);
	//T�tulo
	$this->Cell(60,10,'Plan de Cuentas / SubCuentas',1,0,'C');
	//Salto de l�nea
	$this->Ln(50);
}

//Pie de p�gina
function Footer()
{
	//Posici�n: a 1,5 cm del final
	$this->SetY(-20);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//N�mero de p�gina
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,'C');
$this->Cell(20,10,'La asuncion',1,0,'C');
	
}
}

//Creaci�n del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',6);


 
 	//$pdf->SetFillColor(25,12,255);
	$pdf->SetTextColor(12,78,120);
	//$pdf->SetDrawColor(1,100,255); //color borde de linea
	$pdf->SetLineWidth(.3); //ancho de linea de celda

include "../conexion/conectar.php";
  $result=mysql_query("select * from gestion_direcciones WHERE codigo_organizacion=$_GET[seleccionado]",$link);

	//Salto de l�nea
	$pdf->Ln(20);
	
    $pdf->Cell(30); //especifica margen
    $pdf->Cell(30,5,"C�DIGO",1,0,'C');
	$pdf->Cell(100,5,"DENOMINACI�N",1,1,'C');
	
    $pdf->SetTextColor(255,0,0);
	$pdf->SetFont('Times','',10);
	while ($row=mysql_fetch_array($result))
   {
    $pdf->Cell(30); //especifica margen
    $pdf->Cell(30,5,$row[0],1,0,'C');
	$pdf->Cell(100,5,$row[2],1,1);
   }       
   
$pdf->Output();
?>
