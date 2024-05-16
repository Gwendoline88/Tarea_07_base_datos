<?php
include 'db.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $producto_info = mysqli_query($conn, "SELECT Nombre, Precio FROM Productos WHERE id_producto = $producto_id");
    if ($producto = mysqli_fetch_assoc($producto_info)) {
        // Calcular subtotal para este producto
        $subtotal = $cantidad * $producto['Precio'];

        // Agregar producto al carrito
        $_SESSION['carrito'][] = [
            'id_producto' => $producto_id,
            'nombre' => $producto['Nombre'],
            'cantidad' => $cantidad,
            'precio' => $producto['Precio'],
            'subtotal' => $subtotal
        ];

        // Respuesta para AJAX
        echo json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito']);
        exit;
    }
}

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['subtotal'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Venta - Abarrotes Lupita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container { margin-top: 20px; }
        .icon { margin-right: 5px; }
        .alert { display: none; }
    </style>
</head>
<body>
<div class="container">
    <h1><i class="fas fa-cash-register icon"></i> Realizar Venta</h1>
    <form id="venta-form" class="row g-3">
        <div class="col-md-6">
            <label for="producto" class="form-label">Producto:</label>
            <select name="producto_id" id="producto" class="form-select">
                <?php
                $productos = mysqli_query($conn, "SELECT id_producto, Nombre, Precio FROM Productos ORDER BY Nombre");
                while ($producto = mysqli_fetch_assoc($productos)) {
                    echo '<option value="'.$producto['id_producto'].'">'.$producto['Nombre'].' - $'.number_format($producto['Precio'], 2).'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="1">
        </div>
        <div class="col-md-2">
            <button type="submit" name="agregar" class="btn btn-primary mt-4"><i class="fas fa-plus icon"></i> Agregar</button>
        </div>
    </form>
    <h2><i class="fas fa-shopping-cart icon"></i> Carrito</h2>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['carrito'] as $item) {
                echo "<tr>";
                echo "<td>".$item['nombre']."</td>";
                echo "<td>".$item['cantidad']."</td>";
                echo "<td>$".number_format($item['precio'], 2)."</td>";
                echo "<td>$".number_format($item['subtotal'], 2)."</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
    <h3 class="text-end">Total: <span class="badge bg-secondary">$<?php echo number_format($total, 2); ?></span></h3>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button id="confirmar-venta" class="btn btn-success"><i class="fas fa-check icon"></i> Confirmar Venta</button>
    </div>
    <div id="venta-result" class="alert alert-success mt-3"></div>
</div>

<script>
$(document).ready(function() {
    $('#venta-form').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: 'realizar_venta.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    alert(response.message); // Notificar al usuario
                    location.reload(); // Recargar la página para actualizar el carrito
                }
            },
            error: function() {
                alert('Error al agregar el producto');
            }
        });
    });

    $('#confirmar-venta').click(function() {
        $.ajax({
            url: 'procesar_venta.php',
            type: 'POST',
            data: {},
            success: function(response) {
                $('#venta-result').text('Venta realizada con éxito').show();
                setTimeout(function() {
                    $('#venta-result').fadeOut();
                }, 5000);
                // Limpiar el carrito
            },
            error: function() {
                $('#venta-result').addClass('alert-danger').text('Error al realizar la venta').show();
            }
        });
    });
});
</script>
</body>
</html>
