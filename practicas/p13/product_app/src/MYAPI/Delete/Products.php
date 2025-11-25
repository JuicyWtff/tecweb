<?php
namespace MYAPI\Delete;

use MYAPI\Database\DataBase;

class Products extends DataBase {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function delete($id) {
        $this->data = array(
            'status'  => 'error',
            'message' => 'No se pudo eliminar el producto'
        );
        
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
        
        if ($this->conexion->query($sql)) {
            $this->data['status'] = "success";
            $this->data['message'] = "Producto eliminado";
        } else {
            $this->data['message'] = "ERROR: No se ejecutó $sql. " . $this->conexion->error;
        }
    }
}
?>
