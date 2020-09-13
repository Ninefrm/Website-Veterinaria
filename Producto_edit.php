<?php include 'plantilla/Header.php'; ?>
<?php
    if(isset($_POST['id_producto'])){
        $id_producto = $_POST['id_producto'];
    }else{
        $id_producto = 0;
    }
    

    $producto = new products();
    //Producto
    $producto = $producto->getProductoByID($id_producto);

    if(!$producto){
        $producto[0]['imagen'] = "default.png";
        $producto[0]['nombre'] = "";
        $producto[0]['descripcion'] = "";
        $producto[0]['costo'] = "";
        $producto[0]['stock'] = "";
        $producto[0]['codigo'] = "";
    }

?>
<section class="main">
    <div class="container">
        <?php foreach ($producto as $Sql): ?>
            <form action="Action.php" method="post" enctype="multipart/form-data" >
                <input name="FormID" value="Product_edit" hidden>
                <input name="product_id" value="<?php echo $id_producto ?>" hidden>
                <input name="imagen" value="<?php echo $Sql['imagen'] ?>" hidden>
                <div class="parallax-container">
                    <?php
                    $imagen = $Sql['imagen'];
                    Echo "<div class=\"parallax\">
                        <img class=\"materialboxed\" src=\"upload/productos/$imagen \">
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
                    <div class="col s4 m4">
                        <div class="center promo promo-example">
                            <i class="material-icons">dashboard</i>
                            <p class="promo-caption">En almacen:</p>
                            <p class="light center"><?php echo "<input value='". $Sql['stock']. "' name='stock'>"; ?></p>
                        </div>
                    </div>
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