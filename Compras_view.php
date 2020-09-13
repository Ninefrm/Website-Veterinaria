<?php include 'Plantilla/Header.php'; ?>
<?php
$Ventas = new pagar();
$Producto = new products();
$total = 0;

$id_usr = $_SESSION['user_id'];
$tipo = $_SESSION['perfil'];
//echo $_SESSION['tipo'];
if($tipo == "Cliente"){
    $venta = $Ventas->getVentasByUserID($id_usr);
}
if($tipo == "Administrador"){
    $venta = $Ventas->getVentas();
}


?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green">
                <span class="card-title" align='center'>PRODUCTOS COMPRADOS</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
            <th>CODIGO</th>
            <?php if($tipo=="Administrador"){
                ECHO "<th>CLIENTE</th>";
            }
            ?>
            <th>GUIA DE ENVIO</th>
            <th>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($venta as $Sql): 
            $id_cliente = $Sql['id_cliente'];
            $id_venta = $Sql['id_venta'];?>
            <?php
            $productos = explode(",", $Sql['id_producto']);
            $guia = $Sql['guia_de_envio'];
            $i = 0;
            if($tipo!="Administrador"){
                foreach($productos as $producto):
                    $i++;
                    $str = strtoupper($Producto->getProductoByID($producto)[0]['nombre']); 
                    $codigo = ($Producto->getProductoByID($producto)[0]['codigo']); 
                    $precio = ($Producto->getProductoByID($producto)[0]['costo']); 
                    if($Sql['activo']==1) {
                        $color = "red";
                    }if($Sql['activo']==2){
                        $color = "yellow";
                    }if($Sql['activo']==3){
                        $color = "green";
                    }
                    echo "<tr><td>". $str ."</td><td>$codigo</td><td>$guia</td><td>$precio</td><td><button class='waves-effect waves-light btn-small $color'><i class='material-icons'>announcement</i></button></td></tr>"; 
                endforeach;
            }else{
                foreach($productos as $producto):
                    $i++;
                    $str = strtoupper($Producto->getProductoByID($producto)[0]['nombre']); 
                    $codigo = ($Producto->getProductoByID($producto)[0]['codigo']); 
                    $precio = ($Producto->getProductoByID($producto)[0]['costo']); 
                    if($Sql['activo']==1) {
                        $color = "red";
                    }if($Sql['activo']==2){
                        $color = "yellow";
                    }if($Sql['activo']==3){
                        $color = "green";
                    }
                    echo "<tr><td>". $str ."</td><td>$codigo</td><td>$id_cliente</td><td>$guia</td><td>$precio</td><td><button class='waves-effect waves-light btn-small $color'><i class='material-icons'>announcement</i></button></td></tr>"; 
                endforeach;
            }

            ?>

        <?php endforeach; ?>
    </table>
    <br>
    <br>

</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>