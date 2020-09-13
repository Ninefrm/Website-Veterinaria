<?php
include "class/class.usuarios.php";
include "class/class.productos.php";
include "class/class.servicios.php";
include "class/class.carrito.php";
include "class/class.pagar.php";
include "class/class.agenda.php";
include "class/class.mascota.php";

//var_dump($_POST);
$action = "";
$href = "./Index.php";
print_r($_POST);
    if(isset($_POST['FormID'])){
        //    Register
        if($_POST['FormID'] == "register"){
            $register = new users();
            if($register->addUsers($_POST)){
                $action = "Registered";
                $href = "./Index.php";
            }
        }
        if($_POST['FormID'] == "carrito"){
            $carrito = new carrito();
            $Add = $carrito->addCarrito($_POST);
            if($Add == "I"){
                $action = "Se agrego a tu carrito";
                $href = "./Carrito_view.php";
            }else if($Add == "PA"){
                $action = "Se agrego una unidad mas del producto a tu carrito";
                $href = "./Carrito_view.php";
            }else if($Add == "SA"){
                $action = "Se agrego una unidad mas del servicio a tu carrito";
                $href = "./Carrito_view.php";
            }
        }
        if($_POST['FormID'] == "Pagar"){
            $Pagar = new pagar();
            $Compra = $Pagar->addPago($_POST);
            if($Compra){
                $action = "Pago acreditado";
                $href = "./Compras_view.php";
                $Carrito = new carrito();
                $Carrito->LimpiarCarrito($_POST['id_cliente']);
            }else{
                $action = "Error de compra, revisa tu carrito";
                $href = "./Carrito_view.php";
            }
        }
        if($_POST['FormID'] == "Generar_Cita"){
            $Cita = new agenda();
            $Cita = $Cita->addCita($_POST);
            if($Cita){
                $action = "Cita agendada, se le asignará automaticamente la hora.";
                $href = "./Mascota_view.php";
                // $Carrito = new carrito();
                // $Carrito->LimpiarCarrito($_POST['id_cliente']);
            }else{
                $action = "No existen horas disponibles ese día";
                $href = "./Index.php";
            }
        }
        if($_POST['FormID'] == "Add_Mascota"){
            $Mascota = new pet();
            $Mascota = $Mascota->addPet($_POST);
            if($Mascota){
                $action = "Mascota agregada.";
                $href = "./Mascota_view.php";
                // $Carrito = new carrito();
                // $Carrito->LimpiarCarrito($_POST['id_cliente']);
            }else{
                $action = "No fue posible agregar la mascota.";
                $href = "./Mascota_edit.php";
            }
        }
        if($_POST['FormID'] == "Product_edit"){
            $Producto = new products();
            if($_POST['product_id'] == 0){
                $Producto = $Producto->addProduct($_POST);
                if($Producto){
                    $dir_subida = './upload/productos/';
                    $fichero_subido = $dir_subida . basename($_FILES['ImageToUpload']['name']);

                    if (move_uploaded_file($_FILES['ImageToUpload']['tmp_name'], $fichero_subido)) {
                        $action = "Producto agregado con imagen.";
                        $href = "./Index.php";
                    } else {
                        $action = "Producto agregado sin imagen.";
                        $href = "./Index.php";
                    }
                    // print_r($_FILES);
                    

                }else{
                    $action = "No fue posible agregar el producto.";
                    $href = "./Producto_edit.php";
                }
            }else{

                $Producto = $Producto->updateProduct($_POST);
                if($Producto){
                    $dir_subida = './upload/productos/';
                    $fichero_subido = $dir_subida . basename($_FILES['ImageToUpload']['name']);

                    if (move_uploaded_file($_FILES['ImageToUpload']['tmp_name'], $fichero_subido)) {
                        $action = "Producto actualizado, se actualizó la imagen.";
                        $href = "./Producto_view.php?id=".$_POST['product_id']."";
                    } else {
                        $action = "Producto actualizado, no se actualizó la imagen.";
                        $href = "./Producto_view.php?id=".$_POST['product_id']."";
                    }
                    // print_r($_FILES);
                    
                }else{
                    $action = "No fue posible editar el producto.";
                    $href = "./Producto_view.php?id=".$_POST['product_id']."";
                }
            }
        }
    }

?>
<?php
require_once ("Plantilla/Header.php");
?>
<body class="Background_ColorPage">
<div class="row FullPage">
    <div class="col s4"></div>
    <div class="col s4 Background_ColorWhite CenterOnFullPage">
        <div class="col s12">
            <p class="center"> NINE </p>
        </div>
        <div class="col s12 center">
            <p><?php echo $action; ?></p>
            <br>
        </div>
        <div class="col s12 center-align">
            <a class="waves-effect waves-light btn" href="<?php echo $href ?>">Home</a>
        </div>
        <div class="col s12">
            <p></p>
        </div>
    </div>
</div>
</body>
<?php
require_once ("Plantilla/PieDePagina.php");
?>
