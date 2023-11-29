<?php
    // verifico que pase los campos del formulario
    if (isset($_POST["usuario"]) and isset($_POST["contraseña"])) {
        $usuario=$_POST["usuario"];
        $contraseña=md5($_POST["contraseña"]);
        // Implemento la conexion
        require "conexion.php";
        // Consulta SQL para traer todos los usuarios, asi puedo verificar la existencia del nombre de usuario
        $sql_usuario = "SELECT * FROM usuarios";
        $req = mysqli_query($conectar,$sql_usuario) or die(mysqli_error($conectar));
        $usuarios = mysqli_fetch_all($req,MYSQLI_ASSOC);
        // Creo una variable de bandera para ver si existe el usuario
        $existe = false; // No existe
        foreach($usuarios as $u) {
            // Tener en cuenta que $u es un objeto, hay que acceder a la propiedad nombre
            if ($u["nombre"]==$usuario) {
                $existe = true; // Existe
            }
        }
        // Si no existe genero la consulta y me regresa a la pantalla principal
        if (!$existe){
            $sql= "INSERT INTO `usuarios`(`nombre`, `contraseña`) VALUES ('$usuario','$contraseña')";
            mysqli_query($conectar,$sql) or die(mysqli_error($conectar));
            header("location:index.php");
            exit();
        }else{
            // Error de usuario existente
            header("location:registro.php?op=USUARIO");
            exit();
        }
    }else{
        // Error de pasaje de datos, puede ser porque no se completaron los campos
        header("location:registro.php?op=ERROR");
            exit();
    }
?>