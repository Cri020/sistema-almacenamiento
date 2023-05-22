<?php
 
require "config/conexion.php";

$columns = ['nombre_p', 'genero', 'precio_p', 'talla', 'categoria', 'temporada','descuento', 'stock', 'imagen'];
$table = "producto";

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$sql = "SELECT " . implode(", ", $columns) . "
FROM $table";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if($num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>'.$row['nombre_p'].'</td>';
        $html .= '<td>'.$row['genero'].'</td>';
        $html .= '<td>'.$row['precio_p'].'</td>';
        $html .= '<td>'.$row['talla'].'</td>';
        $html .= '<td>'.$row['categoria'].'</td>';
        $html .= '<td>'.$row['temporada'].'</td>';
        $html .= '<td>'.$row['descuento'].'</td>';
        $html .= '<td>'.$row['stock'].'</td>';
        $html .= '<td>'.$row['imagen'].'</td>';
        $html .= '</tr>';
    }
}else {
    $html.= '<tr>';
    $html.= '<td colspan="7">Sin Resultados</td>';
    $html.= '<tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>