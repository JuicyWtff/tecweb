<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use MYAPI\Read\Products;

    if (isset($_GET['search'])) {
        $productos = new Products('marketzone');
        $productos->search($_GET['search']);
        echo $productos->getData();
    }
?>