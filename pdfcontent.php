<?php
// pdfcontent.php
if (isset($_GET['file']) && isset($_GET['title'])) {
    $filePath = urldecode($_GET['file']);
    $title = urldecode($_GET['title']);

    // Validar que el archivo esté dentro de la carpeta permitida
    $allowedDir = realpath("files/sala/");
    $realPath = realpath($filePath);
    if (!$realPath || strpos($realPath, $allowedDir) !== 0) {
        die("Acceso denegado.");
    }

    if (!file_exists($realPath)) {
        die("El archivo no existe.");
    }

    // Envía las cabeceras para que se abra inline y se sugiera el nombre $title.pdf
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $title . '.pdf"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    readfile($realPath);
    exit;
} else {
    die("Parámetros no válidos.");
}
?>


