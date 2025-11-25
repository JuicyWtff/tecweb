<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Read\Products;

    if (isset($_POST['id'])) {
        $producto = new Products('marketzone');
        $producto->single($_POST['id']);
        echo $producto->getData();
    }
?>