<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <title>AgendAPP</title>
    </head>
    <body class="bg-dark">
        <div class="card text-white bg-secondary border border-success mb-3 mx-auto" style="max-width: 18rem; margin-top:10rem;">
            <div class="card-header text-center"><h5>Iniciar Sesion</h5></div>
                <div class="card-body">
                    <!-- Formulario, usa el metodo POST y la direccion a la va -->
                    <form method="post" action="ingresar.php">
                        <div class="form-group">
                            <label for="text">Nombre de Usuario</label>
                            <!-- Es importante poner el "name" para identificar el campo del formulario (El id no se si es necesario)-->
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <!-- Es importante poner el "name" para identificar el campo del formulario (El id no se si es necesario)-->
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <!-- Boton es de tipo submit, ya que es necesario para identificar que se pasaran datos del formulario -->
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                        <!-- Boton Registo (aun falta implementar) -->
                        <a href="registro.php" type="button" class="btn btn-primary float-right">Registrarse</a>
                    </form>
                    <!-- En esta parte de codigo verifico los errores que se pasan por URL -->
                    <?php
                        if (isset($_GET["op"])){
                            $OP=$_GET["op"];
                            ?>
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    if ($OP=="ERROR"){
                                        ?>
                                        Se ha producido un error
                                        <?php
                                    }elseif ($OP=="USUARIO"){
                                        ?>
                                        El usuario ingresado es incorrecto
                                        <?php
                                    }elseif ($OP=="CONTRASEÑA"){
                                        ?>
                                        La contraseña ingresada es incorrecta
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>