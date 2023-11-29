<?php
# Este script sirve para proteger las plantillas, al impedir que alguien entre a la pagina sin contar con el permiso que se concede en el login.php
    session_start(); # Reanudo la sesión o la creo si esta no existe (este scrip no sirve para crear, solo para reanudar la sesión)
    if (!isset($_SESSION["usuario"])) # Verifico si NO existe el usuario (variable de servidor)
    {
        header("location: index.php"); # redirecciono al intruso a la plantilla index.php con el error NO
        exit();
    }
?>