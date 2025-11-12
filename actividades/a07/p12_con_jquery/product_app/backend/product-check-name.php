<?php
    /*
    include_once __DIR__.'/database.php';

    $data = array(
        'existe' => false
    );

    if( isset($_POST['name']) ) {
        $name = $_POST['name'];
        
        // Consulta
        $sql = "SELECT id FROM productos WHERE nombre = '{$name}' AND eliminado = 0";

        // Si estamos editando, recibimos un ID. Se debe excluir ese ID de la búsqueda para no encontrarnos a nosotros mismos.
        if( isset($_POST['id']) && !empty($_POST['id']) ) {
            $id = $_POST['id'];
            $sql .= " AND id != {$id}";
        }

	    $result = $conexion->query($sql);
        
        if ($result->num_rows > 0) {
            $data['existe'] = true;
        }

        $result->free();
        $conexion->close();
    }

    // Se devuelve el JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    */

    include_once __DIR__.'/myapi/Products.php';

    $api = new \myapi\Products('marketzone');

    if ( isset($_POST['name']) ) {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $api->checkName($_POST['name'], $id);
    }

    echo $api->getData();
?>