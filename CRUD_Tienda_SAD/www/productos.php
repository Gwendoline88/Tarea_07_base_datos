<?php
include 'db.php';

$query = "SELECT p.Nombre, p.Descripcion, p.Precio, p.Stock, pr.Nombre as Proveedor 
          FROM Productos p 
          INNER JOIN Proveedores pr ON p.id_proveedor = pr.id_proveedor";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Abarrotes Lupita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo claro */
            font-family: 'Arial', sans-serif; /* Fuente general para la página */
        }
        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        h1 {
            color: #007bff; /* Título en color azul */
            margin-bottom: 20px; /* Espacio debajo del título */
        }
        .footer-btn {
            display: flex;
            justify-content: space-between; /* Ajusta los botones a ambos extremos */
        }
        .btn-primary, .btn-secondary {
            background-color: #007bff; /* Botón en color azul */
            border: none; /* Sin bordes */
        }
        .btn-secondary {
            background-color: #6c757d; /* Botón en color gris para volver */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Lista de Productos</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['Descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['Precio']); ?></td>
                <td><?php echo htmlspecialchars($row['Stock']); ?></td>
                <td><?php echo htmlspecialchars($row['Proveedor']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="footer-btn">
        <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        <a href="addproduct.php" class="btn btn-primary">Agregar Producto</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kanmXOUFw5jEw4meWkQH5hq8i5I7onuTBQIAXoV3uIgXPm/dh4T9qfM+06bx4u0P" crossorigin="anonymous"></script>
</body>
</html>
