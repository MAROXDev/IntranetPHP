<?php



$nombre=$_POST['nombre'];

$destino=$_POST['destino'];

$fecha=$_POST['fecha'];

//$correo=$_POST['correo'];

//$proveedor=$_POST['proveedores'];

//$visible='Si';



//echo $nombre;



// Conexión a la base de datos
$host = "localhost";
$user = "cortega_pueblos";
$pws = "ITCaguascalientes2";
$database = "cortega_pueblosmagicos";

$connection = mysqli_connect($host, $user, $pws, $database);

if (!$connection) {
    die("No se ha podido conectar con el servidor: " . mysqli_connect_error());
}

$insertar="INSERT INTO flyers (nombre_flyer,fecha,destino) VALUES ('".$nombre."','".$fecha."','".$destino."')";

if (mysqli_query($connection, $insertar)) {

    $tool_id = mysqli_insert_id($connection);


    if (isset($_FILES['file-2']) && $_FILES['file-2']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/flyers/'; // Carpeta donde se guardarán las imágenes
        $tempFile = $_FILES['file-2']['tmp_name'];
        $newFileName = $tool_id . '.jpg'; // Guarda la imagen con el ID
        $destinationPath = $uploadDir . $newFileName;

   
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        
        if (move_uploaded_file($tempFile, $destinationPath)) {
            echo '<script>alert("Registro Completo");</script>';
            header("location: flyer_correcto.php");
        } else {
            echo '<script>alert("Error: No se pudo guardar la imagen.");</script>';
            header("location: webinar_error.php");
        }
    } else {
        echo '<script>alert("Registro Completo sin imagen.");</script>';
        header("location: flyer_correcto.php");
    }
} else {
    echo '<script>alert("Error en el Registro, Inténtalo Nuevamente");</script>';
    header("location: webinar_error.php");
}





mysqli_close($connection);

?>



