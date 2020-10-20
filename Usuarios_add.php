<?php include 'Plantilla/Header.php'; ?>

<div class="container">

    <form action="action.php" method="post">
        <input name="FormID" value="register" hidden>
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th id='text-standarized'>Nombre del cliente:</th>
                <td><input name="nombre_cliente" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Apellido paterno:</th>
                <td><input name="apellido_p" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Apellido materno:</th>
                <td><input name="apellido_m" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Fecha de nacimiento:</th>
                <td class="input-field col s3">
                        <input type="date" id="fecha_nac" name="fecha_nac"
                               value="<?php echo date("Y-m-d")?>"
                               min="1960-1-1" max="<?php $date = strtotime('-8 year');
                               echo date("Y-m-d",$date)?>">
                    </td>
            </tr>
            <tr>
                <th id='text-standarized'>Correo electronico:</th>
                <td><input name="correo_electronico" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Contraseña:</th>
                <td><input name="password" type="password" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Número de teléfono:</th>
                <td><input name="numero_de_telefono" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Calle:</th>
                <td><input name="calle" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>#:</th>
                <td><input name="numero_domicilio" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Colonia:</th>
                <td><input name="colonia" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Codigo postal:</th>
                <td><input name="codigo_postal" type="text" id='text-standarized'></td>
            </tr>
            <tr>
                <th id='text-standarized'>Metodo de pago:</th>
                <td><input name="metodo_de_pago" type="text" id='text-standarized'></td>
            </tr>
            <tr>
        </table>
        <div class="col s6 right">
            <button class="waves-effect waves-light btn-small blue right" type="submit">
                <i class="material-icons left">account_box</i>Registrarse
            </button>
        </div>
        <div class="col s6 left">
            <button class="waves-effect waves-light btn-small red" type="reset">
                <i class="material-icons right">delete</i>Limpiar formulario
            </button>
        </div>
    </form>

</div>


<?php include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>