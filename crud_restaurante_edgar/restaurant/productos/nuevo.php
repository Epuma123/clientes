<?php
require_once __DIR__ . '/../includes/functions_producto.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearProducto($_POST['nombre'], floatval($_POST['precio']), $_POST['descripcion'], $_POST['categoria']);
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
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Precio: <input type="number" name="precio" step="any" required></label>
            <label>Descripción: <textarea name="descripcion" required></textarea></label>
            <label>
                Categoria: 
                <select name="categoria" required>
                    <option value="sopa">Sopa</option>
                    <option value="segundo">Segundo</option>
                    <option value="bebida">Bebida</option>
                    <option value="postre">Postre</option>
                </select></label>
            <input type="submit" value="Agregar Producto">
        </form>
        <a href="index.php" class="button">Volver a la lista de productos</a>
    </div>
</body>

</html>