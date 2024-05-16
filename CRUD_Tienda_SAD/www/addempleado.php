<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $fechaContratacion = $_POST['fechaContratacion'];

    // Llamar al procedimiento almacenado
    $stmt = mysqli_prepare($conn, "CALL Addempleado(?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $telefono, $correo, $direccion, $fechaContratacion);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Empleado agregado con éxito'); window.location.href='empleado.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el empleado');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado - Abarrotes Lupita</title>
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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Agregar Nuevo Empleado</h1>
    <form action="addempleado.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="fechaContratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fechaContratacion" name="fechaContratacion" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Empleado</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kanmXOUFw5jEw4meWkQH5hq8i5I7onuTBQIAXoV3uIgXPm/dh4T9qfM+06bx4u0P" crossorigin="anonymous"></script>
</body>
</html>