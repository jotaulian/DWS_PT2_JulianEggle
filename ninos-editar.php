<?php 
    require_once('./modelos/Ninos.php');
    $modeloNinos = new Ninos();
    $id = 0;

    if(!empty($_POST)){
        $datosNino = [];
        $datosNino['id'] = (int)filter_input(INPUT_POST, 'id');
        $datosNino['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $datosNino['apellido'] = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
        $fechainvertida = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING);
        $datosNino['fecha_nacimiento'] = date("Y-m-d", strtotime($fechainvertida));
        $datosNino['buen_comportamiento'] = filter_input(INPUT_POST, 'buen_comportamiento', FILTER_SANITIZE_STRING);
        
        try {
            $id = $modeloNinos->update($datosNino);
            if((int)$id){
                $mensajeOK = 'Los datos del niño se han actualizado correctamente';
            }
        } catch (Exception $ex) {
            $mensajeKO = $ex->getMessage();
            $id = $datosNino['id'];
        }
    }else if(!empty($_GET)){
        $id = (int) filter_input(INPUT_GET, 'id');
        $idMensaje = (int) filter_input(INPUT_GET,'msg');
        if($idMensaje == 55){
            $mensajeOK = 'El niño ha sido añadido correctamente.';
        }
    }

    $nino = $modeloNinos->select($id);
    if($nino == null){
        header('Location: ninos.php?msg=66');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <title>Ejercicio 5 - PHP</title>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <div class="btn-group float-end">
                        <a href="ninos.php" class="btn btn-primary">Volver al Listado</a>
                        <a href="ninos-crear.php" class="btn btn-success ">Añadir niño</a>
                    </div>
                    <h1>Modificar niño</h1>
                    <!-- Alertas -->
                    <?php if(isset($mensajeKO)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeKO; ?>
                        </div>
                    <?php } else if(isset($mensajeOK)){ ?>
                        <div class="alert alert-success">
                            <?php echo $mensajeOK; ?>
                        </div>
                    <?php } ?>
                    <!-- Fin Alertas -->
                </div>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <form action="ninos-editar.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control mb-2" name="nombre" value="<?php echo $nino['nombre'] ?>" id="nombre" required>
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control mb-2" name="apellido" id="apellido" value="<?php echo $nino['apellido'] ?>" required>
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="text" class="form-control mb-2" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo date("d-m-Y", strtotime($nino['fecha_nacimiento'])) ?>" required>
                            <label for="buen_comportamiento">Ha tenido un buen comportamiento?</label>
                            <input type="text" class="form-control mb-2" name="buen_comportamiento" id="buen_comportamiento" value="<?php echo $nino['buen_comportamiento'] ?>" required>

                            <input type="hidden" name="id" value="<?php echo $nino['id'] ?>">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
