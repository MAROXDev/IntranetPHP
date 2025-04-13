<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title id="page-title">Visor PDF</title>
  <!-- Incluye los archivos necesarios de PDF.js -->
  <script src="pdfjs/build/pdf.js"></script>
  <style>
    html, body { margin: 0; height: 100%; }
    #pdf-container { height: calc(100% - 50px); } /* Ejemplo para dejar espacio al encabezado */
    #header { height: 50px; background: #f0f0f0; display: flex; align-items: center; padding: 0 20px; font-size: 18px; }
  </style>
</head>
<body>
  <div id="header">Documento: <span id="doc-title"></span></div>
  <div id="pdf-container"></div>
  <script>
    // Función para obtener parámetros de la URL
    function getQueryParam(param) {
      var urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    var file = decodeURIComponent(getQueryParam('file'));
    var title = decodeURIComponent(getQueryParam('title'));

    // Establecer el título de la pestaña y en la cabecera
    document.title = title;
    document.getElementById('doc-title').innerText = title;

    // Configurar PDF.js para cargar y renderizar el PDF
    var loadingTask = pdfjsLib.getDocument(file);
    loadingTask.promise.then(function(pdf) {
      // Renderiza la primera página como ejemplo
      pdf.getPage(1).then(function(page) {
        var scale = 1.5;
        var viewport = page.getViewport({ scale: scale });

        // Crear un canvas para renderizar la página
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        document.getElementById('pdf-container').appendChild(canvas);

        var renderContext = {
          canvasContext: context,
          viewport: viewport
        };
        page.render(renderContext);
      });
    }).catch(function (error) {
      console.error('Error al cargar el PDF: ', error);
    });
  </script>
</body>
</html>
