<?php

session_start();
$usuario=$_SESSION['usuario'];

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
    //echo "Hemos conectado al servidor <br>" ;
}

$db = mysqli_select_db($connection,"cortega_pueblosmagicos");

if (!$db)
{
    echo "No se ha podido encontrar la Db";
}
else
{
    //echo "Tabla seleccionada" ;
}


?>



<!DOCTYPE html>
<html lang="">
	<head>
		<title>Capacitaciones Gani</title>
		<!--***INICIA CABECERA***-->
		<?php
		      require_once('includes/cabecera.php');
		    ?>
	</head>
	<body>

    <!--***INICIA Logeo***-->
    <?php
    require_once ('includes/logeo.php');
    ?>

	<!--***INICIA MENÚS***-->
	<?php
		require_once('includes/menus.php');
	?>    			
	<!--***INICIA CONTENIDO***-->		
		 <div class="row">
		 			  	
			<!--***INICIA CAPACITACIONES***-->
			<div class="container text-center contcorporativo">
			  <div class="row">
                  <h2 class="avenir-medium naranja tituloseccion">Webinars, Demos y Capacitaciones</h2>
                  <div class="col-md-12">
                                    <a data-bs-toggle="modal" data-bs-target="#agregarmodulo">
                                        <div class="btnadmagregar" style="margin-left: 80%; margin-bottom: 45px;">
                                            Agregar Módulo <i class="bi bi-plus-circle-fill"></i> 
                                        </div>
                                    </a>
                                </div>  
                  <?php
                  $types = [
                      "Convertirse en Agencia",
                      "Proveedores Premium Gani",
                      "Hotelerías",
                      "Nacionales",
                      "Estados Unidos",
                      "Sudamérica",
                      "Europa",
                      "Navieras",
                      "Seguros",
                      "Eventos",
                      "Vuelos",
                      "Otros Destinos"
                  ];
                  foreach ($types as $index => $item)
                  {
                      $id = $index +1 ;
                      echo '
                          <div class="col-md-4">
                            <center>
                                    <div class="col-md-12 cuadherramientas">
                                        <img src="img/capacitaciones/' . $id . '.jpg" class="imgherramientas">
                                        <a href="democomoseragencia.php?id=' . $id . '">
                                                <div class="btnnaranjcapa avenir-medium">
                                                    ' . $item . '
                                                </div>
                                        </a>
                                    </div>
                            </center>
                        </div>
                        ';
                  }
                  ?>

			   </div>
			</div>

		  </div>



		<!--***INICIA FOOTER***-->
		<?php
			require_once('includes/footer.php');
		?>

		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>