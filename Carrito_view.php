<?php include 'Plantilla/Header.php'; ?>
<?php 
    $id_usr = $_SESSION['user_id'];
    $carrito = new carrito();
    $cantidad = $carrito->getCantidad($id_usr);
    $getCarrito = $carrito->getCarrito($id_usr);

    $Productos = new products();

    $Clientes = new users();

?>
<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green" id='section-header'>
                <span class="card-title" align='center'>PRODUCTOS EN EL CARRITO: <p></p> <?php echo $cantidad?></span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th class='center' id='text-standarized'>NOMBRE DEL PRODUCTO/SERVICIO</th>
            <th class='center' id='text-standarized'>CODIGO DE PRODUCTO</th>
            <th class='center' id='text-standarized'>PRECIO POR UNIDAD</th>
            <th class='center' id='text-standarized'>CANTIDAD</th>
            <th class='center' id='text-standarized'>TOTAL</th>
            <th colspan="3" id='text-standarized'>ACCIONES</th>

        </tr>
        </thead>

        <?php
        $totalT = 0;
        $total = 0;
        foreach ($getCarrito as $Sql): ?>
            <?php
            $id_producto = $Sql['id_producto'];
            $Producto = $Productos->getProductoByID($id_producto);
            foreach ($Producto as $SQLProductos):
                ?>
                <tr>
                    <?php $str = strtoupper($SQLProductos['nombre']); echo "<td class='center' id='text-standarized'>". $str ."</td>"; ?>
                    <?php echo "<td class='center' id='text-standarized'>". $SQLProductos['codigo'] ."</td>"; ?>
                    <?php echo "<td class='center' id='text-standarized'> $". $SQLProductos['costo'] ."</td>"; ?>
                    <?php echo "<td class='center' id='text-standarized'> ". $Sql['cantidad'] ."</td>"; ?>
                    <?php $total = $Sql['cantidad'] * $SQLProductos['costo']; ?>
                    <?php $totalT = $total+$totalT; ?>
                    <?php echo "<td class='center' id='text-standarized'> $". $total ."</td>"; ?>
                    <?php echo "<td class='center'>"."<a href='Producto_view.php?id=".$SQLProductos['id_producto']."' class='large material-icons' id='icons-standarized'>visibility</a>". "</td>"; ?>
                    <?php echo "<td class='center'>"."<a href='NoComprarProducto.php?id=".$SQLProductos['id_producto']."' class='large material-icons' id='icons-standarized'>delete_forever</a>". "</td>"; ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>


    </table>
    <br>
    <br>

    <?php
    
    $cliente = $Clientes->getUser($id_usr);
    //Libro

    foreach ($cliente as $Sql):

        $nombre = $Sql['nombre'];
        $apellido_p = $Sql['apellido_p'];

        $apellido_m = $Sql['apellido_m'];
        $calle = $Sql['calle'];
        $colonia = $Sql['colonia'];
        $codigo_postal = $Sql['codigo_postal'];

        $telefono = $Sql['numero_de_telefono'];
        $pago = $Sql['metodo_de_pago'];

        ?>
        <div class="row">
                <td><input type="hidden" name="total" value="<?php echo  $total; ?>" type="text"></td>

                <td><input type="hidden" name="cantidad" value="<?php echo  $cantidad; ?>" type="text"></td>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="first_name" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['nombre']; ?>">
                        <label for="first_name" id='text-standarized'>Nombre:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="apellido_p" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['apellido_p']; ?>">
                        <label for="apellido_p" id='text-standarized'>Apellido Paterno:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="apellido_m" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['apellido_m']; ?>">
                        <label for="apellido_m" id='text-standarized'>Apellido Materno:</label>
                    </div>
                </div>
                <form action="Action.php" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <td><input name="calle" value="<?php echo  $Sql['calle']; ?>" type="text" id='text-standarized'></td>
                        <!--                    <input name="calle" type="text" class="validate" disabled value="--><?php //echo  $Sql['calle']; ?><!--">-->
                        <label for="calle" id='text-standarized'>Calle:</label>
                    </div>
                    <div class="input-field col s1">
                        <td><input name="numero_domicilio" value="<?php echo  $Sql['numero_domicilio']; ?>" type="text" id='text-standarized'></td>
                        <!--                    <input name="calle" type="text" class="validate" disabled value="--><?php //echo  $Sql['calle']; ?><!--">-->
                        <label for="numero" id='text-standarized'>Numero:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="colonia" id="icon_email" type="text" class="validate" value="<?php echo  $Sql['colonia']; ?>">
                        <label for="colonia" id='text-standarized'>Colonia:</label>
                    </div>
                    <div class="input-field col s1">
                        <input name="codigo_postal" id="icon_email" type="text" class="validate"  value="<?php echo  $codigo_postal; ?>">
                        <label for="codigo_postal" id='text-standarized'>Codigo Postal:</label>
                    </div>
                    <div class="input-field col s1">
                        <input name="telefono" id="icon_email" type="text" class="validate"  value="<?php echo  $telefono; ?>">
                        <label for="telefono" id='text-standarized'>Teléfono:</label>
                    </div>
                </div>

                <div class="input-field col s6">
                    <select name="pago" id="pago" required>
                        <option value="" disabled selected>Elegir opción (REQUERIDO)</option>
                        <option value="<?php $str = strtoupper($pago); echo  $str; ?>">DEFAULT: <?php $str = strtoupper($pago); echo  $str; ?></option>
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="DEBITO">DEBITO</option>
                    </select>
                    <label id='text-standarized'>Metodo de Pago</label>
                </div>
                <div class="input-field col s6">
                    <select name="envio" id="envio" required>
                        <option value="" disabled selected >Elegir opción (REQUERIDO)</option>
                        <option value="DHL">DHL EXPRESS (3 días) - $99</option>
                        <option value="FEDEX">FEDEX (5 días) - $50</option>
                        <option value="UPS">UPS (7 días habiles) - GRATIS</option>
                    </select>
                    <label id='text-standarized'>Metodo de Envio</label>
                </div>
                <script>
                    print(instance.getSelectedValues());
                </script>
                    <p id='text-standarized'>
                        TOTAL: $
                        <?php echo $totalT?>
                    </p>
                    <input name="TotalT" value="<?php echo $totalT?>" hidden>
                    <input name="FormID" value="Pagar" hidden>
                    <td><input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text"></td>
                    <button <?php if($totalT == 0) echo "disabled"; ?> class="waves-effect waves-light btn-small green" type="submit" value="Submit"><i class="material-icons left">payment</i>Pagar</button>
                </form>

                <?php  if(!empty($errores)): ?>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                <?php  endif; ?>

            </form>
        </div>
    <?php endforeach; ?>

</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>