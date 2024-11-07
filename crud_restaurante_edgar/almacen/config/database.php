<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://dsi4:o0TPq0Qghbg8g4Tv@myatlasclusteredu.mohej.mongodb.net/?retryWrites=true&w=majority&appName=myAtlasClusterEDU");
    $database = $mongoClient->selectDataBase('almacen');
    $tasksCollection = $database->productos;
?>