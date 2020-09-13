<?php 

include_once 'class.database.php';

class pet{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addPet($Array){

        if(isset($_POST['id_cliente'])){
            $id_cliente = $_POST['id_cliente'];
        }else{
            $id_cliente = 0;
        }
        if(isset($_POST['nombre_mascota'])){
            $nombre_mascota = $_POST['nombre_mascota'];
        }else{
            $nombre_mascota = 0;
        }
        if(isset($_POST['fecha_nac'])){
            $fecha_nac = $_POST['fecha_nac'];
        }else{
            $fecha_nac = 0;
        }
        if(isset($_POST['fecha_vac'])){
            $fecha_vac = $_POST['fecha_vac'];
        }else{
            $fecha_vac = 0;
        }
        if(isset($_POST['raza'])){
            $raza = $_POST['raza'];
        }else{
            $raza = "";
        }
        if(isset($_POST['color'])){
            $color = $_POST['color'];
        }else{
            $color = 0;
        }
        if(isset($_POST['peso'])){
            $peso = $_POST['peso'];
        }else{
            $peso = 0;
        }
        if(isset($_POST['categoria'])){
            $categoria = "\\" . $_POST['categoria'];
        }else{
            $categoria = 0;
        }

        $Insert = "INSERT INTO mascota
        ( id_cliente, nombre, fecha_nac, fecha_vac, categoria, raza, color, peso, activo) 
        VALUES 
        ('$id_cliente','$nombre_mascota','$fecha_nac','$fecha_vac','$categoria','$raza','$color','$peso','1');";

        return $this->db->query($Insert);
    }

    public function getPetByUserID($ID)
    {
        $sql = "SELECT * FROM mascota WHERE activo = 1 AND id_cliente = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getPetByID($ID, $id_mascota)
    {
        $sql = "SELECT * FROM mascota WHERE activo = 1 AND id_cliente = '$ID' AND id_mascota = '$id_mascota';";
        
        return $this->db->query($sql)->fetchAll();
    }

    
}

?>