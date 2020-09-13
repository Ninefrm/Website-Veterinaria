<?php include 'plantilla/Header.php'; ?>
<?php
    if(isset($_POST['id_servicio'])){
        $id_servicio = $_POST['id_servicio'];
    }else{
        $id_servicio = 0;
    }
    

    $servicio = new services();
    //Servicios
    $servicio = $servicio->getServicioByID($id_servicio);

    if(!$servicio){
        $servicio[0]['imagen'] = "default.png";
        $servicio[0]['nombre'] = "";
        $servicio[0]['descripcion'] = "";
        $servicio[0]['costo'] = "";
        $servicio[0]['stock'] = "";
        $servicio[0]['codigo'] = "";
    }

?>
<section class="main">
    <div class="container">
        <?php foreach ($servicio as $Sql): ?>
            <form action="Action.php" method="post" enctype="multipart/form-data" >
                <input name="FormID" value="Service_edit" hidden>
                <input name="servicio_id" value="<?php echo $id_servicio ?>" hidden>
                <input name="imagen" value="<?php echo $Sql['imagen'] ?>" hidden>
                <div class="parallax-container">
                    <?php
                    $imagen = $Sql['imagen'];
                    Echo "<div class=\"parallax\">
                        <img class=\"materialboxed\" src=\"upload/servicios/$imagen \">
                        </div>";
                    ?>
                </div>

                <div class="col s6 left">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>IMAGEN</span>
                            <input type="file" name="ImageToUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">  </div>
                <div class="row">
                    <div class="col s6">
                        <?php
                            $str = strtoupper($Sql['nombre']);
                            echo "<input value='". $str. "' name='nombre'>"; 
                        ?>
                    </div>
                </div>
                <table class="striped">
                    <tr>
                        <th>Descripcion:</th>
                        <th><?php echo "<input value='". $Sql['descripcion']. "' name='descripcion'>"; ?></th>
                    </tr>
                </table>
                <div class="row ">
                    <div class="col s4 m4">
                        <div class="center promo promo-example">
                            <i class="material-icons">attach_money</i>
                            <p class="promo-caption">Costo:</p>
                            <p class="light center">$<?php echo "<input value='". $Sql['costo']. "' name='costo'>"; ?></p>
                        </div>
                    </div>
                    <!-- <div class="col s4 m4">
                        <div class="center promo promo-example">
                            <i class="material-icons">dashboard</i>
                            <p class="promo-caption">En almacen:</p>
                            <p class="light center"><?php echo "<input value='". $Sql['stock']. "' name='stock'>"; ?></p>
                        </div>
                    </div> -->
                    <div class="col s4 m4">
                        <div class="center promo promo-example">
                            <i class="material-icons">code</i>
                            <p class="promo-caption">Codigo:</p>
                            <p class="light center"><?php echo "<input value='".$Sql['codigo']."' name='codigo'>"; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col s6 right">
                    <button class="waves-effect waves-light btn-small blue" type="submit" value="Submit"><i class="material-icons left">save</i>GUARDAR CAMBIOS</button>
                </div>
            </form>
        <?php endforeach; ?>

    </div>
    <a class='waves-effect waves-light btn-large' onclick="goBack()"><i class="material-icons">arrow_back</i></a>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</section>
<?php include 'plantilla/PieDePagina.php'; ?>
</body>
</html>