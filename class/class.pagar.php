<?php 

include_once 'class.database.php';
include_once 'class.carrito.php';
include_once 'class.productos.php';

class pagar{

    protected $db;

    public function __construct(){
        $this->db = new database();
    }

    public function addPago($Array){
        
        $id_cliente = $_POST['id_cliente'];
        
        if(isset($_POST['calle'])){
            $calle = $_POST['calle'];
        }else{
            $calle = 0;
        }
        if(isset($_POST['numero_domicilio'])){
            $numero_domicilio = $_POST['numero_domicilio'];
        }else{
            $numero_domicilio = 0;
        }
        if(isset($_POST['colonia'])){
            $colonia = $_POST['colonia'];
        }else{
            $colonia = 0;
        }
        if(isset($_POST['codigo_postal'])){
            $codigo_postal = $_POST['codigo_postal'];
        }else{
            $codigo_postal = 0;
        }
        if(isset($_POST['telefono'])){
            $telefono = $_POST['telefono'];
        }else{
            $telefono = 0;
        }
        if(isset($_POST['pago'])){
            $pago = $_POST['pago'];
        }else{
            $pago = 0;
        }
        if(isset($_POST['envio'])){
            $envio = $_POST['envio'];
        }else{
            $envio = 0;
        }
        if(isset($_POST['TotalT'])){
            $TotalT = $_POST['TotalT'];
        }else{
            $TotalT = 0;
        }

        $Carrito = new carrito();
        $GetCarrito = $Carrito->getCarrito($id_cliente);

        // $Productos = new products();
        $Productos = "";
        foreach ($GetCarrito as $Sql):
            $id_producto = $Sql['id_producto'];
            $Productos = ($id_producto) .",".$Productos;
        endforeach;

        $Productos = substr($Productos,0,-1);
        
        $date = substr(date('m/d/Y h:i:s a', time()), -6,4);
        $guia_de_envio = $envio . $id_cliente . $Productos . $date;

        $Insert = "INSERT INTO venta
        (id_cliente, id_producto, costo, numero_de_telefono, calle, numero_domicilio, colonia, codigo_postal, metodo_de_pago, guia_de_envio, activo) 
        VALUES 
        ('$id_cliente','$Productos','$TotalT','$telefono','$calle','$numero_domicilio','$colonia','$codigo_postal','$pago','$guia_de_envio','1');";
        
        return $this->db->query($Insert);
        
    }

    public function getVentasByUserID($id_usr){
        $sql = "SELECT * FROM venta WHERE id_cliente = $id_usr";
        return $this->db->query($sql)->fetchAll();
    }

    public function getVentas(){
        $sql = "SELECT * FROM venta ORDER BY id_cliente";
        return $this->db->query($sql)->fetchAll();
    }
}

?>