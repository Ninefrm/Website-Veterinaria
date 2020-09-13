<?php include 'Plantilla/Header.php'; ?>
<?php

$id_usr = $_SESSION['user_id'];
$tipo = $_SESSION['perfil'];
$Mascotas = new pet();


if($tipo == "Cliente"){
    $mascotas = $Mascotas->getPetByUserID($id_usr);
}
if($tipo == "Administrador"){
    $mascotas = $Mascotas->getPets();
}
?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue">
                <span class="card-title" align='center'>MASCOTAS</span>
            </div>
        </div>
    </div>
    <form action="Mascota_edit.php" method="post" id="mainform">
        <td><input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text"></td>
        <button class="waves-effect waves-light btn-small green" type="submit" form="mainform" value="Submit"><i class="material-icons left">pets
            </i>Agregar</button>
    </form>
    <table class="responsive-table">

        <thead>
        <tr>
            <th>CATEGORIA</th>
            <th>NOMBRE DE LA MASCOTA</th>
            <th>FECHA DE NACIMIENTO</th>
            <?php if($tipo=="Administrador"){
                ECHO "<th>CLIENTE</th>";
            }
            ?>
            <th>FECHA ULTIMA VACUNA</th>
            <th>ULTIMO PESO</th>
            <th>RAZA</th>

            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($mascotas as $Sql): $id_cliente = $Sql['id_cliente'];
            $id_mascota = $Sql['id_mascota'];
            $categoria = $Sql['categoria'];?>

            <tr>
            <?php
            $html = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $categoria);
            ?>
            <?php $text = "$categoria"; // this has just one backslash, it had to be escaped
            $html = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $text);
            ?>
            <?php ECHO "<td> $html </td>" ?>
            <?php $str = strtoupper($Sql['nombre']); echo "<td>". $str ."</td>"; ?>
            <?php echo "<td>". $Sql['fecha_nac'] ."</td>"; ?>
            <?php if($tipo == "Administrador") echo "<td>". $Sql['nombre_cliente'] ."</td>"; ?>
            <?php echo "<td>". $Sql['fecha_vac'] ."</td>"; ?>
            <?php echo "<td>". $Sql['peso'] ." kg </td>"; ?>
            <?php echo "<td>". $Sql['raza'] ."</td>"; ?>

                    <?php echo "<td>
                                <form action='Mascota_edit.php' method='get'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_mascota'>
                                <i class='material-icons'>visibility</i>
                                </button>
                                </form></td>"; ?>

                    <?php
                    if($Sql['activo']==1) {

                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small red\"><i class=\"material-icons\">announcement</i></button>
                                </td>";
                    }if($Sql['activo']==2){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small yellow\"><i class=\"material-icons\">send</i></button>
                                </td>";

                    }if($Sql['activo']==3){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small green\"><i class=\"material-icons\">check</i></button>
                                </td>";
                    }?>
                    <?php if($_SESSION['tipo']=="Administrador"){
//                        echo $id_cliente;
                        $id_venta = $Sql['id_venta'];
                        echo "<td>
                                <form action='EditarPago.php' method='post'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_venta'>
                                <i class='material-icons'>create</i>
                                </button>
                                </form></td>";
                    }
                    ?>
                </tr>
        <?php endforeach; ?>

    </table>

    <br>
    <br>

</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>