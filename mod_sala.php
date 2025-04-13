<?php 
$id = $_GET['id'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$unidad = $_POST['unidad'];
$tipo = $_POST['tipo'];
$enlace = $_POST['enlace']; // Agregado para capturar el contenido del textarea

// Print all POST data (for debugging)
foreach($_POST as $campo => $valor){
  echo "- " . $campo . " = " . $valor;
}

$host = "localhost";
$user = "cortega_pueblos";
$pws  = "ITCaguascalientes2";

$connection = mysqli_connect($host, $user, $pws);
if(!$connection) {
    echo "No se ha podido conectar con el servidor: " . mysqli_connect_error();
} else {
    echo "Hemos conectado al servidor <br>";
}

$db = mysqli_select_db($connection, "cortega_pueblosmagicos");
if (!$db) {
    echo "No se ha podido encontrar la Tabla";
} else {
    echo "Tabla seleccionada";
} 

// Se agrega la actualización del campo "enlace"
$insertar = "UPDATE sala_de_aprendizaje SET 
                titulo = '" . $nombre . "',
                tipo = '" . $tipo . "',
                fecha_creacion = '" . $fecha . "',
                unidad = '" . $unidad . "',
                enlace = '" . $enlace . "'
             WHERE id = '" . $id . "'";

if (mysqli_query($connection, $insertar)) {

    // Si el tipo es "Documento", procesamos la subida del archivo
    if($tipo == "Documento") {
        // Directorio de subida para documentos
        $uploadDir = 'files/sala';
        $newDocument = $_FILES['file-3'] ?? null;
        
        if ($newDocument && $newDocument['error'] === UPLOAD_ERR_OK) {
            
            // Buscar y eliminar cualquier archivo existente con este id (cualquier extensión)
            $pattern = $uploadDir . '/' . $id . '.*';
            $existingFiles = glob($pattern);
            if ($existingFiles !== false && !empty($existingFiles)) {
                foreach ($existingFiles as $existingFile) {
                    if (file_exists($existingFile)) {
                        if (!unlink($existingFile)) {
                            echo "No se pudo eliminar: $existingFile";
                        }
                    }
                }
            }
            
            $tempFile = $newDocument['tmp_name'];
            $extension = pathinfo($newDocument['name'], PATHINFO_EXTENSION);
            $newFilename = $id . '.' . $extension;
            $destination = "$uploadDir/$newFilename";
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            if (!move_uploaded_file($tempFile, $destination)) {
                die('Error: No se pudo cargar el documento.');
            }
            
            chmod($destination, 0644);
        }
    }

    echo '<script>alert("Registro Completo");</script>';
    header("Location: mod_sala_correcto.php");
} else {
    echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';
    header("Location: mod_sala_error.php");
}

mysqli_close($connection);
?>

