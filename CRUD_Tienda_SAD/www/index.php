<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Lupita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-r7VaH8bRAK3ZRd6jh5OjzxHMqF1IMDQVgAiF3NO11Vfy6AwERzPxQEtfczAV+4jX" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #B3E5FC; /* Color azul pastel */
            font-family: 'Arial', sans-serif; /* Fuente general para la página */
            height: 100vh; /* Altura completa de la ventana de visualización */
            display: flex;
            justify-content: center;
            align-items: center; /* Centrado vertical y horizontal */
            margin: 0; /* Remover márgenes predeterminados */
        }
        .container {
            text-align: center;
        }
        .btn-option {
            margin: 10px;
            font-size: 1.5rem; /* Tamaño del texto en los botones */
            width: 200px; /* Ancho de los botones */
        }
        h1 {
            color: #0D6EFD; /* Color azul para el título */
            margin-bottom: 30px; /* Espacio debajo del título */
        }
        /* Estilo para el hover de los botones */
        .btn-outline-primary:hover {
            background-color: #0D6EFD; /* Color de fondo cuando se pasa el mouse */
            color: white; /* Color de texto cuando se pasa el mouse */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Abarrotes Lupita</h1>
    <div class="row justify-content-center">
        <div class="col-auto">
            <a href="productos.php" class="btn btn-outline-primary btn-lg btn-option" role="button">Productos</a>
        </div>
        <div class="col-auto">
            <a href="empleado.php" class="btn btn-outline-primary btn-lg btn-option" role="button">Empleados</a>
        </div>
        <div class="col-auto">
            <a href="ventas.php" class="btn btn-outline-primary btn-lg btn-option" role="button">Ventas</a>
        </div>
        <div class="col-auto">
            <a href="proveedores.php" class="btn btn-outline-primary btn-lg btn-option" role="button">Proveedores</a>
        </div>
        <div class="col-auto">
    <a href="clientes.php" class="btn btn-outline-secondary btn-lg btn-option" role="button">Clientes</a>
</div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-r7VaH8bRAK3ZRd6jh5OjzxHMqF1IMDQVgAiF3NO11Vfy6AwERzPxQEtfczAV+4jX" crossorigin="anonymous"></script>
</body>
</html>
