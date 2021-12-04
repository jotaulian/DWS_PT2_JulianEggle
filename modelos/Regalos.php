<?php 
    require_once('Utils.php');

    class Regalos {
        
        protected $_conexion;

        // Constructor
        public function __construct(){
            $this->_conexion = Utils::conectar();
        }

        // SelectAll
        public function selectAll(){
            $sql = 'SELECT * FROM regalos';
            return $this->_conexion->query($sql);
        }

        //Select
        public function select($id){
            $sql = 'SELECT * FROM regalos WHERE id = '.(int)$id;
            $rows = $this->_conexion->query($sql);
            if((int)$rows->num_rows){
                $row = $rows->fetch_assoc();
            }else{
                $row = null;
            }

            return $row;
        }

        // Insert
        public function insert($data){
            if(empty($data['nombre']))
            {
                throw new Exception('Debe rellenar el campo de NOMBRE.');
            }
            if(!isset($data['precio'])){
                $data['precio'] = null;
            }
            if(!isset($data['reymago_id'])){
                $data['reymago_id'] = null;
            }

            $sql = 'INSERT INTO regalos (nombre, precio, reymago_id) VALUES ("'.$data['nombre'].'", "'.$data['precio'].'", "'.$data['reymago_id'].'")';

            $this->_conexion->query($sql);

            return $this->_conexion->insert_id;
        }

        //Update
        public function update($data){
            if(empty($data['id']))
            {
                throw new Exception('Debe indicar la PK de la fila que desea modificar.');
            }
            if(empty($data['nombre']))
            {
                throw new Exception('Debe rellenar el campo de NOMBRE.');
            }
            if(!isset($data['precio'])){
                $data['precio'] = null;
            }
            if(!isset($data['reymago_id'])){
                $data['reymago_id'] = null;
            }

            $sql = 'UPDATE regalos SET nombre = "'.$data['nombre'].'", precio = "'.$data['precio'].'", reymago_id = "'.$data['reymago_id'].'" WHERE id = '.(int)$data['id'];

            $this->_conexion->query($sql);
            return (int)$data['id'];
        }

        //Delete
        public function delete($id){
            $sql = 'DELETE FROM regalos WHERE id = '.(int)$id;
            return $this->_conexion->query($sql);
        }

    }

?>