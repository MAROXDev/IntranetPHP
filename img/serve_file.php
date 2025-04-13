<?php
   
    $filePath = $_GET['file']; 
    $fileName = $_GET['name']; 

   
    if (file_exists($filePath)) {
        
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        
        header('Content-Type: ' . mime_content_type($filePath));
        header('Content-Disposition: inline; filename="' . $fileName . '.' . $fileExtension . '"');
        header('Content-Transfer-Encoding: binary');
        
        // Leer el archivo y enviarlo al navegador
        readfile($filePath);
        exit();
    } else {
        echo "El archivo no existe.";
    }
?>
