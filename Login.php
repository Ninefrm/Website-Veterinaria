<?php session_start();

include_once 'class/class.usuarios.php';

if (isset($_SESSION['correo'])){
    header('Location: Index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $correo_electronico = $_POST['correo'];
    $password = $_POST['password'];
    $password = md5($password);
    // $contraseña = hash('sha512', $contraseña);
    $errores ='';

    $usuario = new users();

    $resultado = $usuario->getUserToLogin($correo_electronico, $password);
    print_r($resultado);

    if($resultado){
        $_SESSION['correo'] = $resultado[0]['correo_electronico'];
        $_SESSION['password'] = $resultado[0]['password'];
        $_SESSION['nombre'] = $resultado[0]['nombre'];
        $_SESSION['user_id'] = $resultado[0]['USER_ID'];
        if ($resultado[0]['tipo'] == 1) $tipo = "Cliente";
        if ($resultado[0]['tipo'] == 3) $tipo = "Administrador";
        $_SESSION['tipo'] = $resultado[0]['tipo'];
        $_SESSION['perfil'] = $tipo;
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
