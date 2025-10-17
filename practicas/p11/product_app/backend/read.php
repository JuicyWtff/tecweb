<?php
    include_once __DIR__.'/database.php';

    $data = array();
    
    if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        
        // Se construye la consulta insertando la variable del usuario directamente
        $query = "SELECT * FROM productos WHERE nombre LIKE '%{$searchTerm}%' OR marca LIKE '%{$searchTerm}%' OR detalles LIKE '%{$searchTerm}%'";

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $product = array();
                foreach ($row as $key => $value) {
                    $product[$key] = utf8_encode($value);
                }
                $data[] = $product;
            }
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($conexion));
        }
        
        $conexion->close();
    }
    
    echo json_encode($data, JSON_PRETTY_PRINT);
?>