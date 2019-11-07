<?php include 'Plantilla/Header.php'; ?>
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
$productos = $conn -> prepare("
	SELECT * FROM producto WHERE activo = 1 ORDER BY vendidos desc ");
//Libro
$productos ->execute();
$productos = $productos ->fetchAll();

$servicios = $conn -> prepare("
	SELECT * FROM servicio WHERE activo = 1 ORDER BY vendidos desc ");
//Libro
$servicios ->execute();
$servicios = $servicios ->fetchAll();

?>

<div class="container">
    <style>
        div.part1 p {
            background-color: rgba(255,255,255,.8);
            display: block;
            position: absolute;
            bottom: -55%;
            left: 0;
            padding: 0px;
            width: 100%;
        }
    </style>

    <?php

        ECHO "
        <div class=\"col s12 m6\">
        <div class=\"card blue-grey darken-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\" align='center'>PRODUCTOS</span>
            </div>
        </div>
    </div>
    <article>
        <div class=\"carousel part1\">";
        foreach ($productos as $Sql):
            $id = $Sql['id_producto'];
            $image = $Sql['imagen'];
            $nombre = $Sql['nombre'];
            $precio = $Sql['costo'];
            $descripcion = $Sql['descripcion'];
            ECHO "<a class='carousel-item' href='VerProducto.php?id=$id'><img src='upload/productos/$image'><p>$nombre<br>Precio: $$precio
                <br>Descripcion: $descripcion</p></a>";
        endforeach;
        ECHO "
        </div>
    </article> 
        ";
    ?>
<!--//SERVICIOS-->
    <?php

    ECHO "
        <div class=\"col s12 m6\">
        <div class=\"card blue-grey darken-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\" align='center'>SERVICIOS</span>
            </div>
        </div>
    </div>
    <article>
        <div class=\"carousel part1\">";
    foreach ($servicios as $Sql):
        $id = $Sql['id_servicio'];
        $image = $Sql['imagen'];
        $nombre = $Sql['nombre'];
        $precio = $Sql['costo'];
        $descripcion = $Sql['descripcion'];
        ECHO "<a class='carousel-item' href='VerServicio.php?id=$id'><img src='upload/servicios/$image'><p>$nombre<br>Precio: $$precio
                <br>Descripcion: $descripcion</p></a>";
    endforeach;
    ECHO "
        </div>
    </article> 
        ";
    ?>



</div>




<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>

