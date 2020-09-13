<?php 

include_once 'class.database.php';

class products{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addProduct(){

    }

    public function getProductoByID($ID)
    {
        $sql = "SELECT * FROM producto WHERE activo = 1 AND id_producto = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getNameByID($ID){
        $sql = "SELECT nombre  FROM producto WHERE activo = 1 AND id_producto = '$ID';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getProductByVendidos(){
        
        $sql = "SELECT * FROM producto WHERE activo = 1 ORDER BY vendidos desc;";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function printInIndex(){
        $Products = $this->getProductByVendidos();
        ECHO "
        <div class=\"col s12 m6\">
            <div class=\"card blue-grey darken-1\">
                <div class=\"card-content white-text\">
                    <span class=\"card-title\" align='center'>PRODUCTOS</span>
                </div>
            </div>
        </div>
        <article>
            <div class=\"carousel part1\">";
            foreach ($Products as $Sql):
                $id = $Sql['id_producto'];
                $image = $Sql['imagen'];
                $nombre = $Sql['nombre'];
                $precio = $Sql['costo'];
                $descripcion = $Sql['descripcion'];
                ECHO "<a class='carousel-item' href='Producto_view.php?id=$id'><img src='upload/productos/$image'><p>$nombre<br>Precio: $$precio
                    <br>Descripcion: $descripcion</p></a>";
            endforeach;
            ECHO "
            </div>
        </article> 
        ";
    }
    

    
}

?>