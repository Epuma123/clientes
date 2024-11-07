<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerProductos() {
        global $collectionProductos;
        return $collectionProductos->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        $input = htmlspecialchars(strip_tags(trim($input)));
        if (is_numeric($input)) {
            $input = max(0, $input);
        }
        return $input;
    }
    function crearProducto($nombre, $precio, $descripcion, $categoria) {
        global $collectionProductos;
        $resultado = $collectionProductos->insertOne([
            'nombre' => sanitizeInput($nombre),
            'precio' => sanitizeInput($precio),
            'descripcion' => sanitizeInput($descripcion),
            'categoria' => sanitizeInput($categoria),
            'disponible' => true,
            // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerProductoPorId($id) {
        global $collectionProductos;
        return $collectionProductos->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarProducto($id, $nombre, $precio, $descripcion, $categoria, $disponible) {
        global $collectionProductos;
        $resultado = $collectionProductos->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'precio' => sanitizeInput($precio),
                'descripcion' => sanitizeInput($descripcion),
                'categoria' => sanitizeInput($categoria),
                'disponible' => sanitizeInput($disponible)
                // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarProducto($id) {
        global $collectionProductos;
        $resultado = $collectionProductos->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>