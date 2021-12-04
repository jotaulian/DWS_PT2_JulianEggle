<?php 
    require_once('./modelos/Regalos.php');
    $modelRegalos = new Regalos();
    $rows = $modelRegalos->selectAll();

    $reyesMagos = [1 => "Melchor", 2 => "Gaspar", 3 => "Baltasar"];

    // Si no hay regalos se lo informo al usuario:
    if($rows->num_rows == 0){
        $mensajeKO = 'No hay ningún regalo guardado.';
    }

    // Si recibo un GET:
    if(!empty($_GET)){
        $idMensaje = (int) filter_input(INPUT_GET, 'msg');
        if($idMensaje == 77){
            $mensajeOK = 'El regalo ha sido borrado correctamente';
        }
        else if($idMensaje == 66){
            $mensajeKO = 'Lo sentimos, el regalo buscado no existe.';
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
    <title>Regalos</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="regalos-crear.php" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Agregar regalo</a>
            <h1>Regalos disponibles</h1>
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
            
            <!-- Inicio Tabla -->
            <?php if((int)$rows->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Rey Mago Asignado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $rows->fetch_assoc()){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['id']; ?></td>
                                    <td class="text-center"><?php echo $row['nombre']; ?></td>
                                    <td class="text-center"><?php echo number_format($row['precio'],2,',','.'); ?>€</td>
                                    <td class="text-center"><?php echo $reyesMagos[$row['reymago_id']]; ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="regalos-editar.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-pen"></i> Editar</a>
                                            <a href="regalos-borrar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Borrar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?> 
            <!-- Fin Tabla -->
            
    </div>

</body>
</html>