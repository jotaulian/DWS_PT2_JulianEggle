<?php 
    require_once('./modelos/Ninos.php');
    $modelNinos = new Ninos();
    $rows = $modelNinos->selectAll();


    // Si no hay niños se lo informo al usuario:
    if($rows->num_rows == 0){
        $mensajeKO = 'No hay ningún niño guardado.';
    }

    // Si recibo un GET:
    // if(!empty($_GET)){
    //     $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    //     if($idMensaje == 77){
    //         $mensajeOK = 'El niño ha sido borrado correctamente';
    //     }
    //     else if($idMensaje == 66){
    //         $mensajeKO = 'Lo sentimos, el niño buscado no existe.';
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Busqueda</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <h1>Formulario de búsqueda</h1>
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
            
            <!-- Inicio Lista Desplegable -->
            <?php if((int)$rows->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <form action="pedidos.php" method="post">
                        <div class="form-group">
                            <label for="id" class="mb-2">Seleccione un niño para ver su lista de regalos:</label>
                            <select class="form-select" aria-label="Default select example" name="id" required>
                                <?php while($row = $rows->fetch_assoc()){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> <?php echo $row['apellido']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Ver</button>
                    </form>
                </div>
            <?php } ?> 
            <!-- Fin Lista -->
    </div>

</body>
</html>