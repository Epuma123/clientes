<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerClientes() {
        global $collectionClientes;
        return $collectionClientes->find();
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
    function crearCliente($nombre, $correo, $telefono, $direccion) {
        global $collectionClientes;
        $resultado = $collectionClientes->insertOne([
            'nombre' => sanitizeInput($nombre),
            'correo' => sanitizeInput($correo),
            'telefono' => sanitizeInput($telefono),
            'direccion' => sanitizeInput($direccion),
            // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerClientePorId($id) {
        global $collectionClientes;
        return $collectionClientes->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarCliente($id, $nombre, $correo, $telefono, $direccion) {
        global $collectionClientes;
        $resultado = $collectionClientes->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'correo' => sanitizeInput($correo),
                'telefono' => sanitizeInput($telefono),
                'direccion' => sanitizeInput($direccion)
                // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarCliente($id) {
        global $collectionClientes;
        $resultado = $collectionClientes->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>