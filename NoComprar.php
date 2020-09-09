<?php include 'Plantilla/Header.php'; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "ninefrmx_veterinaria";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$id_usr = $_SESSION['id'];
$id = $_GET['id'];

$update = $conn->prepare("UPDATE carro SET activo = '0' WHERE id_cliente = $id_usr AND id_servicio = $id");
$update->execute();
//require 'Index.php';
?>
<script>
    window.location.replace("Pago.php");
</script>