<?php 

class Utils{
    public static function conectar(){
            $servidor = 'localhost';
            $usuario = 'studium';
            $clave = 'studium__';
            $baseDeDatos = 'studium_dws_p2';
            
            $conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);
            if (mysqli_connect_error()) {
                die('Error de Conexion (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
            }
            $conexion->set_charset('utf8');

            return $conexion;
    }
}


?>