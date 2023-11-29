<?php
    // Datos de la conexion
    // "localhost" -> es el nombre del servidor
    // "root" -> es el nombre del usuario del servidor
    // "" -> es la contraseña del usuario  del servidor
    $conectar = mysqli_connect("localhost","root",""); // Se abre la conexion
    // con este metodo designamos que base de datos vamos a usar
    mysqli_select_db($conectar,"agenda");
?>