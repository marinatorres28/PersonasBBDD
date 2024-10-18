<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de personas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include_once ("conexion.php");
$link=conectar();
/***Insercion***/
if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"])){
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    // se crea la consulta
    $insercion="INSERT INTO datos (nombre, apellidos) VALUES ('$nombre', '$apellidos')";
    // ejecutar la consulta y se guarda en una variable el resultado -> true o false
    $resultado=mysqli_query($link, $insercion);
    if ($resultado){
        echo "<br>Alta correctamente";
    }else{
        echo "<br>Error al insertar la persona";
    }
}
/*** Mostar las personas dadas de alta ***/
$consulta="SELECT * FROM datos";

$resultado=mysqli_query($link, $consulta); // array de los resultados, y pueden ser arrays asociativos
while ($fila = mysqli_fetch_assoc($resultado)){
    echo "<li>".$fila["nombre"]." ".$fila["apellidos"]."</li>";
}

?>
<hr>
<div class="container">
    <h1>Alta de personas</h1>

    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos">
        </p>

        <p>
            <input type="submit" value="Alta">
        </p>
    </form>
    <a href="update.php">Modificar o eliminar personas</a>
</div>

</body>
</html>