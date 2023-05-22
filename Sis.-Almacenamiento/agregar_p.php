<!DOCTYPE html>
<html>

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
                            <a class="nav-link" href="editar_p.php">Editar producto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Conexion con la base de datos -->
    <main>
    <section class="form">
    <?php
    if(isset($_POST['enviar'])){ //presiona el boton
        include("config/conexion.php");    
        
        $nombre_p = $_POST['nombre_p'];
        $genero = $_POST['genero'];
        $precio_p = $_POST['precio_p'];
        $talla = $_POST['talla'];
        $categoria = $_POST['categoria'];
        $temporada = $_POST['temporada'];
        $descuento = $_POST['descuento'];
        $stock = $_POST['stock'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        
        $sql="INSERT INTO producto(nombre_p, genero, 
        precio_p, talla, categoria, temporada, descuento, imagen, stock) 
        VALUES ('$nombre_p', '$genero', '$precio_p', '$talla', '$categoria','$temporada', '$descuento', '$imagen', '$stock')";
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index.php');
            </script>";
        }
        mysqli_close($conexion);
    }
?>

<!--Formulario de producto nuevo-->
        <form class="product" action="" method="POST" enctype="multipart/form-data">
            <h1>Agregar producto</h1>
                <input type="text" name="nombre_p" placeholder="Nombre" required>
                <input type="text" name="genero" placeholder="Genero" required>
                <input type="text" name="precio_p" placeholder="Precio producto" require>
                <input type="text" name="talla" placeholder="Talla" required>
                <input type="text" name="categoria" placeholder="Categoria" required>
                <input type="text" name="temporada" placeholder="Temporada" required>
                <input type="number" name="descuento" placeholder="Descuento" required>
                <input type="number" name="stock" placeholder="Stock" require>
                <input type="file" name="imagen"/>

                <button type="submit" name="enviar">Enviar</button>
                <button><a href="index.php">Regresar</a></button>
        </form>
    </section> 
    </main>
</body>

</html>