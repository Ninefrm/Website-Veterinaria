<?php 

include_once 'class.database.php';

class products{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addProduct(){
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
        }else{
            $Mensaje = "Faltó el nombre del producto";
            return $Mensaje;
        }
        if(isset($_POST['descripcion'])){
            $descripcion = $_POST['descripcion'];
        }else{
            $Mensaje = "Faltó la descripción del producto";
            return $Mensaje;
        }
        if(isset($_POST['costo'])){
            $costo = $_POST['costo'];
        }else{
            $Mensaje = "Faltó el costo del producto";
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
            $Mensaje = "Faltó el codigo del producto";
            return $Mensaje;
        }
        if(isset($_FILES['ImageToUpload']['name'])){
            $ImageToUpload = $_FILES['ImageToUpload']['name'];
        }else{
            $ImageToUpload = 0;
        }

        $Insert = "INSERT INTO 
        producto
        (nombre, codigo, descripcion, costo, imagen, stock, activo, vendidos) 
        VALUES 
        ('$nombre','$codigo','$descripcion','$costo','$ImageToUpload','$stock','1','0');";

        return $this->db->query($Insert);
    }

    public function updateProduct(){

        $id_producto = $_POST['product_id'];

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
        }else{
            $ImageToUpload = $_POST['imagen'];
        }
        if($ImageToUpload == ""){
            $ImageToUpload = $_POST['imagen'];    
        }

        $Insert = "UPDATE 
        producto 
        SET 
        nombre='$nombre',
        codigo='$codigo',
        descripcion='$descripcion',
        costo='$costo',
        imagen='$ImageToUpload',
        stock='$stock'
        WHERE 
        id_producto = '$id_producto';";

        return $this->db->query($Insert);
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
            <div class=\"card\" id='section-header'>
                <div class=\"card-content\">
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
                ECHO "<a class='carousel-item' href='Producto_view.php?id=$id'><img src='upload/productos/$image'><p id='text-standarized'>$nombre<br>Precio: $$precio
                    <br>Descripcion: $descripcion</p></a>";
            endforeach;
            ECHO "
            </div>
        </article> 
        ";
    }
    

    
}

?>