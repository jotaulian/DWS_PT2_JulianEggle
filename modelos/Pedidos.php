<?php 
    require_once('Utils.php');

    class Pedidos {
        
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

        // Select Todos los pedidos de un Niño
        public function selectPedidosDe($nino_id){
            $sql = 'SELECT pedidos.regalo_id, regalos.nombre, regalos.precio FROM pedidos INNER JOIN regalos ON pedidos.regalo_id = regalos.id WHERE nino_id = '.(int)$nino_id;
            return $this->_conexion->query($sql);
        }

        // Insert
        public function insert($data){
            if(empty($data['nino_id']))
            {
                throw new Exception('Campo nino_id inexistente.');
            }
            if(empty($data['regalo_id']))
            {
                throw new Exception('Campo regalo_id inexistente.');
            }
            
            $sql = 'INSERT INTO pedidos (nino_id, regalo_id) VALUES ("'.$data['nino_id'].'", "'.$data['regalo_id'].'")';

            $this->_conexion->query($sql);

            return $this->_conexion->insert_id;
        }


    }

?>