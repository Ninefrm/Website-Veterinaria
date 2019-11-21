<?php include "Plantilla/Header.php" ?>

<?php
//Servidor
$servername = "localhost";
$username = "ninefrmx_root";
$password = "Samuel20";
$mydb = "ninefrmx_veterinaria";

$sql = "mysql:host=$servername;dbname=$mydb;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
//

//POST
if(!empty($_POST['busqueda'])){
    $busqueda = $_POST['busqueda'];
}else{
    $busqueda = '';
}

try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
//    echo "Connected successfully";
} catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
}
//
$my_Insert_Statement = $my_Db_Connection->prepare(
    "SELECT * FROM producto WHERE activo = '1'");

$my_Insert_Statement ->execute();

//echo $busqueda;
?>
<?php
Echo "<form action=\"Buscar.php\" method=\"post\" id=\"mainform\">
<div class=\"input-field inline l3\">
    <input name=\"busqueda\" id=\"busqueda\" type=\"text\" class=\"validate\" value=\"$busqueda\">
    <label for=\"busqueda\">Buscar</label>
</div> 
    <form action=\"Buscar.php\" method=\"post\" id=\"mainform\">
        <button class=\"btn - floating btn - large waves - effect waves - light blue\" type=\"submit\" form=\"mainform\"><i class=\"material - icons\">search</i></button>
    </form>
    </form>";
?>
<table class="responsive-table">
    <thead>
    <tr>
        <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
        <th>CÓDIGO</th>
        <th>PRECIO</th>
        <th colspan="3">ACCIONES</th>

    </tr>
    </thead>
    <?php
    $productos = $conn -> prepare("
	        SELECT * FROM producto WHERE activo = '1' AND MATCH (nombre, descripcion, codigo) AGAINST ('$busqueda')");
    //Libro
    $productos ->execute();
    $productos = $productos ->fetchAll();
    foreach ($productos as $SQLproductos):
        ?>
        <tr>
            <?php $str = strtoupper($SQLproductos['nombre']); echo "<td>". $str ."</td>"; ?>
            <?php echo "<td>". $SQLproductos['codigo'] ."</td>"; ?>
            <?php echo "<td> $". $SQLproductos['costo'] ."</td>"; ?>
            <?php echo "<td class='centrar'>"."<a href='VerProducto.php?id=".$SQLproductos['id_producto']."' class='large material-icons'>visibility</a>". "</td>"; ?>
<!--            --><?php //echo "<td class='centrar'>"."<a href='EliminarAdministrador.php?id=".$SQLproductos['id_producto']."' class='large material-icons'>delete_forever</a>". "</td>"; ?>
        </tr>
    <?php endforeach; ?>
<!--    SERVICIOS-->

    <?php
    $servicios = $conn -> prepare("
	        SELECT * FROM servicio WHERE activo = '1' AND MATCH (nombre, descripcion, codigo) AGAINST ('$busqueda')");
    //Libro
    $servicios ->execute();
    $servicios = $servicios ->fetchAll();
    foreach ($servicios as $SQLservicios):
        ?>
        <tr>
            <?php $str = strtoupper($SQLservicios['nombre']); echo "<td>". $str ."</td>"; ?>
            <?php echo "<td>". $SQLservicios['codigo'] ."</td>"; ?>
            <?php echo "<td> $". $SQLservicios['costo'] ."</td>"; ?>
            <?php echo "<td class='centrar'>"."<a href='VerServicio.php?id=".$SQLservicios['id_servicio']."' class='large material-icons'>visibility</a>". "</td>"; ?>
<!--            --><?php //echo "<td class='centrar'>"."<a href='EliminarAdministrador.php?id=".$SQLservicios['id_servicio']."' class='large material-icons'>delete_forever</a>". "</td>"; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
<?php include 'Plantilla/PieDePagina.php'; ?>
</html>