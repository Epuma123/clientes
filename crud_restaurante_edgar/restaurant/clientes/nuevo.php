<?php
require_once __DIR__ . '/../includes/functions_cliente.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearCliente($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);
    if ($id) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Cliente</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Cliente</h1>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Correo: <input type="email" name="correo" required></label>
            <label>Telefono: <input type="number" name="telefono" required></label>
            <label>Direccion: <input type="text" name="direccion" required></label>
            <input type="submit" value="Agregar Cliente">
        </form>
        <a href="index.php" class="button">Volver a la lista de clientes</a>
    </div>
</body>

</html>