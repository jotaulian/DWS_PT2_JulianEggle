<?php 
    if(!empty($_GET['id'])){
        require_once('./modelos/Ninos.php');
        $modeloNinos = new Ninos();

        $idNino = (int) filter_input(INPUT_GET, 'id');
        $modeloNinos->delete($idNino);
        header('Location:ninos.php?msg=77');
    }else{
        header('Location:ninos.php');
    }


?>