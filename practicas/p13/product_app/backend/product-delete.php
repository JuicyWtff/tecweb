<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Delete\Products;

    if (isset($_POST['id'])) {
        $producto = new Products('marketzone');
        $producto->delete($_POST['id']);
        echo $producto->getData();
    }
?>