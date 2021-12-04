<?php 
    if(!empty($_GET['id'])){
        require_once('./modelos/Regalos.php');
        $modeloRegalos = new Regalos();

        $idRegalo = (int) filter_input(INPUT_GET, 'id');
        $modeloRegalos->delete($idRegalo);
        header('Location:regalos.php?msg=77');
    }else{
        header('Location:regalos.php');
    }


?>