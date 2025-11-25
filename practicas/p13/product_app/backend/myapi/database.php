<?php
    namespace myapi;

    use mysqli;
    use Exception;


    abstract class DataBase{

        protected $conexion;

        public function __construct($host, $user, $pass, $db){
            $this->conexion = @new mysqli($host, $user, $pass, $db);

            if($this->conexion->connect_error){
                throw new Exception('No se pudo conectar a la base de datos'.$this->conexion->connect_error);
            }

            $this->conexion->set_charset("utf8");
        }

        public function __destruct(){
            if ($this->conexion) {
            $this->conexion->close();
        }
        }
    }

?>