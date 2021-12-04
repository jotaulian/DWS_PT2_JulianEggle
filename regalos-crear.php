<?php 
    require_once('./modelos/Regalos.php');
    $modeloRegalos = new Regalos();
    if(!empty($_POST)){
        $datosRegalo = [];
        $datosRegalo['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $datosRegalo['precio'] = (float)str_replace(',','.',filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING));
        $datosRegalo['reymago_id'] = filter_input(INPUT_POST, 'reymago_id', FILTER_SANITIZE_STRING);
        
        try {
            $id = $modeloRegalos->insert($datosRegalo);
        if((int) $id){
            header('Location:regalos-editar.php?msg=55&id='.$id);
        }
        } catch (Exception $ex) {
            $mensajeKO = $ex->getMessage();
        }
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
        <title>Añadir Regalo</title>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <a href="regalos.php" class="btn btn-primary float-end">Volver al Listado</a>
                    <h1>Añadir Regalo</h1>
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
                    <!-- Fin AlertaS -->
                </div>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <form action="regalos-crear.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control mb-2" name="nombre" id="nombre" required>
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control mb-2" name="precio" id="precio" placeholder="0.00" required>
                            <label for="reymago_id">Rey Mago Asignado</label>
                            <select class="form-select" aria-label="Default select example" name="reymago_id" id="reymago_id" required>
                                <option value="1">Melchor</option>
                                <option value="2">Gaspar</option>
                                <option value="3">Baltasar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>