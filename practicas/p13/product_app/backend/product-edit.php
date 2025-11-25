<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Update\Products;

    $producto = new Products('marketzone');
    $producto->edit($_POST);
    echo $producto->getData();
?>