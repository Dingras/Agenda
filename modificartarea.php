<?php
    require "protec.php";
    $tarea_m =$_POST["tarea_m"];
    $fecha_m=$_POST["fecha_m"];
    $id_tarea=$_GET["idtarea"];
    $id_usuario=$_GET["id"];
    if ((strlen($tarea_m)>0) and (strlen($fecha_m)>0)){
        $sql="UPDATE `tareas` SET `tarea`='$tarea_m',`fecha`='$fecha_m' WHERE `id_tarea`=$id_tarea";
    }elseif(strlen($tarea_m)>0){
        $sql="UPDATE `tareas` SET `tarea`='$tarea_m' WHERE `id_tarea`=$id_tarea";
    }elseif(strlen($fecha_m)>0){
        $sql="UPDATE `tareas` SET `fecha`='$fecha_m' WHERE `id_tarea`=$id_tarea";
    }else{
        $sql="";
    }
    if (strlen($sql)>0){
        require "conexion.php";
        mysqli_query($conectar,$sql);
    }
    header("location:agenda.php?id=$id_usuario");
    exit();
?>