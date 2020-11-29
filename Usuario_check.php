<?php include 'Plantilla/Header.php'; ?>
<?php 
$id_user = $_GET['User_ID'];
$tipo = $_SESSION['perfil'];
$Usuario = new users();
$Mascotas = new pet();
if($tipo == "Administrador"){
    $Usuarios = $Usuario->getUser($id_user);
    $Pets = $Mascotas->getPetByUserID($id_user);
    $Nombre_Completo = $Usuarios[0]['nombre']." ".$Usuarios[0]['apellido_p']." ".$Usuarios[0]['apellido_m'];
    $Medico_ID = $Usuarios[0]['medico_cabecera'];
    // print_r($Pets);
?>

<div class="container">
    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue" id='section-header'>
                <span class="card-title" align='center'>Datos del usuario</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th id='text-standarized'>NOMBRE DEL USUARIO</th>
            <th class="center" id='text-standarized'>MASCOTAS</th>
            <th class="center" id='text-standarized'>MÉDICO ENCARGADO</th>
        </tr>
        <td>
            <?php echo $Nombre_Completo; ?>
        </td>
        <?php
        foreach($Pets as $Mascota):
            $Nombre_Mascota = $Mascota['nombre']; 
            $categoria = $Mascota['categoria'];
            $html = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $categoria);
            $text = "$categoria"; // this has just one backslash, it had to be escaped
            $html = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $text);
            echo "<td class='center'>";
            echo $html . " " . $Nombre_Mascota;
            echo "</td>";
        endforeach;
        ?>
        <td>
            <select disabled name='new_medic'>
                <?php echo $Usuario->selectMedic($Medico_ID) ?>
            </select>
        </td>
    </table>
</div>

<?php } include 'Plantilla/PieDePagina.php'; ?>
</body>
</html>