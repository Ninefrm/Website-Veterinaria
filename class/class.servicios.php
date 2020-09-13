<?php 

include_once 'class.database.php';

class services{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addServices(){

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