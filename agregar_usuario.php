<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="estilos/style_registro_usu.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/fontawesome.min.css">
   <link
      rel="icon"
      href="https://cdn-icons-png.flaticon.com/512/2271/2271068.png"
    />
    <title>Registro de usuario nuevo</title>
</head>
<body>
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navBarTop" aria-controls="navBarTop" aria-expanded="false">
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
                            <a class="nav-link" href="reportes_productos.php">Reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="controlador/controlador_cerrar_sesion.php">Cerrar sesion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php
        if(isset($_POST['Enviar'])){ //presiona el boton
            include("config/conexion.php");

            //Asignacion de variables
            $nombre = $_POST['nombre'];
            $apellido_pat = $_POST['apellido_pat'];
            $apellido_mat = $_POST['apellido_mat'];
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $telefono = $_POST['telefono'];

            $sql="INSERT INTO empleados(nombre, apellido_pat,
            apellido_mat, usuario, contraseña, telefono) 
            VALUES ('$nombre', '$apellido_pat', '$apellido_mat', '$usuario', '$contraseña','$telefono')";
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
    
<form method="post">
    <h2>Bienvenidos</h2>
    <P>Registro de empleados</p>

    <div class="input-wrapper">
        <input type="text" name="nombre" placeholder="Nombre">
        <img class="input-icon" src="img/name.svg" alt=""> 
    </div>

    <div class="input-wrapper">
        <input type="text" name="apellido_pat" placeholder="Apellido paterno">
        <img class="input-icon" src="img/name.svg" alt=""> 
    </div>

    <div class="input-wrapper">
        <input type="text" name="apellido_mat" placeholder="Apellido materno">
        <img class="input-icon" src="img/name.svg" alt=""> 
    </div>

    <div class="input-wrapper">
        <input type="text" name="usuario" placeholder="Nom. Usuario">
        <img class="input-icon" src="img/name.svg" alt=""> 
    </div>

    <div class="input-wrapper">
        <input type="password" name="contraseña" placeholder="Contraseña">
        <img class="input-icon" src="img/password.svg" alt=""> 
    </div>

    <div class="input-wrapper">
        <input type="text" name="telefono" placeholder="Telefono">
        <img class="input-icon" src="img/phone.svg" alt=""> 
    </div>
    <input class="btn" type="submit" name="Enviar" value="Enviar">
</form>
</body>
</html>