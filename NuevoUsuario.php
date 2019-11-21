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
$nombre_cliente = $_POST['nombre_cliente'];
$apellido_p = $_POST['apellido_p'];
$apellido_m = $_POST['apellido_m'];
$fecha_nac = $_POST['fecha_nac'];
$correo_electronico  = $_POST['correo_electronico'];
$password = $_POST['password'];
$password = md5($password);
$numero_de_telefono = $_POST['numero_de_telefono'];
$calle = $_POST['calle'];
$numero_domicilio = $_POST['numero_domicilio'];
$colonia = $_POST['colonia'];
$codigo_postal = $_POST['codigo_postal'];
$metodo_de_pago = $_POST['metodo_de_pago'];
//EXISTE?
$sql_cliente = "SELECT * FROM cliente WHERE correo_electronico = :correo_electronico";

$existe = $conn -> prepare($sql_cliente);
$existe ->execute(array(':correo_electronico'=> $correo_electronico));
$resultado = $existe->fetch();

if($resultado){
    echo '<script language="javascript">';
    echo 'alert("El correo ya existe en el sistema.")';
    echo '</script>';
    $existente = 1;
}else{
    $my_Insert_Statement = $conn->prepare(
        "INSERT INTO cliente VALUES
(null,:nombre_cliente,:apellido_p, :apellido_m, :fecha_nac, :correo_electronico,:password,:numero_de_telefono,:calle,:numero_domicilio,:colonia,:codigo_postal,
:metodo_de_pago,DEFAULT,'Cliente')");

    $my_Insert_Statement ->execute(array(
        ':nombre_cliente'=> $nombre_cliente,
        ':apellido_p'=> $apellido_p,
        ':apellido_m'=> $apellido_m,
        ':fecha_nac'=> $fecha_nac,
        ':correo_electronico'=> $correo_electronico,
        ':password'=> $password,
        ':numero_de_telefono'=> $numero_de_telefono,
        ':calle'=> $calle,
        ':numero_domicilio'=> $numero_domicilio,
        ':colonia'=> $colonia,
        ':codigo_postal'=> $codigo_postal,
        ':metodo_de_pago'=> $metodo_de_pago
    ));
    $existente = 0;
}
if(!$existente){
    ECHO "
    <script>
    alert(\"REGISTRADO.\")
    window.location.replace(\"Login.php\");
</script>
    ";
}else{
    ECHO "<script>
    window.location.replace(\"RegistroCliente.php\");
</script>
    ";
}
?>


