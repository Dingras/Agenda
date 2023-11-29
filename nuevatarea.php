<?php
    require "protec.php";
    // Falta implementar correctamente la parte en la que no se pasa nada en el campo fecha 
    // Verificamos que se haya pasado los datos de forma POST
    if (isset($_POST['tarea'])){
        $tarea=$_POST['tarea'];
        // Tomamos el id del usuario que se paso por la URL
        $id_usuario=$_GET['id'];
        // Se implementan datos de conexion
        require "conexion.php";
        // verifico que se haya pasado una fecha (simpre se pasa aun valor, si no se lleva el campo el resultado es 00000/00/00) hay que arreglar
        if (isset($_POST['fecha'])){
            $fecha=$_POST['fecha'];
            // Creo la consulta SQL, notar que las variable de tipo text, se les pone ' ', para no tener error
            $sql="INSERT INTO `tareas`(`tarea`, `fecha`, `id_usuario`) VALUES ('$tarea','$fecha',$id_usuario)";
        }else{
            $sql="INSERT INTO `tareas`(`tarea`, `id_usuario`) VALUES ('$tarea',$id_usuario)";
        }
        // Ejecuto la consulta
        mysqli_query($conectar,$sql) or die(mysqli_error($conectar));
        // En este caso no se necesita una respuesta
    }
    // Regresamos a la aplicacion (Recordar que el id usuario siempre se pasa, es una persistencia dentro de la aplicacion)
    header("location:agenda.php?id=".$id_usuario);
    exit();
?>