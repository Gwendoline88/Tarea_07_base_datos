<?php
include 'db.php';

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_proveedor = $_POST['id_proveedor'];

    // Preparar la llamada al procedimiento almacenado
    $stmt = mysqli_prepare($conn, "CALL AddProduct(?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssdii", $nombre, $descripcion, $precio, $stock, $id_proveedor);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        echo "<script>alert('Producto agregado con exito'); window.location.href='productos.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el producto'); window.location.href='addproduct.php';</script>";
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Abarrotes Lupita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Agregar Nuevo Producto</h1>
    <form action="addproduct.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                <?php
                // Consultar la lista de proveedores para el select
                $query = "SELECT id_proveedor, Nombre FROM Proveedores";
                $res = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value='{$row['id_proveedor']}'>{$row['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kanmXOUFw5jEw4meWkQH5hq8i5I7onuTBQIAXoV3uIgXPm/dh4T9qfM+06bx4u0P" crossorigin="anonymous"></script>
</body>
</html>
