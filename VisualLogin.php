<?php include 'Plantilla/Header.php'; ?>
<div class="container">

    <form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="login">

        <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input name="correo" id="icon_email" type="text" class="validate">
            <label for="icon_email">Email</label>
        </div>

        <div class="input-field col s12">
            <i class="material-icons prefix">keyboard</i>
            <input name="password" id="icon_password" type="password" class="validate">
            <label for="icon_password">Contraseña</label>
        </div>
        <input required type="submit" value="Ingresar">


        <?php  if(!empty($errores)): ?>
            <ul>
                <?php echo $errores; ?>
            </ul>
        <?php  endif; ?>
    </form>

</div>





</body>

<?php include 'Plantilla/PieDePagina.php'; ?>
</html>