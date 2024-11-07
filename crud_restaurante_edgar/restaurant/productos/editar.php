<?php
require_once __DIR__ . '/../includes/functions_producto.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$producto = obtenerProductoPorId($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarProducto($_GET['id'], $_POST['nombre'], floatval($_POST['precio']), $_POST['descripcion'], $_POST['categoria'], isset($_POST['disponible']));
    if ($count > 0) {
        header("Location: index.php");
        exit;
    }else {
        ?>
        <script>alert("No se actualizo ningun producto")</script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required></label>
            <label>Precio: <input type="number" name="precio" step="any" value="<?php echo htmlspecialchars($producto['precio']); ?>" required></label>
            <label>Descripcion: <textarea name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea></label>
            <label>
                Categoria: 
                <select name="categoria" required>
                    <option value="sopa">Sopa</option>
                    <option value="segundo">Segundo</option>
                    <option value="bebida">Bebida</option>
                    <option value="postre">Postre</option>
                    <option value="<?php echo htmlspecialchars($producto['categoria']); ?>" hidden selected><?php echo htmlspecialchars($producto['categoria']); ?></option>
                </select>
            </label>
            <label>Disponible: <input type="checkbox" name="disponible" <?php echo htmlspecialchars($producto['disponible'] ? "checked" : ""); ?>></label><br>
            <input type="submit" value="Actualizar Producto">
        </form>
        <a href="index.php" class="button">Volver a la lista de productos</a>
    </div>
</body>

</html>