<?php include 'Plantilla/Header.php'; ?>
<?php
$servername = "localhost";
$username = "ninefrmx_root";
$password = "Samuel20";
$mydb = "ninefrmx_veterinaria";
$total = 0;

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$id_usr = $_SESSION['id'];
$carrito = $conn -> prepare("
	SELECT * FROM carro WHERE activo = '1' AND id_cliente = $id_usr");
//Libro
$carrito ->execute();
$carrito = $carrito ->fetchAll();
$cantidad = count($carrito);

?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green">
                <span class="card-title" align='center'>PRODUCTOS EN EL CARRITO: <p></p> <?php echo $cantidad?></span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL LIBRO</th>
            <th>CODIGO DE PRODUCTO</th>
            <th>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($carrito as $Sql): ?>
            <?php
            $id_producto = $Sql['id_producto'];
            $productos = $conn -> prepare("
	        SELECT * FROM producto WHERE activo = 1 AND id_producto = $id_producto");
//Libro
            $productos ->execute();
            $productos = $productos ->fetchAll();
            foreach ($productos as $SQLProductos):
                ?>
                <tr>
                    <?php $str = strtoupper($SQLProductos['nombre']); echo "<td>". $str ."</td>"; ?>
                    <?php echo "<td class='center'>". $SQLProductos['codigo'] ."</td>"; ?>
                    <?php echo "<td> $". $SQLProductos['costo'] ."</td>"; ?>
                    <?php $total = $total + $SQLProductos['costo']; ?>
                    <?php echo "<td class='centrar'>"."<a href='VerProducto.php?id=".$SQLProductos['id_producto']."' class='large material-icons'>visibility</a>". "</td>"; ?>
                    <?php echo "<td class='centrar'>"."<a href='NoComprar.php?id=".$SQLProductos['id_producto']."' class='large material-icons'>delete_forever</a>". "</td>"; ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>

<!--SERVICIOS        -->

        <?php foreach ($carrito as $Sql): ?>
            <?php
            $id_servicio = $Sql['id_servicio'];
            $productos = $conn -> prepare("
	        SELECT * FROM servicio WHERE activo = 1 AND id_servicio = $id_servicio");
            $productos ->execute();
            $productos = $productos ->fetchAll();
            foreach ($productos as $SQLServicio):
                ?>
                <tr>
                    <?php $str = strtoupper($SQLServicio['nombre']); echo "<td>". $str ."</td>"; ?>
                    <?php echo "<td class='center'>". $SQLServicio['codigo'] ."</td>"; ?>
                    <?php echo "<td> $". $SQLServicio['costo'] ."</td>"; ?>
                    <?php $total = $total + $SQLServicio['costo']; ?>
                    <?php echo "<td class='centrar'>"."<a href='VerServicio.php?id=".$SQLServicio['id_servicio']."' class='large material-icons'>visibility</a>". "</td>"; ?>
                    <?php echo "<td class='centrar'>"."<a href='NoComprar.php?id=".$SQLServicio['id_servicio']."' class='large material-icons'>delete_forever</a>". "</td>"; ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>

    </table>
    <br>
    <br>

    <?php
    $id_usr = $_SESSION['id'];
    $cliente = $conn -> prepare("
	SELECT * FROM cliente WHERE activo = 1 AND id_cliente = $id_usr");
    //Libro
    $cliente ->execute();
    $cliente = $cliente ->fetchAll();

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
        <p>
            TOTAL: $
            <?php echo $total?>
        </p>
        <div class="row">
            <form action="Pagar.php" method="post" id="mainform">
                <td><input type="hidden" name="total" value="<?php echo  $total; ?>" type="text"></td>
                <td><input type="hidden" name="cantidad" value="<?php echo  $cantidad; ?>" type="text"></td>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="first_name" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['nombre']; ?>">
                        <label for="first_name">Nombre:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="apellido_p" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['apellido_p']; ?>">
                        <label for="apellido_p">Apellido Paterno:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="apellido_m" id="icon_email" type="text" class="validate" disabled value="<?php echo  $Sql['apellido_m']; ?>">
                        <label for="apellido_m">Apellido Materno:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <td><input name="calle" value="<?php echo  $Sql['calle']; ?>" type="text"></td>
                        <!--                    <input name="calle" type="text" class="validate" disabled value="--><?php //echo  $Sql['calle']; ?><!--">-->
                        <label for="calle">Calle:</label>
                    </div>
                    <div class="input-field col s1">
                        <td><input name="numero_domicilio" value="<?php echo  $Sql['numero_domicilio']; ?>" type="text"></td>
                        <!--                    <input name="calle" type="text" class="validate" disabled value="--><?php //echo  $Sql['calle']; ?><!--">-->
                        <label for="numero">Numero:</label>
                    </div>
                    <div class="input-field col s3">
                        <input name="colonia" id="icon_email" type="text" class="validate" value="<?php echo  $Sql['colonia']; ?>">
                        <label for="colonia">Colonia:</label>
                    </div>
                    <div class="input-field col s1">
                        <input name="codigo_postal" id="icon_email" type="text" class="validate"  value="<?php echo  $codigo_postal; ?>">
                        <label for="codigo_postal">Codigo Postal:</label>
                    </div>
                    <div class="input-field col s1">
                        <input name="telefono" id="icon_email" type="text" class="validate"  value="<?php echo  $telefono; ?>">
                        <label for="telefono">Teléfono:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input type="date" id="start" name="trip-start"
                               value="<?php echo date("Y-m-d")?>"
                               min="<?php echo date("Y-m-d")?>" max="<?php echo date("Y-m-d")?>">
                        <label for="start">Cita para servicios:</label>
                    </div>
                </div>

                <div class="input-field col s6">
                    <select name="pago">
                        <option value="" disabled selected>Elegir opción</option>
                        <option value="<?php $str = strtoupper($pago); echo  $str; ?>">DEFAULT: <?php $str = strtoupper($pago); echo  $str; ?></option>
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="DEBITO">DEBITO</option>
                    </select>
                    <label>Metodo de Pago</label>
                </div>
                <div class="input-field col s6">
                    <select name="envio">
                        <option value="" disabled selected>Elegir opción</option>
                        <option value="DHL">DHL EXPRESS (3 días) - $99</option>
                        <option value="FEDEX">FEDEX (5 días) - $50</option>
                        <option value="UPS">UPS (7 días habiles) - GRATIS</option>
                    </select>
                    <label>Metodo de Envio</label>
                </div>
                <script>
                    print(instance.getSelectedValues());
                </script>

                <form action="Pagar.php" method="post" id="mainform">
                    <td><input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text"></td>
                    <button class="waves-effect waves-light btn-small green" type="submit" form="mainform" value="Submit"><i class="material-icons left">payment</i>Pagar</button>
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

