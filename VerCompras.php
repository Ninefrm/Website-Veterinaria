<?php include 'Plantilla/Header.php'; ?>
<?php
$servername = "localhost";
$username = "ninefrmx_root";
$password = "Samuel20";
$mydb = "ninefrmx_veterinaria";
$total = 0;

try{
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$id_usr = $_SESSION['id'];
$tipo = $_SESSION['tipo'];
//echo $_SESSION['tipo'];
if($tipo == "Cliente"){
    $venta = $conn -> prepare("
	SELECT * FROM venta WHERE id_cliente = $id_usr");
}
if($tipo == "Administrador"){
    $venta = $conn -> prepare("
	SELECT * FROM venta ORDER BY id_cliente");
}

//Libro
$venta ->execute();
$venta = $venta ->fetchAll();

?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green">
                <span class="card-title" align='center'>PRODUCTOS COMPRADOS</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
            <th>CODIGO</th>
            <?php if($tipo=="Administrador"){
                ECHO "<th>CLIENTE</th>";
            }
            ?>
            <th>GUIA DE ENVIO</th>
            <th>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($venta as $Sql): $id_cliente = $Sql['id_cliente'];
            $id_venta = $Sql['id'];?>
            <?php
//        echo

            $id_libro = $Sql['id_libro'];
            $libros = $conn -> prepare("
	SELECT * FROM libro WHERE activo = '1' AND id = $id_libro");
//Libro
            $libros ->execute();
            $libros = $libros ->fetchAll();
//            echo $Total = count($libros);
            foreach ($libros as $SqlLibro):

                ?>
                <tr>
                    <?php $str = strtoupper($SqlLibro['nombre_libro']); echo "<td>". $str ."</td>"; ?>
                    <?php echo "<td>". $SqlLibro['ISBN'] ."</td>"; ?>
                    <?php if($tipo=="Administrador"){
                        ECHO "<td> $id_cliente </td>";
                    }
                    ?>
                    <?php echo "<td>". $Sql['guia_de_envio'] ."</td>"; ?>
                    <?php echo "<td> $". $SqlLibro['costo'] ."</td>"; ?>
                    <?php $total = $total + $SqlLibro['costo'];?>
                    <?php echo "<td>
                                <form action='VerLibro.php' method='get'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_libro'>
                                <i class='material-icons'>visibility</i>
                                </button>
                                </form></td>"; ?>

                    <?php
                    if($Sql['activo']==1) {

                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small red\"><i class=\"material-icons\">announcement</i></button>
                                </td>";
                    }if($Sql['activo']==2){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small yellow\"><i class=\"material-icons\">send</i></button>
                                </td>";

                    }if($Sql['activo']==3){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small green\"><i class=\"material-icons\">check</i></button>
                                </td>";
                    }?>
                    <?php if($_SESSION['tipo']=="Administrador"){
//                        echo $id_cliente;
//                        $id_venta = $Sql['id_venta'];
                        echo "<td>
                                <form action='EditarPago.php' method='post'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_venta'>
                                <i class='material-icons'>create</i>
                                </button>
                                </form></td>";
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
    <br>
    <br>

</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>

