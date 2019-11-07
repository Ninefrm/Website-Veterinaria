<?php
$servername = "localhost";
$username = "ninefrmx_root";
$password = "Samuel20";
$mydb = "ninefrmx_veterinaria";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

$id_producto = $_GET['id'];

$producto = $conn -> prepare("
	SELECT * FROM producto WHERE id_producto = $id_producto AND activo = '1'");
//Libro
$producto ->execute();
$producto = $producto ->fetchAll();

if(!$producto){
    $mensaje .= 'Libro inexistente';
}

?>
<?php include 'plantilla/Header.php'; ?>

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
                    if($_SESSION['tipo']=="Administrador"){
                        $id = $Sql['id_producto'];
                        ECHO "
                <form action=\"EditarLibro.php\" method=\"post\" id=\"EditarLibro\">
                        <td><input type=\"hidden\" name=\"id_producto\" value=\"$id\" type=\"text\"></td>
                    <button class=\"waves-effect waves-light btn-small yellow\" type=\"submit\" form=\"EditarLibro\" value=\"Submit\"><i class=\"material-icons\">edit</i>Editar libro</button>
                </form>";
                    }

                }else{

                }
                ?>
            </div>

            <div class="col s6 right">
                <?php
                if(!empty($_SESSION['id'])){
                    $id = $Sql['id_producto'];
                    ECHO "
                    <form action=\"AgregarACarrito.php\" method=\"post\" id=\"mainform\">
                        <td><input type=\"hidden\" name=\"id_producto\" value=\"$id\" type=\"text\"></td>
                    <button class=\"waves-effect waves-light btn-small green\" type=\"submit\" form=\"mainform\" value=\"Submit\"><i class=\"material-icons left\">add_shopping_cart</i>Agregar al carrito</button>
                </form>
                    ";
                }else{
                    ECHO "
                    <form action=\"AgregarACarrito.php\" method=\"post\" id=\"mainform\">
                        <td><input type=\"hidden\" name=\"id_producto\" value=\"\" type=\"text\"></td>
                    <button class=\"waves-effect waves-light btn-small green disabled\" type=\"submit\" form=\"mainform\" value=\"Submit\"><i class=\"material-icons left\">add_shopping_cart</i>INCIA SESIÓN PARA PODER COMPRAR</button>
                </form>
                    ";
                }
                ?>

                <!--                <form action="AgregarCompra.php" method="post" id="mainform">-->
                <!--                    <td><input type="hidden" name="id_libro" value="--><?php //echo  $Sql['id']; ?><!--" type="text"></td>-->
                <!--                    <button class="waves-effect waves-light btn-small green" type="submit" form="mainform" value="Submit"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</button>-->
                <!--                </form>-->
                <!--                <form class="waves-effect waves-light btn-small red" action="foo.php" method="post""><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</form>-->
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
