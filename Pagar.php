
<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $costo = $_POST['total'];

    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero_domicilio'];
    $colonia = $_POST['colonia'];
    $codigo_postal = $_POST['codigo_postal'];
    $metodo_de_envio = $_POST['envio'];

    $precio_total = $_POST['total'];

    $pago = $_POST['pago'];

    $id_cliente = $_POST['id_cliente'];



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


    $carrito = $conn -> prepare(
        "SELECT * FROM carro WHERE activo = 1 AND id_cliente = $id_cliente");
    //CARRITO
    $carrito ->execute();
    $carrito = $carrito ->fetchAll();
    //Administrador
    $cliente = $conn -> prepare(
        "SELECT * FROM cliente WHERE id_cliente = $id_cliente AND activo= '1'");
    $cliente ->execute();
    $cliente = $cliente ->fetchAll();
    $cantidad = count($carrito);

    foreach ($carrito as $SQLCarrito):
        $id_producto = $SQLCarrito['id_producto'];
        $id_servicio = $SQLCarrito['id_servicio'];

        if(empty($id_producto)){
            $id_producto = '0';
        }
        if(empty($id_servicio)){
            $id_servicio = '0';
        }

        echo date_default_timezone_set('Australia/Melbourne');
        $date = substr(date('m/d/Y h:i:s a', time()), -6,4);



        $id_cliente1 = substr($id_cliente,0,2);
        $id_servicio1 = substr($id_servicio,0,2);
        $id_producto1 = substr($id_producto,0,2);
        $date1 = substr($date,0,2);

        $guia_de_envio = $metodo_de_envio . $id_cliente1 . $id_servicio1 . $id_producto1 . $date;

        echo $guia_de_envio;

        $my_Insert_Statement = $conn->prepare(
            "INSERT INTO venta VALUES
(null,:id_cliente, :id_producto, :costo, :numero_de_telefono, :calle, :numero_domicilio, :colonia, :codigo_postal, :metodo_de_pago, :guia_de_envio,
 '1')");
        $id_tienda = '1';
        $cantidad_producto = '1';
        $cantidad_servicio = '1';

        $my_Insert_Statement ->execute(array(
            ':id_cliente'=> $id_cliente,
            ':id_producto'=>$id_producto,
            ':costo'=>$costo,
            ':numero_de_telefono'=>$telefono,
            ':calle'=>$calle,
            ':numero_domicilio'=>$numero,
            ':colonia'=>$colonia,
            ':codigo_postal'=>$codigo_postal,
            ':metodo_de_pago'=>$pago,
            ':guia_de_envio'=>$guia_de_envio
        ));
    endforeach;
    $update = $conn->prepare("UPDATE carro SET activo = '0' WHERE id_cliente = $id_cliente");
    $update->execute();

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
