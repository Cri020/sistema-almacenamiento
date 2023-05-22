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
    $this->Cell(70,10,'Reporte de empleados',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(28, 8, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(40, 8, 'Apellido Paterno', 1, 0, 'C', 0);
    $this->Cell(40, 8, 'Apellido Materno', 1, 0, 'C', 0);
    $this->Cell(20, 8, 'Usuario', 1, 0, 'C', 0);
    $this->Cell(35, 8, utf8_decode('Contraseña'), 1, 0, 'C', 0);
    $this->Cell(28, 8, 'Telefono', 1, 1, 'C', 0);
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
$consulta = "Select * From empleados";
$resultado = $conexion->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(28, 9, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(40, 9, utf8_decode($row['apellido_pat']), 1, 0, 'C', 0);
    $pdf->Cell(40, 9, utf8_decode( $row['apellido_mat']), 1, 0, 'C', 0);
    $pdf->Cell(20, 9, $row['usuario'], 1, 0, 'C', 0);
    $pdf->Cell(35, 9, $row['contraseña'], 1, 0, 'C', 0);
    $pdf->Cell(28, 9, $row['telefono'], 1, 1, 'C', 0);
}

$pdf->Output();
?>
