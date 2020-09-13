<?php include 'plantilla/Header.php'; ?>
<?php
    $id_producto = $_GET['id'];

    $producto = new products();
    //Producto
    $producto = $producto->getProductoByID($id_producto);

    if(!$producto){
        $mensaje .= 'Producto inexistente';
    }

?>
<section class="main">
    <div class="container">
        <?php foreach ($producto as $Sql): ?>
            <div class="parallax-container">
                <?php
                $imagen = $Sql['imagen'];
                Echo "<div class=\"parallax\">
                    <img class=\"materialboxed\" src=\"upload/productos/$imagen \">
                    </div>";
                ?>
            </div>

            <div class="col s6 left">
                <?php
                if(!empty($_SESSION['tipo'])){
                    if($_SESSION['perfil']=="Administrador"){
                        $id = $Sql['id_producto'];
                        ECHO "
                        <form action=\"Producto_edit.php\" method=\"post\" id=\"EditarProducto\">
                                <td><input type=\"hidden\" name=\"id_producto\" value=\"$id\" type=\"text\"></td>
                                <button class=\"waves-effect waves-light btn-small yellow\" type=\"submit\" form=\"EditarProducto\" value=\"Submit\"><i class=\"material-icons\">edit</i>Editar producto.</button>
                        </form>";
                    }

                }else{

                }
                ?>
            </div>

            <div class="col s6 right">
                <?php
                if(!empty($_SESSION['user_id'])){
                    $id = $Sql['id_producto'];
                    ECHO "
                    <form action=\"Action.php\" method=\"post\">
                        <input name=\"FormID\" value=\"carrito\" hidden>
                        <input name=\"id_cliente\" value='".$_SESSION['user_id']."' hidden>
                        <td><input type=\"hidden\" name=\"id_producto\" value=\"$id\" type=\"text\"></td>
                        <button class=\"waves-effect waves-light btn-small green\" type=\"submit\" value=\"Submit\"><i class=\"material-icons left\">add_shopping_cart</i>Agregar al carrito</button>
                    </form>
                    ";
                }else{
                    ECHO "
                    <form action=\"Action.php\" method=\"post\">
                        <input name=\"FormID\" value=\"carrito\" hidden>
                        <td><input type=\"hidden\" name=\"id_producto\" value=\"\" type=\"text\"></td>
                        <button class=\"waves-effect waves-light btn-small green disabled\" type=\"submit\" value=\"Submit\"><i class=\"material-icons left\">add_shopping_cart</i>INICIA SESIÓN PARA PODER COMPRAR</button>
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
                <div class="col s4 m4">
                    <div class="center promo promo-example">
                        <i class="material-icons">attach_money</i>
                        <p class="promo-caption">Costo:</p>
                        <p class="light center">$<?php echo "<td>". $Sql['costo']. "</td>"; ?></p>
                    </div>
                </div>
                <div class="col s4 m4">
                    <div class="center promo promo-example">
                        <i class="material-icons">dashboard</i>
                        <p class="promo-caption">En almacen:</p>
                        <p class="light center"><?php echo "<td>". $Sql['stock']. "</td>"; ?></p>
                    </div>
                </div>
                <div class="col s4 m4">
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