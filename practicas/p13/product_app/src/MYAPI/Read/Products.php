<?php
namespace MYAPI\Read;

use MYAPI\Database\DataBase;

class Products extends DataBase {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $this->data = $rows;
            $result->free();
        } else {
            $this->data = array(
                'status' => 'error',
                'message' => "ERROR: No se ejecutó $sql. " . $this->conexion->error
            );
        }
    }

    public function search($search) {
        $sql = "SELECT * FROM productos WHERE (
            id = '{$search}' OR 
            nombre LIKE '%{$search}%' OR 
            marca LIKE '%{$search}%' OR 
            detalles LIKE '%{$search}%'
        ) AND eliminado = 0";
        
        if ($result = $this->conexion->query($sql)) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            $this->data = array(
                'status' => 'error',
                'message' => "ERROR: No se ejecutó la consulta. " . $this->conexion->error
            );
        }
    }

    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        
        if ($result = $this->conexion->query($sql)) {
            $this->data = $result->fetch_assoc();
            $result->free();
        } else {
            $this->data = array(
                'status' => 'error',
                'message' => "ERROR: No se ejecutó la consulta. " . $this->conexion->error
            );
        }
    }
}
?>