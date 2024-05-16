<?php
include 'db.php';

mysqli_begin_transaction($conn);

try {
    $fecha = date('Y-m-d');
    $total = array_sum(array_column($_SESSION['carrito'], 'subtotal'));
    $id_cliente = 1;
    $id_empleado = 1;

    $insert_venta = "INSERT INTO Ventas (Fecha, Total, id_cliente, id_empleado) VALUES ('$fecha', '$total', '$id_cliente', '$id_empleado')";
    mysqli_query($conn, $insert_venta);
    $id_venta = mysqli_insert_id($conn);

    foreach ($_SESSION['carrito'] as $item) {
        $insert_detalle = "INSERT INTO Detalle_venta (Cantidad, Precio_unitario, Subtotal, id_venta, id_producto) VALUES ({$item['cantidad']}, {$item['precio']}, {$item['subtotal']}, $id_venta, {$item['id_producto']})";
        mysqli_query($conn, $insert_detalle);

        $update_stock = "UPDATE Productos SET Stock = Stock - {$item['cantidad']} WHERE id_producto = {$item['id_producto']}";
        mysqli_query($conn, $update_stock);
    }

    mysqli_commit($conn);
    unset($_SESSION['carrito']); // Limpiar carrito
    echo "Venta realizada con éxito.";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error al realizar la venta: " . $e->getMessage();
}
?>
