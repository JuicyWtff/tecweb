<?php
    include_once __DIR__.'/database.php';

    $response = array(
        'status' => 'error',
        'message' => 'Ocurrió un error inesperado.'
    );

    $json_data = file_get_contents('php://input');
    
    if (!empty($json_data)) {
        $producto = json_decode($json_data);

        $query_check = "SELECT id FROM productos WHERE nombre = ? AND eliminado = 0";
        $stmt_check = $conexion->prepare($query_check);
        $stmt_check->bind_param('s', $producto->nombre);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $response['message'] = 'Error: El producto "' . $producto->nombre . '" ya existe.';
        } else {
            $query_insert = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conexion->prepare($query_insert);
            
            $stmt_insert->bind_param(
                'sdissss', 
                $producto->nombre,
                $producto->precio,
                $producto->unidades,
                $producto->modelo,
                $producto->marca,
                $producto->detalles,
                $producto->imagen
            );

            if ($stmt_insert->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Producto agregado exitosamente.';
            } else {
                $response['message'] = 'Error al insertar el producto.';
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    } else {
        $response['message'] = 'No se recibieron datos.';
    }

    $conexion->close();

    header('Content-Type: application/json');
    echo json_encode($response);
?>