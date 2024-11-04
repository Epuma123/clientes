<?php
require_once __DIR__ . '/../includes/functions_cliente.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$cliente = obtenerClientePorId($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarCliente($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);
    if ($count > 0) {
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
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Clientes</h1>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required></label>
            <label>Correo: <input type="email" name="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required></label>
            <label>Telefono: <input type="number" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required></label>
            <label>Direccion: <input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required></label><br>
            <input type="submit" value="Actualizar Cliente">
        </form>
        <a href="index.php" class="button">Volver a la lista de clientes</a>
    </div>
</body>

</html>