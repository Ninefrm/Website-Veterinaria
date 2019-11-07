<?php session_start();

if (isset($_SESSION['correo'])){
    header('Location: Index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $correo_electronico = $_POST['correo'];
    $password = $_POST['password'];
    $password = md5($password);
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
    $sql = "SELECT * FROM administrador WHERE correo_electronico = :correo_electronico AND password= :password AND activo= '1'";
    $sql_cliente = "SELECT * FROM cliente WHERE correo_electronico = :correo_electronico AND password= :password AND activo= '1'";

    $statement = $conn -> prepare($sql);
    $statement ->execute(array(':correo_electronico'=> $correo_electronico,':password'=> $password));
    $resultado = $statement->fetch();

    $statement_cliente = $conn -> prepare($sql_cliente);
    $statement_cliente ->execute(array(':correo_electronico'=> $correo_electronico,':password'=> $password));
    $resultado_cliente = $statement_cliente->fetch();

    if($resultado){
        $all = $conn->prepare("SELECT nombre FROM administrador WHERE correo_electronico =:correo_electronico");
        $all ->execute(array(':correo_electronico'=>$correo_electronico));
        $nombre = $all->fetchColumn();
        $all = $conn->prepare("SELECT id_administrador FROM administrador WHERE correo_electronico =:correo_electronico");
        $all ->execute(array(':correo_electronico'=>$correo_electronico));
        $id = $all->fetchColumn();

        $_SESSION['correo'] = $correo_electronico;
        $_SESSION['password'] = $password;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['id'] = $id;
        $tipo = "Administrador";
        $_SESSION['tipo'] = $tipo;
        header('Location: Index.php');
    }
    elseif ($resultado_cliente){
        $all = $conn->prepare("SELECT nombre FROM cliente WHERE correo_electronico =:correo_electronico");
        $all ->execute(array(':correo_electronico'=>$correo_electronico));
        $nombre = $all->fetchColumn();
        $all = $conn->prepare("SELECT id_cliente FROM cliente WHERE correo_electronico =:correo_electronico");
        $all ->execute(array(':correo_electronico'=>$correo_electronico));
        $id = $all->fetchColumn();

        $_SESSION['correo_electronico'] = $correo_electronico;
        $_SESSION['password'] = $password;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['id'] = $id;
        $tipo = "Cliente";
        $_SESSION['tipo'] = $tipo;
        header('Location: Index.php');
    }




//    if($resultado !==false) {
//        $_SESSION['correo'] = $correo;
//        $_SESSION['password'] = $password;
//        $_SESSION['nombre'] = $nombre;
//        $_SESSION['tipo'] = $tipo;
//        header('Location: index.php');
//    }

    else {
        echo $correo_electronico;
        echo $password;
        $errores .= 'Datos invalidos';
    }
}
require 'VisualLogin.php';
?>
