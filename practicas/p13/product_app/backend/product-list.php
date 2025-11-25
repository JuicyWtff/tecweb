<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MYAPI\Read\Products;

$productos = new Products('marketzone');
$productos->list();
echo $productos->getData();
?>