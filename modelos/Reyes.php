<?php 
    require_once('Utils.php');

    class Reyes {
        
        protected $_conexion;

        // Constructor
        public function __construct(){
            $this->_conexion = Utils::conectar();
        }

        // SelectAll
        public function selectAll(){
            $sql = 'SELECT * FROM pedidos';
            return $this->_conexion->query($sql);
        }

        // Select Todos los pedidos de un Rey
        public function selectPedidosDeRey($reymago_id){
            $sql = 'SELECT pedidos.nino_id, pedidos.regalo_id, regalos.nombre, regalos.precio, regalos.reymago_id FROM pedidos INNER JOIN regalos ON pedidos.regalo_id = regalos.id WHERE reymago_id = '.(int)$reymago_id . ' ORDER BY pedidos.nino_id';

            return $this->_conexion->query($sql);
        }

    }

?>