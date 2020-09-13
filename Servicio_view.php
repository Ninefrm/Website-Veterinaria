<?php include 'plantilla/Header.php'; ?>
<?php
    $id_producto = $_GET['id'];

    $servicio  = new services();
    //Producto
    $servicio  = $servicio ->getServicioByID($id_producto);

    if(!$servicio ){
        $mensaje .= 'Servicio inexistente';
    }

?>
<section class="main">
    <div class="container">
        <?php foreach ($servicio as $Sql): ?>
            <div class="parallax-container">
                <?php
                $imagen = $Sql['imagen'];
                Echo "<div class=\"parallax\">
                    <img class=\"materialboxed\" src=\"upload/servicios/$imagen \">
                    </div>";
                ?>
            </div>

            <div class="col s6 left">
                <?php
                if(!empty($_SESSION['tipo'])){
                    if($_SESSION['perfil']=="Administrador"){
                        $id = $Sql['id_servicio'];
                        ECHO "
                <form action=\"Servicio_edit.php\" method=\"post\" id=\"EditarServicio\">
                        <td><input type=\"hidden\" name=\"id_servicio\" id=\"id_servicio\" value=\"$id\" type=\"text\"></td>
                    <button class=\"waves-effect waves-light btn-small yellow\" type=\"submit\" form=\"EditarServicio\" value=\"Submit\"><i class=\"material-icons\">edit</i>Editar servicio.</button>
                </form>";
                    }

                }else{

                }
                ?>
            </div>

            <div class="col s6 right">
                <?php
                if(!empty($_SESSION['user_id'])){
                    $id = $Sql['id_servicio'];
                    ECHO "
                    <form action=\"Cita_add.php\" method=\"post\">
                        <input name=\"FormID\" value=\"GenerarCita\" hidden>
                        <td><input type=\"hidden\" name=\"id_servicio\" value=\"$id\" type=\"text\"></td>
                    <button class=\"waves-effect waves-light btn-small red\" type=\"submit\" value=\"Submit\"><i class=\"material-icons left\">local_hospital
                    </i>Generar cita</button>
                    </form>
                    ";
                }else{
                    ECHO "
                    <form action=\"Cita_add.php\" method=\"post\" id=\"GenerarCita\">
                        <td><input type=\"hidden\" name=\"id_servicio\" value=\"\" type=\"text\"></td>
                        <button class=\"waves-effect waves-light btn-small green disabled\" type=\"submit\" value=\"Submit\"><i class=\"material-icons left\">local_hospital</i>INICIA SESIÓN PARA PODER COMPRAR</button>
                    </form>
                    ";
                }
                ?>

            </div>
            <div class="row">
                <div class="col s6"><h2 class="mayusculas"><?php
                        $str = strtoupper($Sql['nombre']);
                        echo "<td>". $str. "</td>"; ?>.</h2></div>
            </div>
            <table class="striped">
                <tr>
                    <th>Descripcion:</th>
                    <th><?php echo "<td>". $Sql['descripcion']. "</td>"; ?></th>
                </tr>
            </table>
            <div class="row ">
                <div class="col s6 m6">
                    <div class="center promo promo-example">
                        <i class="material-icons">attach_money</i>
                        <p class="promo-caption">Costo:</p>
                        <p class="light center">$<?php echo "<td>". $Sql['costo']. "</td>"; ?></p>
                    </div>
                </div>
                <div class="col s6 m6">
                    <div class="center promo promo-example">
                        <i class="material-icons">code</i>
                        <p class="promo-caption">Codigo:</p>
                        <p class="light center"><?php echo "<td>". $Sql['codigo']. "</td>"; ?></p>
                    </div>
                </div>
            </div>
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