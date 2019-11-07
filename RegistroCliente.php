<?php include 'Plantilla/Header.php'; ?>
<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue">
                <span class="card-title" align='center'>NUEVO CLIENTE</span>
            </div>
        </div>
    </div>
    <form action="RegisterCliente.php" method="post" name="NuevoUsuario" enctype="multipart/form-data" id="NuevoUsuario">
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th>Nombre del cliente:</th>
                <td><input name="nombre_cliente" type="text"></td>
            </tr>
            <tr>
                <th>Apellido paterno:</th>
                <td><input name="apellido_p" type="text"></td>
            </tr>
            <tr>
                <th>Apellido materno:</th>
                <td><input name="apellido_m" type="text"></td>
            </tr>
            <tr>
                <th>Fecha de nacimiento:</th>
                <td class="input-field col s3">
                        <input type="date" id="fecha_nac" name="fecha_nac"
                               value="<?php echo date("Y-m-d")?>"
                               min="1960-1-1" max="<?php $date = strtotime('-8 year');
                               echo date("Y-m-d",$date)?>">
                    </td>
            </tr>
            <tr>
                <th>Correo electronico:</th>
                <td><input name="correo_electronico" type="text"></td>
            </tr>
            <tr>
                <th>Contraseña:</th>
                <td><input name="password" type="password"></td>
            </tr>
            <tr>
                <th>Número de teléfono:</th>
                <td><input name="numero_de_telefono" type="text"></td>
            </tr>
            <tr>
                <th>Calle:</th>
                <td><input name="calle" type="text"></td>
            </tr>
            <tr>
                <th>#:</th>
                <td><input name="numero_domicilio" type="text"></td>
            </tr>
            <tr>
                <th>Colonia:</th>
                <td><input name="colonia" type="text"></td>
            </tr>
            <tr>
                <th>Codigo postal:</th>
                <td><input name="codigo_postal" type="text"></td>
            </tr>
            <tr>
                <th>Metodo de pago:</th>
                <td><input name="metodo_de_pago" type="text"></td>
            </tr>
        </table>
        <form action="RegisterCliente.php" method="post" id="NuevoUsuario">
            <button class="waves-effect waves-light btn-small blue right" type="submit" form="NuevoUsuario" value="Submit"><i class="material-icons left">account_box</i>Registrarse</button>
            <button class="waves-effect waves-light btn-small red" type="reset" form="NuevoUsuario" value="Submit"><i class="material-icons right">delete</i>Limpiar formulario</button>
        </form>

    </form>

</div>
<?php include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>
