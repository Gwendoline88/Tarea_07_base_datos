<?php
include ('db.php');
    if(isset($_POST['guardar'])){
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        /*$query = "INSERT INTO Productos(producto,cantidad,precio)VALUES('$producto','$cantidad','$precio')";*/
        $query ="CALL sp_insertarProductos('$producto',$cantidad,$precio)";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("No se inserto el registro");
        }

        $_SESSION['message']='Producto Guardado con Exito';
        $_SESSION['message_type']='success';
        header("Location: index.php");
    }
?>