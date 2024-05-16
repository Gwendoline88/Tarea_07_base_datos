<?php
include ("db.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "SELECT * FROM Productos WHERE idProducto=$id";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_array($result);
        $producto=$row['producto'];
        $cantidad=$row['cantidad'];
        $precio=$row['precio'];
    }
    if(isset($_POST['edit'])){
        /*echo 'Dato actualizado';*/
        $id = $_GET['id'];
        $producto=$_POST['producto'];
        $cantidad=$_POST['cantidad'];
        $precio=$_POST['precio'];
        /*
        echo $producto;
        echo $cantidad;
        echo $precio;
        echo $id;
        */
        $query = "UPDATE Productos SET producto='$producto', cantidad=$cantidad, precio=$precio WHERE idProducto=$id";
        mysqli_query($conn, $query);

        $_SESSION['message']='Producto Modificado';
        $_SESSION['message_type']='primary';
        header("Location: index.php");
    }
}
?>
<?php include("includes/header.php") ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="producto" value="<?php echo $producto; ?>"class="form-control" placeholder="Editar Producto">
                        </div>
                        <div class="form-group">
                            <input type="text" name="cantidad" value="<?php echo $cantidad; ?>"class="form-control" placeholder="Editar cantidad">
                        </div>
                        <div class="form-group">
                            <input type="text" name="precio" value="<?php echo $precio; ?>"class="form-control" placeholder="Editar Precio">
                        </div>
                        <button class="btn btn-success" name="edit">
                            Editar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php") ?>
