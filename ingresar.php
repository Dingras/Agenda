<?php
    SESSION_START();
    // verificamos si se mandan datos POST
    if (isset($_POST["usuario"]) and isset($_POST["password"])){ 
        // Guardamos en una veriable los datos POST
        $usuario = $_POST['usuario']; 
        // Esta variable es encriptada con MD5 (Se usa para que nuestra contraseña sea segura)
        // en el servidor no se guarda la contraseña de manera "pura" sino que se hace en formato encriptado
        // es necesario que el tipo de dato de la contraseña sea char(32) IMPORTANTE
        $contraseña = md5($_POST["password"]);
        // Se implementa el archivo con la configuracion de la conexion a la base de datos
        // siendo la variable $conectar la que nos permite conectar con la base de datos (VER conexion.php)
        require "conexion.php";
        // Creo mi consulta SQL
        $sql = "SELECT * FROM `usuarios`";
        // Preparo la consulta para mandar al servidor de base de datos, y lo guardo en una variable
        $req = mysqli_query($conectar,$sql) or die(mysqli_error($conectar));
        // Guardo la respuesta (en general es un array)
        $usuarios = mysqli_fetch_all($req,MYSQLI_ASSOC); // MYSQLI_ASSOC --> el indice del array, es el nombre de la columna de la tabla (verificar)
        // metodo para verificar que el usuario que ingresa y su contraseña sean correctas
        foreach($usuarios as $u){
            if ($u["nombre"] == $usuario) {
                if ($u["contraseña"] == $contraseña){
                    // Direccion a la que voy si es correcto (Dejo ingresar al usuario)
                    // En la direccion http le paso el id del usuario, para usarlo como persistencia
                    $_SESSION["usuario"] = $u["nombre"];
                    $_SESSION["id_usuario"] = $u["id_usuario"];
                    header("location:agenda.php?id=".$u["id_usuario"]);
                    exit(); // finaliza el hilo de ejecucion.
                }else{
                    // Paso en la direccion el error ocurrido, CONTRASEÑA: Contraseña incorrecta (Se verifica en index.php)
                    header("location:index.php?op=CONTRASEÑA");
                    exit();
                }
            }
        }
        // Pasamos errores por http
        header("location:index.php?op=USUARIO");
        exit();
    }else{
        // Pasamos errores por http
        header("location:index.php?op=ERROR");
        exit();
    }
?>