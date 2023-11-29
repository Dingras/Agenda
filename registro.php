<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <title>Registrate</title>
    </head>
    <body class="bg-dark">
    <div class="card text-white bg-secondary border border-success mx-auto mb-3" style="max-width: 18rem; margin-top: 10rem">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h5>Registrarse</h5>
                </div>
                <span>
                    <a type="button" href="index.php" class="btn btn-danger" style="border-radius: 50%;">X</a>
                </span>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="nuevousuario.php">
                <div class="form-group">
                    <label for="nombreUsuario">Nombre de usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña">
                </div>
                <button type="submit" class="btn btn-primary bi bi-person-add"> Registrarse</button>
            </form>
            <?php
                if (isset($_GET["op"])){?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        $OP = $_GET["op"];
                        if ($OP=="USUARIO"){
                            echo "El usuario ingresado ya existe.";
                        }else if ($OP == "ERROR"){
                            echo "Complete todos los campos";
                        }
                    ?>
                </div>
            <?php
            }?>
        </div>
    </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    </body>
</html>