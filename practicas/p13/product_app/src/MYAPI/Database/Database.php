<?php
namespace MYAPI\Database;

abstract class DataBase {
    
    protected $conexion;
    protected $data;

    public function __construct($db, $user = 'root', $pass = 'Capulin10') {
        $this->conexion = @new \mysqli('localhost', $user, $pass, $db);
        
        if($this->conexion->connect_error) {
            die('¡Base de datos NO conectada!');
        }
        
        $this->conexion->set_charset("utf8");
        $this->data = array();
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function __destruct() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
?>