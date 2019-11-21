
<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $costo = $_POST['total'];

    $numero_de_telefono = $_POST['numero_de_telefono'];
    $receta = $_POST['receta'];

    $fecha_cita = $_POST['fecha_cita'];
    $id_mascota = $_POST['id_mascota'];

    $pago = $_POST['pago'];

    $id_cliente = $_POST['id_cliente'];
    $id_servicio = $_POST['id_servicio'];
    $id_veterinario = $_POST['id_veterinario'];

    // $contraseña = hash('sha512', $contraseña);
    $errores ='';

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

    //Administrador
    $cliente = $conn -> prepare(
        "SELECT * FROM cliente WHERE id_cliente = $id_cliente AND activo= '1'");
    $cliente ->execute();
    $cliente = $cliente ->fetchAll();


//        echo date_default_timezone_set('Australia/Melbourne');
        $date = substr(date('m/d/Y h:i:s a', time()), -6,4);



        $conn->beginTransaction();


    $my_Insert_Statement = $conn->exec(
        "INSERT INTO cita (id_cita, id_tienda, id_cliente, id_mascota, id_veterinario, id_servicio, fecha_consulta, activo, receta) VALUES
(null,'1', '$id_cliente', '$id_mascota', '$id_veterinario', '$id_servicio','$fecha_cita', '1', '$receta')");


    $conn->commit();

//    echo $my_Insert_Statement;





//    $updateL = $conn->prepare("UPDATE libro SET vendidos = vendidos+1, cantidad=cantidad-1 WHERE id = $id_libro");
//    $updateL->execute();



//    if($resultado !==false) {
//        $_SESSION['correo'] = $correo;
//        $_SESSION['password'] = $password;
//        $_SESSION['nombre'] = $nombre;
//        $_SESSION['tipo'] = $tipo;
//        header('Location: index.php');
//    }

}
require 'Index.php';
?>
