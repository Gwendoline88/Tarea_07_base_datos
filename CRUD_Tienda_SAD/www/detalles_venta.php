<?php
include 'db.php';

$query = "SELECT V.id_venta, V.Fecha, V.Total, C.Nombre AS Cliente, E.Nombre AS Empleado, DV.id_detalle_venta, P.Nombre as Producto, DV.Cantidad, DV.Precio_unitario, DV.Subtotal, DV.id_producto FROM Ventas V 
JOIN Clientes C ON V.id_cliente = C.id_cliente 
JOIN Empleados E ON V.id_empleado = E.id_empleado 
JOIN Detalle_venta DV ON V.id_venta = DV.id_venta 
JOIN Productos P ON DV.id_producto = P.id_producto 
ORDER BY V.Fecha DESC";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Ventas - Abarrotes Lupita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Detalle de Ventas</h1>
    <table class="table" id="detallesVenta">
        <thead class="table-dark">
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Empleado</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_venta']; ?></td>
                <td><?php echo $row['Fecha']; ?></td>
                <td><?php echo $row['Total']; ?></td>
                <td><?php echo $row['Cliente']; ?></td>
                <td><?php echo $row['Empleado']; ?></td>
                <td><?php echo $row['Producto']; ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td><?php echo $row['Precio_unitario']; ?></td>
                <td><?php echo $row['Subtotal']; ?></td>
                <td>
                    <button onclick="realizarDevolucion(<?php echo $row['id_detalle_venta']; ?>, <?php echo $row['id_producto']; ?>, <?php echo $row['Precio_unitario']; ?>)" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Devolución</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function realizarDevolucion(idDetalleVenta, idProducto, precioUnitario) {
    let cantidad = prompt("Ingrese la cantidad a devolver:");
    let motivo = prompt("Ingrese el motivo de la devolución:");

    if (cantidad && motivo) {
        $.post('realizar_devolucion.php', {
            id_detalle_venta: idDetalleVenta,
            id_producto: idProducto,
            cantidad: cantidad,
            motivo: motivo,
            precio_unitario: precioUnitario
        }, function(response) {
            alert(response.mensaje);
            if(response.success) {
                // Recargar la tabla de detalles de ventas para reflejar los cambios
                location.reload();
            }
        }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
            alert("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        });
    }
}
</script>

</body>
</html>
