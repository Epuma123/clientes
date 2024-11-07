<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$producto = obtenerProductoPorId($_GET['id']);

if (!$producto) {
    header("Location: index.php?mensaje=Producto no encontrado");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarProducto($_GET['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock']);
    if ($count > 0) {
        header("Location: index.php?mensaje=Producto actualizado con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar el producto.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prodcuto</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required></label>
            <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea></label>
            <label>precio: <input type="number" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required></label>


            <label>Stock: <input type="number" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required></label><br>
            <input type="submit" value="Actualizar Producto">
        </form>
        <a href="index.php" class="button">Volver a la lista de productos</a>
    </div>
</body>

</html>