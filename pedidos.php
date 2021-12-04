<?php 
    require_once('./modelos/Pedidos.php');
    require_once('./modelos/Ninos.php');
    require_once('./modelos/Regalos.php');
    
    $modeloPedidos = new Pedidos();
    $modeloNinos = new Ninos();
    $modeloRegalos = new Regalos();
    
    if(isset($_POST['id'])){
        $nino_id = $_POST['id'];
    }else if(isset($_POST['nino_id'])){
        $nino_id = $_POST['nino_id'];
    }else if(isset($_GET['nino_id'])){
        $nino_id = (int) filter_input(INPUT_GET, 'nino_id');
    }else{
            header('Location: busqueda.php');
    }

    if(isset($_POST['regalo_id'])){
        // Hacer el insert en Pedidos...
        $datosPedido = [];
        $datosPedido['nino_id'] = $nino_id;
        $datosPedido['regalo_id'] = $_POST['regalo_id'];

        try {
            $id = $modeloPedidos->insert($datosPedido);
        } catch (Exception $ex) {
            $mensajeKO = $ex->getMessage();
        }
        header('Location: pedidos.php?nino_id='.$nino_id);
    }

    $nino = $modeloNinos->select($nino_id);
    $rows = $modeloPedidos->selectPedidosDe($nino_id);
    $regalos = $modeloRegalos->selectAll();

    $listaRegalos = [];

    // Si no hay regalos se lo informo al usuario:
    if($rows->num_rows == 0){
        $mensajeKO = 'Este niño no tiene ningun regalo en su lista.';
    }

    // Mensaje:
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
    <title>Lista de Regalos </title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="busqueda.php" class="btn btn-primary float-end"><i class="fas fa-backward"></i></i> Volver a Busqueda</a>
            <h1>Lista de Regalos de <?php echo $nino['nombre']; ?> <?php echo $nino['apellido']; ?></h1>
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
            
            <!-- Inicio Tabla Regalos de Niño -->
            <?php if((int)$rows->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $rows->fetch_assoc()){ ?>
                                <!-- Agregamos item a array -->
                                <?php $listaRegalos[] = $row['regalo_id'] ?>
                                <!-- Lo imprimimos en la lista -->
                                <tr>
                                    <td class="text-center"><?php echo $row['nombre']; ?></td>
                                    <td class="text-center"><?php echo number_format($row['precio'],2,',','.'); ?>€</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?> 
            <!-- Fin Tabla Regalos de Niño -->

            <!-- Inicio Tabla Otros Regalos -->
            <?php if((int)$regalos->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <h2 class="mb-3">Otros Regalos:</h2>
                    <form action="pedidos.php" method="post">
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example" name="regalo_id" id="regalo_id" required>
                                <?php while($regalo = $regalos->fetch_assoc()){ ?>
                                    <!-- Agregamos regalos que no esten seleccionados: -->
                                    <?php if(!in_array($regalo['id'], $listaRegalos)){ ?>
                                        <option value="<?php echo $regalo['id']; ?>" ><?php echo $regalo['nombre']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>

                            <input type="text" name="nino_id" value="<?php echo $nino_id; ?>" style="opacity: 0">

                        </div>
                            <button type="submit" class="btn btn-success mt-3">Añadir Regalo</button>
                    </form>
                </div>
            <?php } ?> 
            <!-- Fin Tabla Otros Regalos -->
            
    </div>

</body>
</html>