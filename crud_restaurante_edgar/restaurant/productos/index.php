<?php
    require_once __DIR__ .'/../includes/functions_producto.php';
    $productos = obtenerProductos();
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarProducto($_GET['id']);
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
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de productos</h1>
        <a href="nuevo.php" class="button">Agregar Nuevo Producto</a>

        <h2>Lista de Productos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Disponible</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                <td><?php echo htmlspecialchars($p['precio']); ?></td>
                <td><?php echo htmlspecialchars($p['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($p['categoria']); ?></td>
                <td><?php echo htmlspecialchars($p['disponible'] ? "Sí" : "No"); ?></td>
                <td class="actions">
                    <a href="editar.php?id=<?php echo $p['_id']; ?>" class="button">Editar</a>
                </td>
                <td>
                    <a href="index.php?accion=eliminar&id=<?php echo $p['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>