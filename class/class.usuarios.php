<?php 

include_once 'class.database.php';

class users{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addUsers($Array){
        $nombre_cliente = $_POST['nombre_cliente'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $fecha_nac = $_POST['fecha_nac'];
        $correo_electronico = $_POST['correo_electronico'];
        $password = md5($_POST['password']);
        $numero_de_telefono = $_POST['numero_de_telefono'];
        $calle = $_POST['calle'];
        $numero_domicilio = $_POST['numero_domicilio'];
        $colonia = $_POST['colonia'];
        $codigo_postal = $_POST['codigo_postal'];
        $metodo_de_pago  = $_POST['metodo_de_pago'];

        $Insert = "INSERT INTO users
        (nombre, apellido_p, apellido_m, fecha_nac, correo_electronico, password, numero_de_telefono, calle, numero_domicilio, colonia, codigo_postal, metodo_de_pago, activo, tipo) 
        VALUES 
        ('$nombre_cliente','$apellido_p','$apellido_m','$fecha_nac','$correo_electronico',
        '$password','$numero_de_telefono','$calle', '$numero_domicilio', '$colonia','$codigo_postal','$metodo_de_pago','1','1')";
        // echo $Insert;
        return $this->db->query($Insert);
    }

    public function getUserToLogin($correo_electronico, $password){
        
        $sql = "SELECT * FROM users WHERE activo = 1 AND correo_electronico = '$correo_electronico' AND password = '$password';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getUser($id_user){
        $sql = "SELECT * FROM users WHERE activo = 1 AND USER_ID = '$id_user';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users WHERE activo = 1;";
        
        return $this->db->query($sql)->fetchAll();

    }
    
}

?>