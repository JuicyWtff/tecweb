<?php
namespace MYAPI\Create;

use MYAPI\Database\DataBase;

class Products extends DataBase {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add($producto) {
        // Convertir a objeto si viene como array
        $jsonOBJ = is_array($producto) ? (object)$producto : $producto;
        
        $this->data = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        
        // Verificar si el producto ya existe
        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO productos VALUES (
                null, 
                '{$jsonOBJ->nombre}', 
                '{$jsonOBJ->marca}', 
                '{$jsonOBJ->modelo}', 
                {$jsonOBJ->precio}, 
                '{$jsonOBJ->detalles}', 
                {$jsonOBJ->unidades}, 
                '{$jsonOBJ->imagen}', 
                0
            )";
            
            if($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó $sql. " . $this->conexion->error;
            }
        }
        
        $result->free();
    }
}
?>