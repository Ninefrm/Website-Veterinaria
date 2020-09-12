<?php include 'Plantilla/Header.php'; ?>
<?php

$Productos = new products();
$Servicios = new services();

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
        $Productos->printInIndex();      
    ?>
<!--//SERVICIOS-->
    <?php
        $Servicios->printInIndex();
    ?>
</div>

<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>

