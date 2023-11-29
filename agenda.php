<?php
    // Esta parte de codigo se pone al principio, ya que es necesaria para cargar la pagina
    require "protec.php"; // archivo de proteccion contra intrusos (IMPORTANTE, AL USAR LAS VARIABLES DE SERVIDOR, NO ES NECESARIO PASARLE LA ID DEL USUARIO COMO SE HACE EN TODA LA APLICACION)
    // Implementamos los datos de la conexion
    require "conexion.php";
    // Tomamos los datos del usuario que ingreso, esto fue pasado por la URL
    $id_usuario=$_GET["id"];
    // En esta parte de codigo lo que se busca es obtener los datos del usuario que ingreso
    $sql_usuario = "SELECT nombre FROM usuarios WHERE id_usuario=".$id_usuario;
    $req= mysqli_query($conectar,$sql_usuario);
    // Obtengo el usuario, este metodo se usa cuando voy a obtener una sola fila para mi array
    $usuario=mysqli_fetch_assoc($req);
    // En esta parte de codigo lo que se busca es obtener las tareas del usuario, ordenandolas
    // de menor a mayor segun la fecha
    $sql_tareas = "SELECT * FROM tareas WHERE id_usuario='$id_usuario' ORDER BY fecha ASC";
    $req2= mysqli_query($conectar,$sql_tareas);
    $tareas = mysqli_fetch_all($req2,MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <!-- Bootstrap ICONS  se puede buscar en https://icons.getbootstrap.com/ abajo del todo donde dice CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <!-- Aca uso datos del usuario, para usarlo en el titulo de mi aplicacion -->
        <title>Agenda de <?php echo $usuario["nombre"] ?> </title>
    </head>
    <body class="bg-dark">
        <br>
        <div class="container bg-secondary border border-success">
            <br>
            <div class="row">
                <div class="col-11">
                    <!-- Formulario, usa el metodo POST y la direccion a la va, uso el id del usuario para pasar por la URL -->
                    <form method="post" action="nuevatarea.php?id=<?php echo($id_usuario)?>" >
                        <div class="form-row" >
                            <div class="col-8">
                                <!-- Es importante poner el "name" para identificar el campo del formulario (El id no se si es necesario)-->
                                <input type="text" class="form-control" name="tarea" id="tarea" placeholder="Escribe tu tarea aqui...">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control" name="fecha" id="fecha">
                            </div>
                            <div class="col-1 text">
                                <!-- Boton es de tipo submit, ya que es necesario para identificar que se pasaran datos del formulario -->
                                <button type="submit" class="btn btn-info bi bi-save" title="Guardar tarea"></button>
                            </div>
                        </div>
                    </form>
                </div>
                <span class="col text-right">
                    <!-- Boton para cerrar la sesion del usuario -->
                    <a href="salir.php" class="btn btn-danger bi bi-box-arrow-up-right" title="Cerrar sesion"></a>
                </span>
            </div>
            <br>
            <!-- Esta parte del codigo sirve para mostrar las tareas, se va a recorrer el array de las tareas y -->
            <!-- por cada taria se creara un elemento list-group -->
            <ul class="list-group">
                <?php
                if ($tareas){ // verifico que exista alguna tarea
                    foreach ($tareas as $t){ // iteramos sobre el array de tareas
                    ?>
                        <!-- Creamos un elemento list-group -->
                        <li class="list-group-item bg-light border border-dark" style="margin-top:2px">
                            <div class="row">
                                <!-- Dentro del elemento pongo los datos relacionados a la tarea -->
                                <div class="col-5 text-left">
                                    <h5>
                                        <?php echo $t['tarea']; ?>
                                    </h5>
                                </div>
                                <span class="col text-right">
                                    <!-- Estado de la tarea-->
                                    <h5>
                                        <?php // Segun el estado, muestro un texto distinto
                                            if ($t['estado']==0){
                                                echo ("Tarea Finalizada");
                                            }else if ($t['estado']==1){
                                                echo ("Tarea en proceso");
                                            }
                                        ?>
                                    </h5>
                                </span>
                                <span class="col text-right">
                                    <!-- Muestro la fecha de la tarea  -->
                                    <h5>
                                    <?php echo $t['fecha']; ?>
                                    </h5>
                                </span>
                                <span class="col">
                                    <!-- Boton borrar tarea IMPORTANTE[etiqueta "a" y tipo "button"] uso href para ejecurar el archivo de borrar (paso id de usuario y id de tarea por URL)-->
                                    <!-- Es necesario parar el id del usuario para poder regresar -->
                                    <a href="borrartarea.php?id=<?php echo($id_usuario)?>&idtarea=<?php echo($t["id_tarea"])?>" type="button" class="btn btn-danger float-right bi bi-trash" style="margin:2px;" title="Borrar tarea"></a>
                                    <!-- Boton de tarea cambia estado de tarea -->
                                    <a href="estadotarea.php?id=<?php echo($id_usuario)?>&idtarea=<?php echo($t["id_tarea"])?>" type="button" class="btn btn-success float-right bi bi-calendar-check" style="margin:2px;" title="Cambiar estado de tarea"></a>
                                    <!-- Boton para editar la tarea (Observar, añade a la URL GET["mod"], para despledar formulario de edicion)-->
                                    <a href="agenda.php?id=<?php echo($id_usuario)?>&mod=<?php echo($t["id_tarea"])?>" type="button" class="btn btn-warning float-right bi bi-pencil-square" style="margin:2px;" title="Editar tarea"></a>
                                </span>
                            </div>
                            <?php
                                // Formulario de edicion, se verifica que exista el "mod" en la URL y que el valor sea igual al de la tarea (Para que se abra en la tarea seleccionada)
                                if (isset($_GET["mod"]) and ($_GET["mod"]==$t["id_tarea"])){
                                    $id_tarea_mod = $_GET["mod"];
                                    ?>
                                    <br>
                                    <!-- Formulario, me dirige al archivo modificar tarea y se mandan por URL el id de usuario y el id de la tarea -->
                                    <form method="post" action="modificartarea.php?id=<?php echo($id_usuario)?>&idtarea=<?php echo($id_tarea_mod)?>">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="tarea_m" id="tarea_m" placeholder="Editar tarea">
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="fecha_m" id="fecha_m">
                                            </div>
                                            <span class="col-1">
                                                <button type="submit" class="btn btn-warning bi bi-save"></button>
                                            </span>
                                        </div>
                                    </form>
                                    <?php
                                }
                            ?>
                        </li>
                    <?php
                    }
                }else{?>
                    <!-- Muestro una alerta en caso de que no existan tareas asignadas al usuario -->
                    <div class="alert alert-success" role="alert">
                        No tienes tareas aun.
                    </div>
                <?php
                }
                ?>
            </ul>
            <br>
        </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>