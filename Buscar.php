 <?php include 'Plantilla/Header.php'; ?>


<a class='waves-effect waves-light btn-large' onclick="goBack()" id='section-header'><i class="material-icons" id='icons-standarized'>arrow_back</i></a>
<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
include_once 'class/class.database.php';

$db = new database();
$result = $db->query("SELECT * FROM producto WHERE nombre LIKE '%$_POST[busqueda]%' UNION 
                      SELECT * FROM servicio WHERE nombre LIKE '%$_POST[busqueda]%' ")->fetchAll();


echo '<div>';

foreach ($result as $product):

    ECHO "
    <div class='card' style='width: 18rem; margin-left: 50px;float: left;height: 18rem;'>
        <img src='upload/$product[imagen]' class='card-img-top' alt='...' height='250px'>
        <div class='card-body' id='section-header' style='padding: 20px;height: 200px;'>
            <h2 class='card-title'>$product[nombre]</h2>
            <p class='card-text'>$product[descripcion]</p>
        </div>
    </div>";
    
endforeach;

echo '</div>';

?>

<br><br>
<div>
<br><br>

</div>