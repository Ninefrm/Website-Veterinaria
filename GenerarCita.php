<?php include 'Plantilla/Header.php'; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "ninefrmx_veterinaria";
$total = 0;
$id_servicio = $_POST['id_servicio'];

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$tipo = $_SESSION['tipo'];
$id_usr = $_SESSION['id'];
echo $id_usr;

if($tipo == "Cliente"){
    $mascotas = $conn -> prepare("
	SELECT * FROM mascota WHERE id_cliente = $id_usr");
}
if($tipo == "Administrador"){
    $mascotas = $conn -> prepare("
	SELECT * FROM mascota ORDER BY id_cliente");
}

//Libro
$mascotas ->execute();
$mascotas = $mascotas ->fetchAll();

$veterinario = $conn -> prepare("
	SELECT * FROM veterinario");
$veterinario ->execute();
$veterinario = $veterinario->fetchAll();

?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green">
                <span class="card-title" align='center'>CITA A GENERAR:</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
            <th>CODIGO DE PRODUCTO</th>
            <th>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <!--SERVICIOS        -->

        <?php
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
            <form action="PagarServicio.php" method="post" id="mainform">
                <td><input type="hidden" name="total" value="<?php echo  $total; ?>" type="text"></td>
                <td><input type="hidden" name="id_servicio" value="<?php echo  $id_servicio; ?>" type="text"></td>
                <td><input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text"></td>

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
                    <div class="input-field col s3">
                        <input name="numero_de_telefono" id="icon_email" type="text" class="validate"  value="<?php echo  $Sql['numero_de_telefono']; ?>">
                        <label for="numero_de_telefono">Numero de telefono:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="receta" id="icon_email" type="text" class="validate"  value="">
                        <label for="receta">NOTA:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">



                        <script type="text/javascript">
                            window.onload=function () {

                                var date = new Date();

                                var year = date.getFullYear();
                                var month = date.getMonth();
                                var day = date.getDate();
                                var date = new Date(year, month, day);
                                var minOne = new Date(year, month + 1, day);
                                var maxDate;

                                $('#from').datepicker({
                                    autoClose : true,
                                    format : 'yyyy-mm-dd',
                                    yearRange : 1,
                                    minDate:  date,
                                    maxDate: minOne,
                                    defaultDate: date,
                                    setDefaultDate:minOne,
                                });

                            }
                        </script>
                        <input type="text" class="datepicker" id="from" value="from" name="fecha_cita">

<!--                        <input type="date" id="start" name="fecha_cita"-->
<!--                               value="--><?php //echo date("Y-m-d")?><!--"-->
<!--                               min="--><?php //echo date("Y-m-d")?><!--" max="--><?php //$date = strtotime('+1 month');
//                        echo date("Y-m-d",$date)?><!--">-->
                        <label for="start">Cita para servicios:</label>
                    </div>
                    <div class="input-field col s3">
                        <select name="id_mascota">
                            <?php foreach ($mascotas as $Sql): $id_cliente = $Sql['id_cliente'];
                                $id_mascota = $Sql['id_mascota'];
                                $categoria = $Sql['categoria'];
                                $nombre_mascota = $Sql['nombre'];
                                ECHO "<option value = '$id_mascota'> $nombre_mascota </option>";
                            endforeach;
                            ?>
                        </select>
                        <label>Mascota</label>
                    </div>

                    <div class="input-field col s3">
                        <select name="id_veterinario">
                            <?php foreach ($veterinario as $SqlV):
                                $id_veterinario = $SqlV['id_veterinario'];
                                $nombre_veterinario = $SqlV['nombre'];
                                ECHO "<option value = '$id_veterinario'> $nombre_veterinario </option>";
                            endforeach;
                            ?>
                        </select>
                        <label>Veterinario</label>
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

                </div>
                <script>
                    print(instance.getSelectedValues());
                </script>



                <?php  if(!empty($errores)): ?>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                <?php  endif; ?>

            </form>

        </div>
        <form action="PagarServicio.php" method="post" id="mainform">
            <button class="waves-effect waves-light btn-small green" type="submit" form="mainform" value="Submit"><i class="material-icons left">payment</i>Pagar</button>
        </form>
    <?php endforeach; ?>

</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>

