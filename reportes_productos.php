<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/imagen_inicio.png',10,8,18);
    // Arial bold 15
    $this->SetFont('Arial','B',13);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de productos',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(35, 8, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(30, 8, 'Genero', 1, 0, 'C', 0);
    $this->Cell(19, 8, 'Precio', 1, 0, 'C', 0);
    $this->Cell(20, 8, 'Talla', 1, 0, 'C', 0);
    $this->Cell(30, 8, 'Categoria', 1, 0, 'C', 0);
    $this->Cell(30, 8, 'Temporada', 1, 0, 'C', 0);
    $this->Cell(13, 8, '-%', 1, 0, 'C', 0);
    $this->Cell(15, 8, 'Stock', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require'config/conexion.php';
$consulta = "Select * From producto";
$resultado = $conexion->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(35, 9, $row['nombre_p'], 1, 0, 'C', 0);
    $pdf->Cell(30, 9, $row['genero'], 1, 0, 'C', 0);
    $pdf->Cell(19, 9,('$ ') .$row['precio_p'], 1, 0, 'C', 0);
    $pdf->Cell(20, 9, $row['talla'], 1, 0, 'C', 0);
    $pdf->Cell(30, 9, $row['categoria'], 1, 0, 'C', 0);
    $pdf->Cell(30, 9, $row['temporada'], 1, 0, 'C', 0);
    $pdf->Cell(13, 9, $row['descuento'], 1, 0, 'C', 0);
    $pdf->Cell(15, 9, $row['stock'], 1, 1, 'C', 0);
}

$pdf->Output();
?>
