<?php 
require_once('./modelos/Ninos.php');
require_once('./modelos/Reyes.php');

$modeloNinos = new Ninos();
$modeloReyes = new Reyes();

$rows = $modeloNinos->selectAllGood();
$ninosBuenos = [];

while($row = $rows->fetch_assoc()){
    $ninosBuenos[$row['id']] = $row['nombre'].' '.$row['apellido']; 
};

$rowsMelchor = $modeloReyes->selectPedidosDeRey(1);
$rowsGaspar = $modeloReyes->selectPedidosDeRey(2);
$rowsBaltasar = $modeloReyes->selectPedidosDeRey(3);

$totalMelchor = 0;
$totalGaspar = 0;
$totalBaltasar = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Reyes Magos</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <!-- <a href="busqueda.php" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Volver a Busqueda</a> -->
            <h1 class="mb-5">Datos de los Reyes Magos</h1>
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
            
            <!-- Inicio Tabla Melchor -->
            <h2>Lista de Melchor:</h2>
            <?php if((int)$rowsMelchor->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-2">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th class="text-center">Regalo</th>
                                <th class="text-center">Niño</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $rowsMelchor->fetch_assoc()){ ?>
                                <!-- Solo agregamos regalos de los niños que se hayan portado bien: -->
                                <?php if(array_key_exists($row['nino_id'], $ninosBuenos)){ ?>
                                    <!-- Lo imprimimos en la lista -->
                                    <tr>
                                        <td class="text-center"><?php echo $row['nombre']; ?></td>
                                        <td class="text-center"><?php echo $ninosBuenos[$row['nino_id']]; ?></td>
                                    </tr>
                                    <!-- Sumamos precio del regalo al total -->
                                    <?php $totalMelchor += (float) $row['precio']; ?>
                                <?php } ?>
                            <?php } ?>
                            <tr>
                                <td class="text-center"><strong>Total de Dinero Gastado</strong></td>
                                <td class="text-center"><strong><?php echo $totalMelchor; ?> €</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?> 
            <!-- Fin Tabla Melchor -->

            <!-- Inicio Tabla Gaspar -->
            <h2>Lista de Gaspar:</h2>
            <?php if((int)$rowsGaspar->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-2">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th class="text-center">Regalo</th>
                                <th class="text-center">Niño</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $rowsGaspar->fetch_assoc()){ ?>
                                <!-- Solo agregamos regalos de los niños que se hayan portado bien: -->
                                <?php if(array_key_exists($row['nino_id'], $ninosBuenos)){ ?>
                                    <!-- Lo imprimimos en la lista -->
                                    <tr>
                                        <td class="text-center"><?php echo $row['nombre']; ?></td>
                                        <td class="text-center"><?php echo $ninosBuenos[$row['nino_id']]; ?></td>
                                    </tr>
                                    <!-- Sumamos precio del regalo al total -->
                                    <?php $totalGaspar += (float) $row['precio']; ?>
                                <?php } ?>
                            <?php } ?>
                            <tr>
                                <td class="text-center"><strong>Total de Dinero Gastado</strong></td>
                                <td class="text-center"><strong><?php echo $totalGaspar; ?> €</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?> 
            <!-- Fin Tabla Gaspar -->

            <!-- Inicio Tabla Baltasar -->
            <h2>Lista de Baltasar:</h2>
            <?php if((int)$rowsBaltasar->num_rows){ ?>
                <div class="col-12 col-md-8 offset-md-2 mt-2">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th class="text-center">Regalo</th>
                                <th class="text-center">Niño</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $rowsBaltasar->fetch_assoc()){ ?>
                                <!-- Solo agregamos regalos de los niños que se hayan portado bien: -->
                                <?php if(array_key_exists($row['nino_id'], $ninosBuenos)){ ?>
                                    <!-- Lo imprimimos en la lista -->
                                    <tr>
                                        <td class="text-center"><?php echo $row['nombre']; ?></td>
                                        <td class="text-center"><?php echo $ninosBuenos[$row['nino_id']]; ?></td>
                                    </tr>
                                    <!-- Sumamos precio del regalo al total -->
                                    <?php $totalBaltasar += (float) $row['precio']; ?>
                                <?php } ?>
                            <?php } ?>
                            <tr>
                                <td class="text-center"><strong>Total de Dinero Gastado</strong></td>
                                <td class="text-center"><strong><?php echo $totalBaltasar; ?> €</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?> 
            <!-- Fin Tabla Baltasar -->

            
    </div>

</body>
</html>