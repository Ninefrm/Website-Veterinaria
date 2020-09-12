<?php
include "class/class.usuarios.php";

//var_dump($_POST);
$action = "";
    if(isset($_POST['FormID'])){
        //    Register
        if($_POST['FormID'] == "register"){
            $register = new users();
            if($register->addUsers($_POST)){
                $action = "Registered";
                $href = "./Index.php";
            }
        }
    }

?>
<?php
require_once ("Plantilla/Header.php");
?>
<body class="Background_ColorPage">
<div class="row FullPage">
    <div class="col s4"></div>
    <div class="col s4 Background_ColorWhite CenterOnFullPage">
        <div class="col s12">
            <p class="center"> NINE </p>
        </div>
        <div class="col s12 center">
            <p><?php echo $action; ?></p>
            <br>
        </div>
        <div class="col s12 center-align">
            <a class="waves-effect waves-light btn" href="<?php echo $href ?>">Home</a>
        </div>
        <div class="col s12">
            <p></p>
        </div>
    </div>
</div>
</body>
<?php
require_once ("Plantilla/PieDePagina.php");
?>
