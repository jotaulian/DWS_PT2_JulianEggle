<?php 
    require_once('Utils.php');

    class Ninos {
        
        protected $_conexion;

        // Constructor
        public function __construct(){
            $this->_conexion = Utils::conectar();
        }

        // SelectAll
        public function selectAll(){
            $sql = 'SELECT * FROM ninos';
            return $this->_conexion->query($sql);
        }

        // Select Niños Buenos
        public function selectAllGood(){
            $sql = 'SELECT * FROM ninos WHERE buen_comportamiento = "Si"';
            return $this->_conexion->query($sql);
        }

        //Select
        public function select($id){
            $sql = 'SELECT * FROM ninos WHERE id = '.(int)$id;
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
            if(!isset($data['apellido'])){
                $data['apellido'] = null;
            }
            if(!isset($data['fecha_nacimiento'])){
                $data['fecha_nacimiento'] = null;
            }
            if(!isset($data['buen_comportamiento'])){
                $data['buen_comportamiento'] = null;
            }

            $sql = 'INSERT INTO ninos (nombre, apellido, fecha_nacimiento, buen_comportamiento) VALUES ("'.$data['nombre'].'", "'.$data['apellido'].'", "'.$data['fecha_nacimiento'].'", "'.$data['buen_comportamiento'].'")';

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
            if(!isset($data['apellido'])){
                $data['apellido'] = null;
            }
            if(!isset($data['fecha_nacimiento'])){
                $data['fecha_nacimiento'] = null;
            }
            if(!isset($data['buen_comportamiento'])){
                $data['buen_comportamiento'] = null;
            }

            $sql = 'UPDATE ninos SET nombre = "'.$data['nombre'].'", apellido = "'.$data['apellido'].'", fecha_nacimiento = "'.$data['fecha_nacimiento'].'", buen_comportamiento = "'.$data['buen_comportamiento'].'" WHERE id = '.(int)$data['id'];

            $this->_conexion->query($sql);
            return (int)$data['id'];
        }

        //Delete
        public function delete($id){
            $sql = 'DELETE FROM ninos WHERE id = '.(int)$id;
            return $this->_conexion->query($sql);
        }

    }

?>