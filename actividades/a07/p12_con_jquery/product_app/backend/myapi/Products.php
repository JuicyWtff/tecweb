<?php
namespace myapi;

include_once __DIR__.'/DataBase.php';
use mysqli;

class Products extends DataBase {
    
    private $data = array();

    public function __construct($db, $host = 'localhost', $user = 'root', $pass = 'Capulin10') {
        parent::__construct($host, $user, $pass, $db);
        
        $this->data = array(
            'status' => 'error',
            'message' => 'Respuesta no inicializada'
        );
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        
        if ( $result = $this->conexion->query($sql) ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $this->data = $rows;
        } else {
            $this->data['message'] = "ERROR: No se ejecutó $sql. " . $this->conexion->error;
        }
    }

    public function search($search) {
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        
        if ( $result = $this->conexion->query($sql) ) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            $this->data['message'] = "ERROR: No se ejecutó la consulta. " . $this->conexion->error;
        }
    }

    public function add($obj) {
        $sql_check = "SELECT * FROM productos WHERE nombre = '{$obj->nombre}' AND eliminado = 0";
	    $result = $this->conexion->query($sql_check);
        
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO productos VALUES (null, '{$obj->nombre}', '{$obj->marca}', '{$obj->modelo}', {$obj->precio}, '{$obj->detalles}', {$obj->unidades}, '{$obj->imagen}', 0)";
            
            if($this->conexion->query($sql)){
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . $this->conexion->error;
            }
        } else {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
        }
        $result->free();
    }

    public function delete($id) {
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";

        if ( $this->conexion->query($sql) ) {
            $this->data['status'] =  "success";
            $this->data['message'] =  "Producto eliminado";
		} else {
            $this->data['message'] = "ERROR: No se ejecuto $sql. " . $this->conexion->error;
        }
    }

    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        
        if ( $result = $this->conexion->query($sql) ) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            $this->data['message'] = "ERROR: No se ejecutó la consulta. " . $this->conexion->error;
        }
    }

    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0";

        if ( $result = $this->conexion->query($sql) ) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            $this->data['message'] = "ERROR: No se ejecutó la consulta. " . $this->conexion->error;
        }
    }

    public function edit($obj) {
        $sql = "UPDATE productos SET 
                nombre = '{$obj->nombre}', 
                marca = '{$obj->marca}', 
                modelo = '{$obj->modelo}', 
                precio = {$obj->precio}, 
                detalles = '{$obj->detalles}', 
                unidades = {$obj->unidades}, 
                imagen = '{$obj->imagen}' 
                WHERE id = {$obj->id}";
        
        if ($this->conexion->query($sql)) {
            $this->data = array(
                'status'  => 'success',
                'message' => 'Producto editado'
            );
        } else {
            $this->data['message'] = "ERROR: No se ejecutó la consulta. " . $this->conexion->error;
        }
    }
}
?>