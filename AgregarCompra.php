<?php
//Servidor
$servername = "localhost";
$username = "ninefrmx_root";
$password = "Samuel20";
$mydb = "ninefrmx_veterinaria";

$sql = "mysql:host=$servername;dbname=$mydb;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
//
session_start();
//POST
if(empty($_POST['id_producto'])){
    $id_producto = '0';
}else{
    $id_producto = $_POST['id_producto'];
}
if(empty($_POST['id_servicio'])){
    $id_servicio = '0';
}else{
    $id_servicio = $_POST['id_servicio'];
}

echo "<p>P: $id_producto </p>";
echo "<p>S: $id_servicio</p>";
echo "<p></p>";
try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
    echo "Connected successfully";
} catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
}
//
$id_usr = $_SESSION['id'];
$my_Insert_Statement = $my_Db_Connection->prepare(
    "INSERT INTO carro VALUES
(null,$id_usr,:id_producto, :id_servicio,'1')");

$my_Insert_Statement ->execute(array(
    ':id_producto'=> $id_producto,
    ':id_servicio'=> $id_servicio
));

?>
<script>
    window.location.replace("Pago.php");
</script>