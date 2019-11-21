<?php include 'Plantilla/Header.php'; ?>
<?php
//POST
$id_usr = $_POST['id_cliente'];
//echo $id_usr;
?>
<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue">
                <span class="card-title" align='center'>AGREGAR MASCOTA</span>
            </div>
        </div>
    </div>
    <form action="AddMascota.php" method="post" name="AddMascota" enctype="multipart/form-data" id="AddMascota">
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <input type="hidden" name="id_cliente" value="<?php echo  $id_usr; ?>" type="text">
                <th>Nombre de tu mascota:</th>
                <td><input name="nombre_mascota" type="text"></td>
            </tr>
            <tr>
                <th>Fecha de nacimiento:</th>
                <td class="input-field col s3">
                    <input type="date" id="fecha_nac" name="fecha_nac"
                           value="<?php echo date("Y-m-d")?>"
                           min="<?php $date = strtotime('-15 year');
                           echo date("Y-m-d",$date)?>">
                </td>
            </tr>
            <tr>
                <th>Fecha ultima vacuna:</th>
                <td class="input-field col s3">
                    <input type="date" id="fecha_vac" name="fecha_vac"
                           value="<?php echo date("Y-m-d")?>"
                           min="<?php $date = strtotime('-2 year');
                           echo date("Y-m-d",$date)?>">
                </td>
            </tr>
            <tr>
                <th>Categoria:</th>
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
                <th>Raza:</th>
                <td><input name="raza" type="text"></td>
            </tr>
            <tr>
                <th>Color:</th>
                <td><input name="color" type="text"></td>
            </tr>
            <tr>
                <th>Peso:</th>
                <td><input name="peso" type="text"></td>
            </tr>

        </table>
        <form action="AddMascota.php" method="post" id="AddMascota">
            <button class="waves-effect waves-light btn-small green right" type="submit" form="AddMascota" value="Submit"><i class="material-icons left">pets</i>Registrarse</button>
            <button class="waves-effect waves-light btn-small red" type="reset" form="AddMascota" value="Submit"><i class="material-icons right">delete</i>Limpiar formulario</button>
        </form>

    </form>

</div>
<?php include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>
