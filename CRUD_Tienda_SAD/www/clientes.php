<?php
include 'db.php';
$query = "SELECT id_cliente, Nombre, Apellido, Telefono, Correo, Direccion FROM Clientes";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Abarrotes Lupita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        h1 {
            color: #0056b3;
            margin-bottom: 20px;
        }
        .footer-btn {
            display: flex;
            justify-content: space-between;
        }
        .btn-primary, .btn-secondary {
            background-color: #007bff;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Lista de Clientes</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['Apellido']); ?></td>
                <td><?php echo htmlspecialchars($row['Telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                <td><?php echo htmlspecialchars($row['Direccion']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="footer-btn">
        <a href="addcliente.php" class="btn btn-primary">Agregar Cliente</a>
        <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kanmXOUFw5jEw4meWkQH5hq8i5I7onuTBQIAXoV3uIgXPm/dh4T9qfM+06bx4u0P" crossorigin="anonymous"></script>
</body>
</html>
