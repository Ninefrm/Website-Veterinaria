<?php include 'Plantilla/Header.php'; ?>
<?php

$id_usr = $_SESSION['user_id'];
$tipo = $_SESSION['perfil'];
if(isset($_GET['id'])){

    $id_mascota = $_GET['id'];

    $Mascotas = new pet();
    if($tipo =="Administrador"){
        $mascotas = $Mascotas->getPetByIDToADM($id_mascota);
    }else{
        $mascotas = $Mascotas->getPetByID($id_usr, $id_mascota);
    }
    

    $Agenda = new agenda();
    $GetCitas = $Agenda->getCitaByPetID($id_mascota);

    $Servicio = new services();


?>


<div class="container">

    <table class="responsive-table">

        <thead>
        <tr>
            <th id='text-standarized'>CATEGORIA</th>
            <th id='text-standarized'>NOMBRE DE LA MASCOTA</th>
            <th id='text-standarized'>FECHA DE NACIMIENTO</th>
            <?php if($tipo=="Administrador"){
                ECHO "<th id='text-standarized'>CLIENTE</th>";
            }
            ?>
            <th id='text-standarized'>FECHA ULTIMA VACUNA</th>
            <th id='text-standarized'>ULTIMO PESO</th>
            <th id='text-standarized'>RAZA</th>


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
            <?php $str = strtoupper($Sql['nombre']); echo "<td id='text-standarized'>". $str ."</td>"; ?>
            <?php echo "<td id='text-standarized'>". $Sql['fecha_nac'] ."</td>"; ?>
            <?php if($tipo=="Administrador"){
                ECHO "<td id='text-standarized'>".$Sql['nombre_cliente']."</td>";
            }
            ?>
            <?php echo "<td id='text-standarized'>". $Sql['fecha_vac'] ."</td>"; ?>
            <?php echo "<td id='text-standarized'>". $Sql['peso'] ." kg </td>"; ?>
            <?php echo "<td id='text-standarized'>". $Sql['raza'] ."</td>"; ?>

                    
            </tr>
        <?php endforeach; ?>

    </table>
    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue" id='section-header'>
                <span class="card-title" align='center'>HISTORIAL CLINICO</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
            <tr>
                <th id='text-standarized'>SERVICIO</th>
                <th id='text-standarized'>MEDICO A CARGO</th>
                <th id='text-standarized'>FECHA DE CITA</th>
                <th id='text-standarized'>METODO DE PAGO</th>
                <th id='text-standarized'>TOTAL</th>
                <th id='text-standarized'>RECETA MEDICA</th>
                <th id='text-standarized'>STATUS</th>
            </tr>
        </thead>
        <?php foreach ($GetCitas as $Sql): ?>
            <td id='text-standarized'> <?php echo ($Servicio->getNameByID($Sql['id_servicio'])[0]['nombre']) ?> </td>
            <td id='text-standarized'> Principal </td>
            <!-- <td> <?php echo $Sql['id_medico'] ?> </td> -->
            <td id='text-standarized'> <?php echo $Sql['cita'] ?> </td>
            <td id='text-standarized'> <?php echo $Sql['pago'] ?> </td>
            <td id='text-standarized'> $<?php echo $Sql['total'] ?> </td>
            <?php if($tipo == "Administrador"){ ?>
                <td> 
                <form action="Action.php" method="post" enctype="multipart/form-data" >
                    <input name="FormID" value="Receta_edit" hidden>
                    <input name="cita_id" value="<?php echo $Sql['historial_clinico_id'] ?>" hidden>
                    <input name="mascota_id" value="<?php echo $id_mascota ?>" hidden>
                    <input value='<?php echo $Sql['receta'] ?>' name='receta'> 
                    <select name='status'>
                        <option <?php if($Sql['status'] == 1) echo "selected"; ?> value='1'> Sin revisar </option>
                        <option <?php if($Sql['status'] == 2) echo "selected"; ?> value='2'> En revisión </option>
                        <option <?php if($Sql['status'] == 3) echo "selected"; ?> value='3'> Revisión completa </option>
                    </select>
                    <button class="waves-effect waves-light btn-small blue right" type="submit" value="Submit"><i class="material-icons">edit</i>Recetar</button>
                </form>
                </td>
            <?php }else{ ?>
                <td id='text-standarized'> <?php echo $Sql['receta'] ?> </td>
            <?php } ?>
            

            <?php
                if($Sql['status']==1) {

                    ECHO "<td>
                            <button class=\"waves-effect waves-light btn-small red\"><i class=\"material-icons\">announcement</i></button>
                            </td>";
                }if($Sql['status']==2){
                    ECHO "<td>
                            <button class=\"waves-effect waves-light btn-small yellow\"><i class=\"material-icons\">send</i></button>
                            </td>";

                }if($Sql['status']==3){
                    ECHO "<td>
                            <button class=\"waves-effect waves-light btn-small green\"><i class=\"material-icons\">check</i></button>
                            </td>";
            }?> 
        <?php endforeach; ?>
    </table>

    <br>
    <br>

</div>




<?php }else{ ?> 

<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue" id='section-header'>
                <span class="card-title" align='center'>AGREGAR MASCOTA</span>
            </div>
        </div>
    </div>
    <form action="Action.php" method="post">
        <input name="FormID" value="Add_Mascota" hidden>
        <input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text">
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th id='text-standarized'>Nombre de tu mascota:</th>
                <td><input name="nombre_mascota" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Fecha de nacimiento:</th>
                <td class="input-field col s3">
                    <input type="date" id="fecha_nac" name="fecha_nac"
                           value="<?php echo date("Y-m-d")?>"
                           min="<?php $date = strtotime('-15 year');
                           echo date("Y-m-d",$date)?>">
                </td>
            </tr>
            <tr>
                <th id='text-standarized'>Fecha ultima vacuna:</th>
                <td class="input-field col s3">
                    <input type="date" id="fecha_vac" name="fecha_vac"
                           value="<?php echo date("Y-m-d")?>"
                           min="<?php $date = strtotime('-2 year');
                           echo date("Y-m-d",$date)?>">
                </td>
            </tr>
            <tr>
                <th id='text-standarized'>Categoria:</th>
                <td><select name="categoria">
                    <option value="\U1F436">Perro</option>
                    <option value="\U1F431">Gato</option>
                    <option value="\U1F430">Conejo</option>
                    <option value="\U1F42D">Roedor</option>
                    <option value="\U1F422">Tortuga</option>
                    <option value="\U1F420">Pez</option>
                    <option value="\U1F425">Pajaro</option>
                    <option value="\U1F40D">Reptil</option>
                    <option value="\U1F414">Gallina</option>
                    <option value="\U1F40E">Caballo</option>
                    <option value="\U1F411">Mamíferos Rumiantes</option>
                </select>
            </tr>
            <tr>
                <th id='text-standarized'>Raza:</th>
                <td><input name="raza" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Color:</th>
                <td><input name="color" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Peso:</th>
                <td><input name="peso" type="text" id='text-standarized'></td>
            </tr>

        </table>
        <button class="waves-effect waves-light btn-small green right" type="submit" value="Submit"><i class="material-icons left">pets</i>Registrar</button>
        <button class="waves-effect waves-light btn-small red" type="reset" value="Submit"><i class="material-icons right">delete</i>Limpiar formulario</button>
    </form>

</div>

<?php } include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>