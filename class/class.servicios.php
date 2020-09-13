<?php 

include_once 'class.database.php';

class services{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addService(){
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
        }else{
            $Mensaje = "Faltó el nombre del servicio";
            return $Mensaje;
        }
        if(isset($_POST['descripcion'])){
            $descripcion = $_POST['descripcion'];
        }else{
            $Mensaje = "Faltó la descripción del servicio";
            return $Mensaje;
        }
        if(isset($_POST['costo'])){
            $costo = $_POST['costo'];
        }else{
            $Mensaje = "Faltó el costo del servicio";
            return $Mensaje;
        }
        if(isset($_POST['stock'])){
            $stock = $_POST['stock'];
        }else{
            $stock = 0;
        }
        if(isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
        }else{
            $Mensaje = "Faltó el codigo del servicio";
            return $Mensaje;
        }
        if(isset($_FILES['ImageToUpload']['name'])){
            $ImageToUpload = $_FILES['ImageToUpload']['name'];
        }else{
            $ImageToUpload = 0;
        }

        $Insert = "INSERT INTO 
        servicio
        (nombre, codigo, descripcion, costo, imagen, stock, activo, vendidos) 
        VALUES 
        ('$nombre','$codigo','$descripcion','$costo','$ImageToUpload','$stock','1','0');";

        return $this->db->query($Insert);
    }

    public function updateService(){

        $id_servicio = $_POST['servicio_id'];

        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
        }else{
            $nombre = 0;
        }
        if(isset($_POST['descripcion'])){
            $descripcion = $_POST['descripcion'];
        }else{
            $descripcion = 0;
        }
        if(isset($_POST['costo'])){
            $costo = $_POST['costo'];
        }else{
            $costo = 0;
        }
        if(isset($_POST['stock'])){
            $stock = $_POST['stock'];
        }else{
            $stock = 0;
        }
        if(isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
        }else{
            $codigo = 0;
        }
        if(isset($_FILES['ImageToUpload']['name'])){
            $ImageToUpload = $_FILES['ImageToUpload']['name'];
            echo $ImageToUpload;
        }else{
            $ImageToUpload = $_POST['imagen'];
        }

        if($ImageToUpload == ""){
            $ImageToUpload = $_POST['imagen'];    
        }

        $Insert = "UPDATE 
        servicio 
        SET 
        nombre='$nombre',
        codigo='$codigo',
        descripcion='$descripcion',
        costo='$costo',
        imagen='$ImageToUpload',
        stock='$stock'
        WHERE 
        id_servicio = '$id_servicio';";

        return $this->db->query($Insert);
    }

    public function getServicioByID($ID)
    {
        $sql = "SELECT * FROM servicio WHERE activo = 1 AND id_servicio = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getServicesByVendidos(){
        
        $sql = "SELECT * FROM servicio WHERE activo = 1 ORDER BY vendidos desc;";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getNameByID($ID){
        $sql = "SELECT nombre  FROM servicio WHERE activo = 1 AND id_servicio = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function printInIndex(){
        $Services = $this->getServicesByVendidos();
        ECHO "
        <div class=\"col s12 m6\">
            <div class=\"card blue-grey darken-1\">
                <div class=\"card-content white-text\">
                    <span class=\"card-title\" align='center'>SERVICIOS</span>
                </div>
            </div>
        </div>
        <article>
            <div class=\"carousel part1\">";
                foreach ($Services as $Sql):
                    $id = $Sql['id_servicio'];
                    $image = $Sql['imagen'];
                    $nombre = $Sql['nombre'];
                    $precio = $Sql['costo'];
                    $descripcion = $Sql['descripcion'];
                    ECHO "<a class='carousel-item' href='Servicio_view.php?id=$id'><img src='upload/servicios/$image'><p>$nombre<br>Precio: $$precio
                            <br>Descripcion: $descripcion</p></a>";
                endforeach;
        ECHO "
            </div>
        </article> 
        ";
    }

    
}

?>