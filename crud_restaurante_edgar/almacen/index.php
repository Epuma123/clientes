<?php
    require_once __DIR__ .'/includes/functions.php';
    $productos = obtenerProductos();
    if (isset($_GET["mensaje"])){
        $message = $_GET["mensaje"];
    }
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarProducto($_GET['id']);
        $mensaje = $count > 0 ? "Producto eliminado con éxito." : "No se pudo eliminar el producto.";
        header("Location: index.php?mensaje=$mensaje");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de inventario</h1>

        <?php if (isset($message)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <script>
                alert("<?php echo $message; ?>");
                window.location.href = "index.php";
            </script>
            </div>
        <?php endif; ?>

        <a href="agregar_producto.php" class="button">Agregar Nuevo Producto</a>

        <h2>Lista de Productos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
              
                <th>Disponible</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                <td><?php echo htmlspecialchars($disponible = $producto['stock'] > 0 ? 'SI' : 'NO'); ?></td>
                <td class="actions">
                <a href="editar_producto.php?id=<?php echo $producto['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $producto['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>