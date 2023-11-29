<?php
    require "protec.php";
    if (isset($_GET["idtarea"])){
        $id_tarea = $_GET["idtarea"];
        $id_usuario = $_GET["id"];
        require "conexion.php";
        $sql = "DELETE FROM `tareas` WHERE `id_tarea`='$id_tarea'";
        mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    }
    header("location:agenda.php?id=".$id_usuario);
    exit();

?>