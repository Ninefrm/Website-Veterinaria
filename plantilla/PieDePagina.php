<br> </br>
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            <a id='reference' target="_blank": href="http://www.facebook.com/MAXIMILIANOFRM" title="NINEFRM">Veterinaria</a>
            <p id="text-standarized">Fonseca Romero, Samuel Maximiliano.</p>

            <a class="grey-text text-lighten-4 right" href="#!" id="text-standarized"><p id="text-standarized">SESIÓN: <?php
                    if (!empty($_SESSION['user_id'])){
                        print_r($_SESSION['nombre']);
                    }
                    else{
                        echo "SIN SESIÓN ACTIVA";
                    }
                    ?></p></a>

        </div>
    </div>
</footer>
