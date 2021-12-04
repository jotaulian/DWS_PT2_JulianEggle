<?php 
    require_once('./modelos/Regalos.php');
    $modeloRegalos = new Regalos();
    $id = 0;

    if(!empty($_POST)){
        $datosRegalo = [];
        $datosRegalo['id'] = (int)filter_input(INPUT_POST, 'id');
        $datosRegalo['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $datosRegalo['precio'] = (float)str_replace(',','.',filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING));
        $datosRegalo['reymago_id'] = filter_input(INPUT_POST, 'reymago_id', FILTER_SANITIZE_STRING);
        
        try {
            $id = $modeloRegalos->update($datosRegalo);
            if((int)$id){
                $mensajeOK = 'Los datos del regalo se han actualizado correctamente';
            }
        } catch (Exception $ex) {
            $mensajeKO = $ex->getMessage();
            $id = $datosRegalo['id'];
        }
        
    }else if(!empty($_GET)){
        $id = (int) filter_input(INPUT_GET, 'id');
        $idMensaje = (int) filter_input(INPUT_GET,'msg');
        if($idMensaje == 55){
            $mensajeOK = 'El regalo ha sido añadido correctamente.';
        }
    }

    $regalo = $modeloRegalos->select($id);
    if($regalo == null){
        header('Location: regalos.php?msg=66');
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
                        <a href="regalos.php" class="btn btn-primary">Volver al Listado</a>
                        <a href="regalos-crear.php" class="btn btn-success ">Añadir niño</a>
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
                    <form action="regalos-editar.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control mb-2" name="nombre" value="<?php echo $regalo['nombre'] ?>" id="nombre" required>
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control mb-2" name="precio" id="precio" value="<?php echo $regalo['precio'] ?>" required>
                            <label for="reymago_id">Rey Mago Asignado</label>
                            <select class="form-select" aria-label="Default select example" name="reymago_id" id="reymago_id" required>
                                <option value="1" <?php if($regalo['reymago_id'] == "1"){
                                    echo "selected";
                                } ?>>Melchor</option>
                                <option value="2" <?php if($regalo['reymago_id'] == "2"){
                                    echo "selected";
                                } ?>>Gaspar</option>
                                <option value="3" <?php if($regalo['reymago_id'] == "3"){
                                    echo "selected";
                                } ?>>Baltasar</option>
                            </select>

                            <input type="hidden" name="id" value="<?php echo $regalo['id'] ?>">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
