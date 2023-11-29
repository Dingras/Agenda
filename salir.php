<?php
    require "protec.php"; # Ejecuto el script de proteccion contra intrusos
    session_destroy(); # Destruyo la sesión. Junto con ella, todos los datos que tengo guardados en la variable $_SESSION[] que estan en el servidor
    header("location: index.php"); #Redirecciono a la plantilla index.php con el mensaje SALIO
    exit();
?>