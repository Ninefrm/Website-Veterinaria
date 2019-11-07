<?php include 'Plantilla/Header.php'; ?>
<div class="container">
    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue">
                <span class="card-title" align='center'>AGREGAR SERVICIO</span>
            </div>
        </div>
    </div>
    <form action="AddServicio.php" method="post" name="AddServicio" enctype="multipart/form-data">
        <table width="500" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th>Nombre del servicio:</th>
                <td><input name="nombre_servicio" type="text"></td>
            </tr>
            <tr>
                <th>Codigo del servicio:</th>
                <td><input name="codigo" type="text"></td>
            </tr>
            <tr>
                <th>Descripcion del servicio:</th>
                <td><input name="descripcion" type="text"></td>
            </tr>
            <tr>
                <th>Costo del servicio:</th>
                <td><input name="costo" type="number"></td>
            </tr>
            <tr>
                <th>Imagen del servicio:</th>
                <td><input name="attachment" type="file"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><input type="submit" name="Submit" value="Send"><input type="reset" name="Reset" value="Reset"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>