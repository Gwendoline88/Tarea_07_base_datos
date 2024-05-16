<?php
include 'db.php';

header('Content-Type: application/json');

if (!isset($_POST['id_producto'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'mensaje' => 'ID de producto no proporcionado.']);
    exit;
}

$idProducto = $_POST['id_producto'];

try {
    $stmt = $conn->prepare("INSERT INTO Devoluciones (id_producto, cantidad, motivo, fecha, subtotal) VALUES (?, 1, 'test', NOW(), 10.00)");
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true, 'mensaje' => 'Inserción simplificada exitosa.']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'mensaje' => 'Error al insertar: ' . $e->getMessage()]);
}
