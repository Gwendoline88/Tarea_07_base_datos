<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT V.id_venta, V.Fecha, V.Total, C.Nombre AS Cliente, E.Nombre AS Empleado FROM Ventas V JOIN Clientes C ON V.id_cliente = C.id_cliente JOIN Empleados E ON V.id_empleado = E.id_empleado ORDER BY V.Fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Abarrotes Lupita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        .container { margin-top: 20px; }
        h1 { color: #333; }
        .btn-custom { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Ventas Realizadas</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Empleado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id_venta']; ?></td>
                    <td><?php echo $row['Fecha']; ?></td>
                    <td><?php echo $row['Total']; ?></td>
                    <td><?php echo $row['Cliente']; ?></td>
                    <td><?php echo $row['Empleado']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <a href="realizar_venta.php" class="btn btn-primary btn-custom">Realizar Venta</a>
    <a href="detalles_venta.php" class="btn btn-secondary btn-custom">Detalle de Ventas</a>
</div>
</body>
</html>
