<?php 

include_once 'class.database.php';

class agenda{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addCita($Array){
        
        if(isset($_POST['mascota'])){
            $mascota_id = $_POST['mascota'];
        }else{
            $mascota_id = 0;
        }
        if(isset($_POST['id_medico'])){
            $id_medico = $_POST['id_medico'];
        }else{
            $id_medico = 0;
        }
        if(isset($_POST['fecha_cita'])){
            $cita = $_POST['fecha_cita'];
        }else{
            $cita = 0;
        }
        if(isset($_POST['pago'])){
            $pago = $_POST['pago'];
        }else{
            $pago = 0;
        }
        if(isset($_POST['total'])){
            $total = $_POST['total'];
        }else{
            $total = 0;
        }
        if(isset($_POST['receta'])){
            $receta = $_POST['receta'];
        }else{
            $receta = "";
        }
        if(isset($_POST['id_servicio'])){
            $id_servicio = $_POST['id_servicio'];
        }else{
            $id_servicio = 0;
        }
        
        $Insert = "INSERT INTO historial_clinico
        (id_servicio, mascota_id, id_medico, cita, pago, total, receta) 
        VALUES 
        ('$id_servicio', '$mascota_id','$id_medico','$cita','$pago','$total','$receta')";

        return $this->db->query($Insert);
        

    }

    public function getCitaByPetID($ID)
    {
        $sql = "SELECT * FROM historial_clinico WHERE activo = 1 AND mascota_id = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getCitaByMedicoID($ID)
    {
        $sql = "SELECT * FROM historial_clinico WHERE activo = 1 AND id_medico = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function updateCita($Array){
        $Receta = $_POST['receta'];
        $Cita_id = $_POST['cita_id'];
        $Status = $_POST['status'];
        $Update = "UPDATE historial_clinico 
        SET
        receta='$Receta',status='$Status'
        WHERE 
        historial_clinico_id = '$Cita_id'";
        return $this->db->query($Update);
    }

    
}

?>