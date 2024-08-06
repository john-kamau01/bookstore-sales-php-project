<?php
// index.php
require 'config/config.php';
require 'controllers/SalesController.php';

$model = new SalesModel($mysqli);
$controller = new SalesController($model);
$controller->handleRequest();
?>
