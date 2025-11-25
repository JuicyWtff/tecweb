<?php
namespace MYAPI\Update;

use MYAPI\Database\DataBase;

class Products extends DataBase {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function edit($producto) {
        // Convertir a objeto si viene como array
        $jsonOBJ = is_array($producto) ? (object)$producto : $producto;
        
        $this->data = array(
            'status'  => 'error',
            'message' => 'No se pudo actualizar el producto'
        );
        
        $sql = "UPDATE productos SET 
            nombre = '{$jsonOBJ->nombre}', 
            marca = '{$jsonOBJ->marca}', 
            modelo = '{$jsonOBJ->modelo}', 
            precio = {$jsonOBJ->precio}, 
            detalles = '{$jsonOBJ->detalles}', 
            unidades = {$jsonOBJ->unidades}, 
            imagen = '{$jsonOBJ->imagen}' 
            WHERE id = {$jsonOBJ->id}";
        
        if ($this->conexion->query($sql)) {
            $this->data['status'] = "success";
            $this->data['message'] = "Producto actualizado";
        } else {
            $this->data['message'] = "ERROR: No se ejecutó $sql. " . $this->conexion->error;
        }
    }
}
?>