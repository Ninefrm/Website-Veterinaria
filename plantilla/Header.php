<!DOCTYPE html>
<html lang="en">
<?php session_start();
include_once 'class/class.productos.php';
include_once 'class/class.servicios.php';
include_once 'class/class.carrito.php';
include_once 'class/class.usuarios.php';
include_once 'class/class.mascota.php';
include_once 'class/class.agenda.php';
include_once 'class/class.pagar.php';

//echo $_SERVER['REQUEST_URI'];
?>
<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php


if (isset($_SESSION['user_id'])){
    $id_usr = $_SESSION['user_id'];
    $perfil = $_SESSION['perfil'];
    $Carrito = new carrito();
    $carrito = $Carrito->getCarrito($id_usr);
}
else{
    $id_usr = "0";
    $Carrito = new carrito();
    $carrito = $Carrito->getCarrito($id_usr);
}



?>
<head>
    <meta charset="UTF-8">
    <title>Veterinaria</title>
    <link rel="stylesheet" href="css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--    <link rel="stylesheet" href="CSS/Estilos.css">-->
    <link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/WebIcon.png">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Import materialize.css-->
    <script src="js/materialize.min.js"></script>
    <link type="text/CSS" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<header>
    <ul id="dropdown1" class="dropdown-content">

        <?php
        if($id_usr != 0){
            ECHO "<li class=\"divider\"></li>
            <li><a href=\"Compras_view.php\"><i class=\"material-icons\">store</i>Compras</a></li>
            <li class=\"divider\"></li>
            
            ";
            ECHO "<li class=\"divider\"></li>
            <li><a href=\"Mascota_view.php\"><i class=\"material-icons\">pets</i>Mascotas</a></li>
            <li class=\"divider\"></li>
            
            ";
            if($perfil == "Administrador"){
                Echo "<li><a href=\"Producto_edit.php\" title=\"Agregar Producto\"><i class=\"material-icons\">library_add</i>Agregar Producto</span></div></a></li>
        ";
                Echo "<li><a href=\"AgregarServicio.php\" title=\"Agregar Servicio\"><i class=\"material-icons\">library_add</i>Agregar Servicio</span></div></a></li>
            <li class=\"divider\"></li>
        ";
            }
        }else{
            Echo "<li><a href=\"Usuarios_add.php\" title=\"Nuevo cliente\"><i class=\"material-icons\">assignment_ind</i>Nuevo cliente</span></div></a></li>
        ";
        }

        ?>
        <?php
        if ($id_usr != 0){
            Echo "<li><a href=\"cerrar.php\" title=\"Cerrar Sesion\"><i class=\"material-icons\">power_settings_new</i>Cerrar Sesion</span></div></a></li>
                        ";
        }else{
            Echo "<li><a href=\"Login.php\" title=\"Iniciar Sesion\"><i class=\"material-icons\">perm_identity</i>Iniciar Sesion</a></li>";
        }

        //        ?>
        <!--        <li><a href="Login.php" title="Iniciar Sesion" class="center-align"><i class="material-icons right">perm_identity</i> Iniciar Sesion </a></li>-->
        <!--        <li><a href="cerrar.php" title="Cerrar Sesion" class="center-align"><i class="material-icons right">power_settings_new</i> Cerrar Sesion </a></li>-->
    </ul>
    <nav>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a href="Index.php" class="brand-logo">Veterinaria</a>


                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <div class="center left">
                        <?php
                        if ($id_usr != 0){
                            $suma = count($carrito) ;
                            Echo "<li><a href=\"Carrito_view.php\"><i class=\"material-icons\">shopping_cart</i><span class=\"new badge green\" data-badge-caption=\"En carrito\">$suma</span></div></a></li>
                        ";
                        }else{

                        }

                        ?>
                    </div>
                    <div class="center right">
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">view_module</i></a></li>

                    </div>
                    <div class="center">
                        <?php

                        if($_SERVER['REQUEST_URI'] == '/website-veterinaria/Buscar.php'){

                        }else{
                            Echo "<form action=\"Buscar.php\" method=\"post\" id=\"search\">
                                <div class=\"input-field inline\">
                                    <input name=\"busqueda\" id=\"busqueda\" type=\"text\" class=\"validate\">
                                    <label style='font-size:13px !important' for=\"busqueda\">Nombre, descripción, codigo.</label>
                                </div>
                                <form action=\"Buscar.php\" method=\"post\" id=\"search\">
                                    <button class=\"btn-floating btn-large waves-effect waves-light blue\" type=\"submit\" form=\"search\"><i class=\"material-icons\">search</i></button>
                                </form>
                            </form>";
                        }
                        ?>

                    </div>

                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="Buscar.php"><i class="material-icons">search</i>Buscador</a></li>

            <?php
            if($id_usr != 0){
                ECHO "<li class=\"divider\"></li>
            <li><a href=\"VerCompras.php\"><i class=\"material-icons\">store</i>Compras</a></li>
            <li class=\"divider\"></li>
            ";
                ECHO "
            <li><a href=\"Mascota_view.php\"><i class=\"material-icons\">pets</i>Mascotas</a></li>
            
            ";
                if($perfil == "Administrador"){
                    Echo "<li><a href=\"Producto_edit.php\" title=\"Agregar Libro\"><i class=\"material-icons\">library_add</i>Agregar producto</span></div></a></li>

        ";
                }
            }else{
                Echo "<li><a href=\"Usuarios_add.php\" title=\"Nuevo cliente\"><i class=\"material-icons\">assignment_ind</i>Nuevo cliente</span></div></a></li>
        ";
            }

            ?>

            <?php
            if ($id_usr != 0){
                Echo "<li><a href=\"Carrito_view.php\"><i class=\"material-icons\">shopping_cart</i><span class=\"new badge green\" data-badge-caption=\"En carrito\">$suma</span></div></a></li>
                        ";
            }else{

            }

            ?>
            <?php
            if ($id_usr != 0){
                Echo "<li><a href=\"cerrar.php\" title=\"Cerrar Sesion\"><i class=\"material-icons\">power_settings_new</i>Cerrar Sesion</span></div></a></li>
                        ";
            }else{
                Echo "<li><a href=\"Login.php\" title=\"Iniciar Sesion\"><i class=\"material-icons\">perm_identity</i>Iniciar Sesion</a></li>";
            }

            //        ?>
        </ul>

    </nav>
    <br><br><br><br>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.AutoInit();
    });
</script>
