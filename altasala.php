<?php
$enlace = $_POST['enlace'];
$nombre = $_POST['nombre'];
$tipo   = $_POST['tipo'];
$fecha  = $_POST['fecha'];
$unidad = $_POST['unidad'];

$host = "localhost";
$user = "cortega_pueblos";
$pws  = "ITCaguascalientes2";

$connection = mysqli_connect($host, $user, $pws);
if (!$connection) {
    echo "No se ha podido conectar con el servidor: " . mysqli_connect_error();
    exit;
}

$db = mysqli_select_db($connection, "cortega_pueblosmagicos");
if (!$db) {
    echo "No se ha podido encontrar la Tabla";
    exit;
}

$insertar = "INSERT INTO sala_de_aprendizaje (titulo,fecha_creacion,tipo,unidad,enlace) VALUES ('".$nombre."','".$fecha."','".$tipo."','".$unidad."','".$enlace."')";
if (mysqli_query($connection, $insertar)) {

    // Obtener el id generado para el nuevo registro
    $newId = mysqli_insert_id($connection);

    // Si el tipo es "Documento", procesamos la subida del archivo
    if ($tipo == "Documento") {
        $uploadDir = 'files/sala';
        $newDocument = $_FILES['file-3'] ?? null;

        if ($newDocument && $newDocument['error'] === UPLOAD_ERR_OK) {

            // Buscar y eliminar cualquier archivo existente con este id (cualquier extensión)
            $pattern = $uploadDir . '/' . $newId . '.*';
            $existingFiles = glob($pattern);
            if ($existingFiles !== false && !empty($existingFiles)) {
                foreach ($existingFiles as $existingFile) {
                    if (file_exists($existingFile)) {
                        unlink($existingFile);
                    }
                }
            }

            $tempFile = $newDocument['tmp_name'];
            // Obtener la extensión real del archivo subido
            $extension = pathinfo($newDocument['name'], PATHINFO_EXTENSION);
            // Generar el nuevo nombre del archivo usando el id y la extensión obtenida
            $newFilename = $newId . '.' . $extension;
            $destination = $uploadDir . '/' . $newFilename;

            // Asegurarse de que el directorio de subida exista
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Mover el archivo subido a la ubicación final
            if (!move_uploaded_file($tempFile, $destination)) {
                die('Error: No se pudo cargar el documento.');
            }

            // Establecer permisos para el archivo subido
            chmod($destination, 0644);
        }
    }

    echo '<script>alert("Registro Completo");</script>';
    header("Location: sala_correcto.php");
} else {
    echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';
    header("Location: sala_error.php");
}

mysqli_close($connection);
?>




