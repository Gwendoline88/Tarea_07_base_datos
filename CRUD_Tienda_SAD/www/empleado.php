<?php
include 'db.php';
// Consulta para obtener todos los empleados
$query = "SELECT id_empleado, Nombre, Apellido, Telefono, Correo, Direccion, Fecha_contratacion FROM Empleados";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - Abarrotes Lupita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Color de fondo suave */
            font-family: 'Arial', sans-serif;
        }
        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        h1 {
            color: #0056b3; /* Color azul oscuro */
            margin-bottom: 20px;
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
            background-color: #6c757d; /* Color gris para el botón de volver */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Lista de Empleados</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Fecha de Contratación</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_empleado']); ?></td>
                <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['Apellido']); ?></td>
                <td><?php echo htmlspecialchars($row['Telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                <td><?php echo htmlspecialchars($row['Direccion']); ?></td>
                <td><?php echo htmlspecialchars($row['Fecha_contratacion']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="footer-btn">
        <a href="addempleado.php" class="btn btn-primary">Agregar Empleado</a>
        <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kanmXOUFw5jEw4meWkQH5hq8i5I7onuTBQIAXoV3uIgXPm/dh4T9qfM+06bx4u0P" crossorigin="anonymous"></script>
</body>
</html>
