<?php
    require_once __DIR__ .'/../includes/functions_cliente.php';
    $clientes = obtenerClientes();
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarCliente($_GET['id']);
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
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de clientes</h1>
        <a href="nuevo.php" class="button">Agregar Nuevo Cliente</a>

        <h2>Lista de Clientes</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                <td><?php echo htmlspecialchars($c['correo']); ?></td>
                <td><?php echo htmlspecialchars($c['telefono']); ?></td>
                <td><?php echo htmlspecialchars($c['direccion']); ?></td>
                <td class="actions">
                    <a href="editar.php?id=<?php echo $c['_id']; ?>" class="button">Editar</a>
                </td>
                <td>
                    <a href="index.php?accion=eliminar&id=<?php echo $c['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar a este cliente?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>