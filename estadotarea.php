<?php
    require "protec.php";
    $id_tarea = $_GET['idtarea'];
    $id_usuario = $_GET['id'];
    require "conexion.php";
    $sqltarea = "SELECT * FROM `tareas` WHERE `id_tarea`='$id_tarea'";
    $req = mysqli_query($conectar, $sqltarea);
    $estado = mysqli_fetch_assoc($req);
    if ($estado["estado"]==1){
        $sql1 = "UPDATE `tareas` SET `estado`=0 WHERE `id_tarea`='$id_tarea'";
        mysqli_query($conectar, $sql1);
    }else if ($estado["estado"]==0){
        $sql0 = "UPDATE `tareas` SET `estado`=1 WHERE `id_tarea`='$id_tarea'";
        mysqli_query($conectar, $sql0);
    }
    header("location:agenda.php?id=".$id_usuario);
    exit();
?>