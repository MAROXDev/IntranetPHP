<?php

$id=$_GET['id'];

$nombre=$_POST['nombre'];

$fecha=$_POST['fecha'];

$descripcion=$_POST['descripcion'];

$link=$_POST['link'];

$link_aplicacion = $_POST['link_aplicacion'];

$origin = $_POST['origin']; 


//$proveedor=$_POST['proveedoresedit'];

//$visible='Si';


//*********************SUBE FOTO

// Define the upload directory
$uploadDir = 'img/herramientas'; 

// Existing image path (with .jpg extension)
$currentImage = "$uploadDir/{$id}.jpg";

// Uploaded file from the form
$newImage = $_FILES['file-3'] ?? null;

// If no new file is uploaded, keep the current image
$imagePath = (file_exists($currentImage)) ? $currentImage : null;

// Check if a new file was uploaded
if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
    $tempFile = $newImage['tmp_name'];          // Temporary uploaded file
    $newFilename = $id . '.jpg';               // New file name (use ID)
    $imagePath = "$uploadDir/$newFilename";    // Final file path

    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Validate the uploaded file type (allow JPG, PNG, and WebP)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array(mime_content_type($tempFile), $allowedTypes)) {
        die('Error: Solo se permiten imágenes en formato JPG, PNG o WebP.');
    }

    // Validate the file size (limit: 2MB)
    if ($newImage['size'] > 2 * 1024 * 1024) {
        die('Error: La imagen excede el tamaño máximo permitido (2MB).');
    }

    // Move the uploaded file to the correct directory
    if (!move_uploaded_file($tempFile, $imagePath)) {
        die('Error: No se pudo cargar la nueva imagen.');
    }

    // Optional: Set permissions for the uploaded file
    chmod($imagePath, 0644);
}










//$weburl=$_POST['weburl'];

//$visible=$_POST['visible'];
foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}




$host="localhost";

$user="cortega_pueblos";

$pws="ITCaguascalientes2";







$connection=mysqli_connect($host,$user,$pws);



if(!$connection) 

{

    echo "No se ha podido conectar con el servidor" . mysql_error();

}

else

{

 echo "Hemos conectado al servidor <br>" ;

}



$db = mysqli_select_db($connection,"cortega_pueblosmagicos");



if (!$db)

{

	 echo "No se ha podido encontrar la Tabla";

}

else

{

 echo "Tabla seleccionada" ;

} 

$insertar="UPDATE herramientas SET descripcion='".$descripcion."',nombre='".$nombre."',fecha='".$fecha."',link='".$link."',link_aplicacion='".$link_aplicacion."' WHERE id='".$id."'";

//$insertar="INSERT INTO usuarios (id_user,nombre,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('1','".$nombre."','".$contrasena."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$tipo2."')";



//$insertar="INSERT INTO usuarios (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';


	// Check if the origin exists and decide the redirection
if (strpos($origin, 'adminherramientas.php') !== false) {
    // If it comes from admindirectorio.php, redirect to a specific file
    header("Location: mod_herr_correcto.php");
} elseif (strpos($origin, 'herramientas.php') !== false) {
    // If it comes from directorio.php, redirect back to directorio
    header("Location: herramientas.php");
} else {
    // Fallback redirection if the origin is not identified
    header("Location: herramientas.php");
}
exit;


}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: mod_fly_error.php");

}



mysqli_close($connection);

?>



