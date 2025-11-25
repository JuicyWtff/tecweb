<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Read\Products;

    $data = array('existe' => false);

    if (isset($_POST['name'])) {
        $productos = new Products('marketzone');
        
        $name = $_POST['name'];
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        
        // Buscar por nombre
        $productos->search($name);
        $result = json_decode($productos->getData(), true);
        
        // Verificar si existe (excluyendo el ID si se está editando)
        if (!empty($result)) {
            foreach ($result as $producto) {
                if ($producto['nombre'] === $name && $producto['id'] != $id) {
                    $data['existe'] = true;
                    break;
                }
            }
        }
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>