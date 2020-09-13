<?php include 'Plantilla/Header.php'; ?>
<?php
    // print_r($_POST);
if(isset($_POST['id_servicio'])){
    $ID_Servicio = $_POST['id_servicio'];
    $id_usr = $_SESSION['user_id'];
    $Servicio = new services();
    $GetServicio = $Servicio->getServicioByID($ID_Servicio);
    $Clientes = new users();
    $Mascotas = new pet();
    $mascotas = $Mascotas->getPetByUserID($id_usr);
    $total = 0;
?>
<div class="container">

    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL SERVICIO</th>
            <th class='center'>CODIGO DE PRODUCTO</th>
            <th class='center'>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($GetServicio as $Sql): ?>
            <tr>
                <?php $str = strtoupper($Sql['nombre']); echo "<td>". $str ."</td>"; ?>
                <?php echo "<td class='center'>". $Sql['codigo'] ."</td>"; ?>
                <?php echo "<td class='center'> $". $Sql['costo'] ."</td>"; ?>
                <?php $total = $total + $Sql['costo']; ?>
                <?php echo "<td class='center'>"."<a href='Servicio_view.php?id=".$Sql['id_servicio']."' class='large material-icons'>visibility</a>". "</td>"; ?>
                <?php echo "<td class='center'>"."<a href='Servicio_view.php?id=".$Sql['id_servicio']."' class='large material-icons'>delete_forever</a>". "</td>"; ?>
            </tr>
        <?php endforeach; ?>

    </table>
    <br>
    <br>

    <?php
    
    $cliente = $Clientes->getUser($id_usr);

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
            <form action="Action.php" method="post" id="mainform">
                <input name="FormID" value="Generar_Cita" hidden>
                <td><input type="hidden" name="total" value="<?php echo  $total; ?>" type="text"></td>

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
                        <input type="date" id="fecha_cita" name="fecha_cita"
                               value="<?php echo date("Y-m-d")?>"
                               min="<?php echo date("Y-m-d")?>" max="<?php echo date("Y-m-d")?>">
                        <label for="fecha_cita">Cita para servicios:</label>
                    </div>
                    <div class="input-field col s3">
                        <select name="mascota" id="mascota" required>
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
                    <div class="input-field col s6">
                    <select name="pago" id="pago" required>
                        <option value="" disabled selected>Elegir opción (REQUERIDO)</option>
                        <option value="<?php $str = strtoupper($pago); echo  $str; ?>">DEFAULT: <?php $str = strtoupper($pago); echo  $str; ?></option>
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="DEBITO">DEBITO</option>
                    </select>
                    <label>Metodo de Pago</label>
                </div>
                </div>

                
                <script>
                    print(instance.getSelectedValues());
                </script>
                <p>
                    TOTAL: $
                    <?php echo $total?>
                </p>

                
                    <td><input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text"></td>
                    <td><input type="hidden" name="id_servicio" value="<?php echo  $ID_Servicio; ?>" type="text"></td>
                    <button class="waves-effect waves-light btn-small green" type="submit" value="Submit"><i class="material-icons left">payment</i>Pagar</button>
            </form>

                <?php  if(!empty($errores)): ?>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                <?php  endif; ?>

        </div>
    <?php endforeach; ?>

</div>




<?php }else{ die(); } 
include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>