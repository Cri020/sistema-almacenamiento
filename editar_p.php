<?php

include("config/conexion.php");



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
    <link href="css/all.min.css" rel="stylesheet">
    <link href="estilos/style.css" rel="stylesheet">
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
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido -->
    <main>
        <?php
        $consulta= "SELECT * FROM mensajes";
        ?>
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
                <td>Editar</td>
                <td>Eliminar</td>
            </tr> 
            <?php
            $sql= "SELECT * from producto";
            $result= mysqli_query($conexion,$sql); 

            while($mostrar=mysqli_fetch_array($result)){

                ?>
                <tr>
                    <td class="celda-id"><?php echo $mostrar['id_producto'] ?></td>
                    <td class="celda-nom"><?php echo $mostrar['nombre_p'] ?> </td>
                    <td><?php echo $mostrar['genero'] ?> </td>
                    <td>$<?php echo $mostrar['precio_p'] ?> </td>
                    <td><?php echo $mostrar['talla']?> </td>
                    <td><?php echo $mostrar['categoria'] ?> </td>
                    <td><?php echo $mostrar['temporada'] ?> </td>
                    <td><?php echo $mostrar['descuento'] ?> </td>
                    <td><?php echo $mostrar['stock'] ?> </td>
                    <td><img class="img_pro" src="data:imagen/jpg;base64, <?php echo base64_encode($mostrar['imagen'])?>"> </td>
                    <td><a href="">Editar</a></td>
                    <td><a href="">Eliminar</a></td>
                </tr>
                <?php
            } 
            ?>
        </table>
    </main>
</body>

</html>