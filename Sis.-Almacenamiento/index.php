<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
}

//////////////////////Conexion a base de datos//////////////////////////

$host="localhost";
$usuario="root";
$contraseña="123456";
$base="sis.almacen";

$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}
////////////////////// Variables de consulta //////////////////////////

$where="";

$nombre_p = $_POST['nombre_p'] ?? null;
$genero = $_POST['genero'] ?? null;
$categoria = $_POST['categoria'] ?? null;
$temporada = $_POST['temporada'] ?? null;



////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar'])){

	if (empty($_POST['busqueda'])) {
		
        $where="where nombre_p like '".$nombre_p."%'";

	}else if (empty($_POST['busqueda'])) {
		
        $where="where genero like'".$genero."'";

    }else {
       
        $where="where temporada like '".$temporada."%'";
    }
}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$producto="SELECT * FROM producto $where ";
$resproducto=$conexion->query($producto);


if(mysqli_num_rows($resproducto)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda en linea</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/all.min.css" type="text/css" rel="stylesheet">
    <link href="estilos/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <link
      rel="icon"
      href="https://cdn-icons-png.flaticon.com/512/2271/2271068.png"
    />
</head>

<body class="img-body" background= "img/fondo.jpg">
    <!-- Menu de navegacion -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="text-white bg-success p-2">
                <img class="input-icon" src="img/name.svg" alt="">
                    <?php
                    echo $_SESSION["nombre"]. " ". $_SESSION["apellido_pat"];
                    ?>
                </div>
                <a class="navbar-brand">Ventas de calzado</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarTop" aria-controls="navBarTop" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navBarTop">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Catalogo</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="agregar_p.php">Agregar producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editar_p.php">Editar producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_usuario.php">Agregar empleado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reportes_productos.php">Reporte de productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reporte_empleados.php">Reporte de empleados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="controlador/controlador_cerrar_sesion.php">Cerrar sesion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido -->
    <main>       
    <table class="tabla-p">
            <tr class="celdas-prin">
                <td class="celda-id">id</td>
                <td class="celda-nom">Nombre producto</td>
                <td class="celda-gen">Genero</td>
                <td class="celda-pre">Precio</td>
                <td class="celda-talla">Talla</td>
                <td class="celda-cat">Categoria</td>
                <td class="celda-tem">Temporada</td>
                <td class="celda-desc">Descuento</td>
                <td class="celda-stock">Stock</td>
                <td>Vista previa </td>
            </tr>

            <?php

            while($registroProducto = $resproducto ->fetch_array(MYSQLI_BOTH)){
                ?>
                <tr>
                    <td class="celda-id"><?php echo $registroProducto['id_producto'] ?></td>
                    <td class="celda-nom"><?php echo $registroProducto['nombre_p'] ?> </td>
                    <td><?php echo $registroProducto['genero'] ?> </td>
                    <td>$<?php echo $registroProducto['precio_p'] ?> </td>
                    <td><?php echo $registroProducto['talla']?> </td>
                    <td><?php echo $registroProducto['categoria'] ?> </td>
                    <td><?php echo $registroProducto['temporada'] ?> </td>
                    <td><?php echo $registroProducto['descuento'] ?> </td>
                    <td><?php echo $registroProducto['stock'] ?> </td>
                    <td><img class="img_pro" src="data:imagen/jpg;base64, <?php echo base64_encode($registroProducto['imagen'])?>"> </td>
                </tr>
                <?php
            } 
            ?>
        </table>
    </main>
</body>

</html>