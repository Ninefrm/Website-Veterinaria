<?php include 'Plantilla/Header.php'; ?>
<?php

$id_usr = $_SESSION['user_id'];
$tipo = $_SESSION['perfil'];
$Usuario = new users();


if($tipo == "Cliente" or $tipo == "Medico"){
    $Usuarios = $Usuario->getUser($id_usr);
}
if($tipo == "Administrador"){
    $Usuarios = $Usuario->getUsersToView();
}
?>


<div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text blue" id='section-header'>
                <span class="card-title" align='center'>Usuarios</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th id='text-standarized'>NOMBRE DEL USUARIO</th>
            <th class="center" id='text-standarized'>NÚMERO DE MASCOTAS</th>
            <th class="center" id='text-standarized'>MÉDICO ENCARGADO</th>
            <th class="center" colspan="2" id='text-standarized'>ACCIONES</th>
        </tr>
        </thead>
        <?php foreach ($Usuarios as $Sql): 
            $id_cliente = $Sql['id_cliente'];
            $Nombre = $Sql['NOMBRE_COMPLETO'];
            $Mascotas = $Sql['No_MASCOTAS'];
            $Medico = $Sql['MEDICO_CABECERA'];
            $Medico_ID = $Sql['medico_cabecera'];
        ?>

            <tr>
                <td><?php echo $Nombre ?></td>
                <td class="center"><?php echo $Mascotas ?></td>
                <td>
                <form action='Action.php' method='post'>
                    <input name="FormID" value="Change_Medic" hidden>
                    <input name="UserID" value="<?php echo $id_cliente ?>" hidden>
                    <select name='new_medic'>
                        <?php echo $Usuario->selectMedic($Medico_ID) ?>
                    </select>
                    </td>
                    <td class="center">
                        <button class="waves-effect waves-light btn-small blue"><i class="material-icons">save</i></button>
                    </td>
                </form>
                <td class="center">
                    <button class="waves-effect waves-light btn-small green"><i class="material-icons">visibility</i></button>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <br>
    <br>

</div>

<?php include 'Plantilla/PieDePagina.php'; ?>

</body>

</html>