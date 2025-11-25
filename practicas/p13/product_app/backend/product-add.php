<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Create\Products;

    $producto = new Products('marketzone');
    $producto->add($_POST);
    echo $producto->getData();
?>