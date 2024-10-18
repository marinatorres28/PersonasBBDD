<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar-borrar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include_once "conexion.php";
$link=conectar();
if (!empty($_GET["opcion"]) && $_GET["opcion"]=="borrar") {
        $id=$_GET["id"];
        $borrar="DELETE FROM datos where id=$id";
        $resultado=mysqli_query($link,$borrar);
        if($resultado){
            echo "<br>El registro fue borrado correctamente";
        }else{
            echo "<br>El registro no fue borrado,existe un error";
        }
}
// si hay algo por el metodo post
if (isset($_POST['nombre']) && isset($_POST['apellidos'])) {
    // actualizamos
    $actualizar="update datos set nombre='$_POST[nombre]', apellidos='$_POST[apellidos]' where id=$_POST[id]";
    $resultado=mysqli_query($link,$actualizar);
    if ($resultado){
        echo "<br>El registro fue actualizado correctamente";
    }else{
        echo "<br>El registro no fue actualizado,existe un error";
    }

}
?>
<div class="container">
    <table>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>ACCIONES</th>
        </tr>
        <?php

            $sql="SELECT * FROM datos";
            $resultado=mysqli_query($link,$sql);
            while ($fila=mysqli_fetch_assoc($resultado)){
                echo "<tr>";
                echo "<td>".$fila["id"]."</td>";
                echo "<td>".$fila["nombre"]."</td>";
                echo "<td>".$fila["apellidos"]."</td>";
                echo "<td><a href='update.php?opcion=borrar&id=".$fila["id"]."'>Borrar</a></td>";
                echo "<td><a href='update.php?opcion=actualizar&id=".$fila["id"]."'>Actualizar</a></td>";
                echo "</tr>";
            }
        ?>


    </table>
    <?php
    if (isset($_GET["id"]) && $_GET["opcion"]=="actualizar"){
        // echo "Vas a actualizar";
        $consulta="select * from datos where id=$_GET[id]";
        $resultado=mysqli_query($link,$consulta);
        // si el resultado solo es un registro no se necesita un bucle para obtener el array, si no un -> mysqli_fetch_assoc($array)
        $row=mysqli_fetch_array($resultado); // $row["nombre"] me trae el nombre de la bbdd de ese registro
        ?>
    <!-- Formulario de actualizacion -->
        <form action="" method="post">
            <input type="hidden" value="<?=$row['id']?>" name="id">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?=$row['nombre']?>">
            </p>

            <p>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?=$row['apellidos']?>">
            </p>

            <p>
                <input type="submit" value="Actualizar">
            </p>


        </form>
    <?php
    }

    ?>
</div>


</body>
</html>