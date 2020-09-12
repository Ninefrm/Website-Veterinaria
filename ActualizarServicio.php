
<?php

if($_SERVER['REQUEST_METHOD']=='POST') {
    //POST
    $nombre_servicio = $_POST['nombre_servicio'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];
    $id_servicio = $_POST['id_servicio'];

    /* GET File Variables */
    $tmpName = $_FILES['attachment']['tmp_name'];
    $fileType = $_FILES['attachment']['type'];
    $fileName = $_FILES['attachment']['name'];
    $target_dir = "Upload/Libros/";
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // $contraseña = hash('sha512', $contraseña);

    $servername = "localhost";
    $username = "root";
    $passwordb = "";
    $mydb = "ninefrmx_veterinaria";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $passwordb);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if (empty($tmpName)) {
        $update = $conn->prepare("UPDATE servicio SET nombre = '$nombre_servicio',
codigo = '$codigo', descripcion = '$descripcion', costo = '$costo', stock = '$stock', 
                    imagen = '$imagen' WHERE id_servicio = '$id_servicio'");
        $update->execute();
    } else {
        if (file($tmpName)) {
            //EXISTE?
            if (file_exists($target_file)) {
                echo '<script language="javascript">';
                echo 'alert(Sorry, file already exists.")';
                echo '</script>';
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo '<script language="javascript">';
                echo 'alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")';
                echo '</script>';
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo '<script language="javascript">';
                echo 'alert("Sorry, your file was not uploaded.")';
                echo '</script>';
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {

                    echo '<script language="javascript">';
                    echo 'alert("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.")';
                    echo '</script>';
                    //Conexión
                    //
                    $update = $conn->prepare("UPDATE servicio SET nombre = '$nombre_servicio',
codigo = '$codigo', descripcion = '$descripcion', costo = '$costo', stock = '$stock', 
                    imagen = '$imagen' WHERE id_servicio = '$tmpName'");
                    $update->execute();

                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Sorry, there was an error uploading your file.")';
                    echo '</script>';
                }
            }
        }
    }
}

?>

<script>
    alert("SERVICIO ACTUALIZADO.");
    window.location.replace("Index.php");
</script>