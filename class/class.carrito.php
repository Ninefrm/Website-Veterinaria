<?php 

include_once 'class.database.php';

class carrito{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addCarrito($Array){
        
        $id_cliente = $_POST['id_cliente'];
        
        if(isset($_POST['id_producto'])){
            $id_producto = $_POST['id_producto'];
            $productoAgregado = $this->getCarritoByProduct($id_cliente, $id_producto);
        }else{
            $id_producto = 0;
            $productoAgregado = 0;
        }
        if(isset($_POST['id_servicio'])){
            $id_servicio = $_POST['id_servicio'];
            $servicioAgregado = $this->getCarritoByService($id_cliente, $id_servicio);
        }else{
            $id_servicio = 0;
            $servicioAgregado = 0;
        }
        if(isset($_POST['cantidad'])){
            $cantidad = $_POST['cantidad'];
        }else{
            $cantidad = 1;
        }
        
        if(!$productoAgregado AND !$servicioAgregado){
            $Insert = "INSERT INTO carro
            (id_cliente, id_producto, id_servicio, cantidad, activo) 
            VALUES 
            ('$id_cliente','$id_producto','$id_servicio','$cantidad','1');";
            // echo $Insert;
            $this->db->query($Insert);
            return "I";
        }
        if($productoAgregado){
            // echo "Agregado P ";
            $this->updateCarritoByProduct($id_cliente, $id_producto);
            return "PA";
        }
        if($servicioAgregado){
            // echo "Agregado S ";
            $this->updateCarritoByService($id_cliente, $id_servicio);
            return "SA";
        }
        
    }

    public function getCantidad($id){
        $sql = "SELECT * FROM carro WHERE activo = 1 AND id_cliente = '$id';";
        
        return $this->db->query($sql)->numRows();
    }

    public function getCarrito($id){
        
        $sql = "SELECT * FROM carro WHERE activo = 1 AND id_cliente = '$id';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function getCarritoByProduct($id, $id_producto){
        
        $sql = "SELECT * FROM carro WHERE activo = 1 AND id_cliente = '$id' AND id_producto = '$id_producto';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function updateCarritoByProduct($id, $id_producto){
        
        $sql = "UPDATE carro SET cantidad=cantidad+1 WHERE activo = 1 AND id_cliente = '$id' AND id_producto = '$id_producto';";
        
        return $this->db->query($sql);
    }

    public function getCarritoByService($id, $id_servicio){
        
        $sql = "SELECT * FROM carro WHERE activo = 1 AND id_cliente = '$id' AND id_servicio = '$id_servicio';";
        
        return $this->db->query($sql)->fetchAll();
    }

    public function updateCarritoByService($id, $id_servicio){
        
        $sql = "UPDATE carro SET cantidad=cantidad+1 WHERE activo = 1 AND id_cliente = '$id' AND id_servicio = '$id_servicio';";
        
        return $this->db->query($sql);
    }

    public function LimpiarCarrito($id){
        $sql = "UPDATE carro SET activo = 0 WHERE activo = 1 AND id_cliente = '$id';";
        
        return $this->db->query($sql);
    }
    
}

?>