<?php include 'Plantilla/Header.php'; ?>
<?php
$id_producto = $_POST['id_producto'];
//Servidor
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "ninefrmx_veterinaria";

$sql = "mysql:host=$servername;dbname=$mydb;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
//
try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$Productos = $conn -> prepare("
	SELECT * FROM producto WHERE id_producto = $id_producto");
//Producto
$Productos ->execute();
$Productos = $Productos ->fetchAll();
?>
<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue">
                <span class="card-title" align='center'>EDITAR PRODUCTO</span>
            </div>
        </div>
    </div>
    <form action="ActualizarProducto.php" method="post" name="mainform" enctype="multipart/form-data">
        <?php
        foreach ($Productos as $VProductos):
        ?>
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th>Nombre del producto:</th>
                <td><input name="nombre_producto" type="text" value="<?php echo $VProductos['nombre']?>"></td>
            </tr>
            <tr>
                <th>Codigo del producto:</th>
                <td><input name="codigo" type="text" value="<?php echo $VProductos['codigo']?>"></td>
            </tr>
            <tr>
                <th>Descripción del producto:</th>
                <td><input name="descripcion" type="text" value="<?php echo $VProductos['descripcion']?>"></td>
            </tr>
            <tr>
                <th>Costo del producto:</th>
                <td><input name="costo" type="number" value="<?php echo $VProductos['costo']?>"></td>
            </tr>
            <tr>
                <th>Cantidad en almacen:</th>
                <td><input name="stock" type="text" value="<?php echo $VProductos['stock']?>"></td>
            </tr>
            <tr>
                <th>Imagen del producto:</th>
                <td><input hidden name="imagen" type="text" value="<?php echo $VProductos['imagen']?>"></td>
                <td><input hidden name="id_producto" type="text" value="<?php echo $id_producto?>"></td>
                <td><input name="attachment" type="file"></td>
            </tr>
            <tr>
                <?php endforeach; ?>
                <td colspan="2" style="text-align:center;"><input type="submit" name="Submit" value="Send"><input type="reset" name="Reset" value="Reset"></td>
            </tr>
        </table>
    </form>

</div>
<?php include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>