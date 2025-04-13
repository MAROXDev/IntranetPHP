<?php
// pdfviewer.php

// Verifica que se hayan pasado los parámetros 'file' y 'title'
if (isset($_GET['file']) && isset($_GET['title'])) {
    $file  = urldecode($_GET['file']);
    $title = urldecode($_GET['title']);
} else {
    die("Parámetros inválidos.");
}

// Extrae el ID a partir de la ruta del archivo.
// Se asume que $file tiene el formato "files/sala/{id}.pdf"
$id = pathinfo($file, PATHINFO_FILENAME);

// Si se pasa view=1 en la URL, se sirve el contenido del PDF
if (isset($_GET['view']) && $_GET['view'] == '1') {
    // Asegurarse de que el archivo esté dentro de la carpeta permitida
    $allowedDir = realpath("files/sala/");
    $realPath   = realpath($file);
    if (!$realPath || strpos($realPath, $allowedDir) !== 0) {
        die("Acceso denegado.");
    }
    if (!file_exists($realPath)) {
        die("El archivo no existe.");
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $title . '.pdf"');
    header('Content-Location: ' . $title . '.pdf');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    readfile($realPath);
    exit;
} else {
    // Genera la URL amigable para el modo "view"
    $friendlyUrl = "gani/" . $id . "/" . urlencode($title) . ".pdf?view=1";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <!-- El título de la pestaña se establece con el valor de $title -->
        <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
        <style>
            html, body { margin: 0; padding: 0; height: 100%; }
            embed { width: 100%; height: 100%; border: none; }
        </style>
    </head>
    <body>
        <!-- Se incrusta el PDF usando la URL amigable -->
        <embed src="<?php echo $friendlyUrl; ?>" type="application/pdf">
    </body>
    </html>
    <?php
}
?>

