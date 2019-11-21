<?php
//Servidor
$servername = "localhost";
$username = "ninefrmx_root";
$passwordb = "Samuel20";
$mydb = "ninefrmx_veterinaria";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $passwordb);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
//POST
$id_cliente = $_POST['id_cliente'];
$nombre_mascota = $_POST['nombre_mascota'];
$fecha_nac = $_POST['fecha_nac'];
$fecha_vac = $_POST['fecha_vac'];
$categoria  = $_POST['categoria'];
$raza = $_POST['raza'];
$color = $_POST['color'];
$peso = $_POST['peso'];
//EXISTE?
$sql_cliente = "SELECT * FROM mascota WHERE id_cliente = :id_cliente AND nombre = :nombre_mascota";

$existe = $conn -> prepare($sql_cliente);
$existe ->execute(array(':id_cliente'=> $id_cliente, ':nombre_mascota'=> $nombre_mascota));
$resultado = $existe->fetch();

if($resultado){
    echo '<script language="javascript">';
    echo 'alert("El correo ya existe en el sistema.")';
    echo '</script>';
    $existente = 1;
}else{
    $my_Insert_Statement = $conn->prepare(
        "INSERT INTO mascota VALUES
(null,:id_cliente,:nombre_mascota, :fecha_nac, :fecha_vac, :categoria,:raza,:color,:peso,DEFAULT)");

    $my_Insert_Statement ->execute(array(
        ':id_cliente'=> $id_cliente,
        ':nombre_mascota'=> $nombre_mascota,
        ':fecha_nac'=> $fecha_nac,
        ':fecha_vac'=> $fecha_vac,
        ':categoria'=> $categoria,
        ':raza'=> $raza,
        ':color'=> $color,
        ':peso'=> $peso
    ));
    $existente = 0;
}
if(!$existente){
    ECHO "
    <script>
    alert(\"AGREGADO.\");
    window.location.replace(\"VerMascotas.php\");
</script>
    ";
}else{
    ECHO "<script>
    window.location.replace(\"VerMascotas.php\");
</script>
    ";
} ?>


