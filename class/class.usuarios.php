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

    public function getUsersToView(){
        $sql = "SELECT 
        u.USER_ID as id_cliente,
        CONCAT(u.nombre, ' ', u.apellido_p, ' ', u.apellido_m) AS NOMBRE_COMPLETO,
        (SELECT COUNT(*) FROM mascota m WHERE m.id_cliente = u.USER_ID) AS No_MASCOTAS,
        CONCAT(medic.nombre, ' ', medic.apellido_p, ' ', medic.apellido_m) AS MEDICO_CABECERA,
        u.medico_cabecera,
        u.tipo
        FROM users u
        INNER JOIN users medic ON u.medico_cabecera = medic.USER_ID
        ORDER BY u.USER_ID;";

        return $this->db->query($sql)->fetchAll();
    }
    
    public function getMedics()
    {
        $sql = "SELECT CONCAT(u.nombre, ' ', u.apellido_p, ' ', u.apellido_m) AS NOMBRE_COMPLETO, u.USER_ID FROM users u WHERE tipo = 2";

        return $this->db->query($sql)->fetchAll();
    }

    public function selectMedic($Medico_ID)
    {
        $Usuarios = $this->getMedics();
        foreach ($Usuarios as $Sql):
            $Medic_ID = $Sql['USER_ID'];
            $Medic_Name = $Sql['NOMBRE_COMPLETO'];
            if ($Medico_ID == $Medic_ID){
                $Selected = "selected";
            }else{
                $Selected = " ";
            }
            
            echo "<option $Selected value = '$Medic_ID'>$Medic_Name</option>";
        endforeach;
    }

    public function selectProfile($Profile){
        $Selected1 = "";
        $Selected2 = "";
        $Selected3 = "";
        if($Profile == 3) $Selected1 = "selected";
        if($Profile == 1) $Selected2 = "selected";
        if($Profile == 2) $Selected3 = "selected";
        echo "<option $Selected1 value = '3'>Administrador</option>";
        echo "<option $Selected2 value = '1'>Cliente</option>";
        echo "<option $Selected3 value = '2'>Medico</option>";
    }

    public function updateMedic($Medic_ID, $Profile ,$User_ID)
    {
        $Sql = "UPDATE users SET medico_cabecera = '$Medic_ID', tipo = '$Profile' WHERE USER_ID = '$User_ID'";
        // echo $Sql;
        return $this->db->query($Sql);
    }
}

?>