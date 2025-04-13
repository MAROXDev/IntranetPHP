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


//dates
$startDate = isset($_GET['fi']) ? $_GET['fi'] : '2018-07-22';
$endDate = isset($_GET['ff']) ? $_GET['ff'] : date('Y-m-d');


//title
$items = [
    "Convertirse en agencia Gani",
    "Proveedores Premium Gani",
    "Hoteleria",
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

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$type = "";
if ($id > 0 && $id <= count($items)) {
    $type = $items[$id - 1];
} else {
    exit("Invalid ID.");
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
                  <h2 class="avenir-medium naranja tituloseccion"><?php echo htmlspecialchars($type);  ?></h2>

                  <div class="col-md-12">
                      <form method="GET" action="">
                          <div class="row">
                              <div class="col-md-4">
                                  <input type="date" required value="<?php echo htmlspecialchars($startDate); ?>" name="fi" placeholder="Del: " class="selectfecha avenir-regular form-control">
                              </div>
                              <div class="col-md-4">
                                  <input type="date" required value="<?php echo htmlspecialchars($endDate); ?>" name="ff" placeholder="Al: " class="selectfecha avenir-regular form-control">
                              </div>
                              <!-- Hidden input to preserve 'id' in the URL -->
                              <div style="display:none;">
                                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                              </div>


                              <div class="col-md-4">
                                  <button type="submit" name="bf" placeholder="Buscar" class="selectfecha avenir-regular" style=" color: white; background: orangered;">Buscar</button>
                              </div>
                          </div>

                      </form>

                  </div>


                  <?php
                  $query = "SELECT nombre, fecha, weburl 
          FROM webinnars
          WHERE fecha BETWEEN '$startDate' AND '$endDate'
            AND visible = 'Si'
            AND tipo = '$type'
          ORDER BY fecha DESC";

                  $queryResult = mysqli_query($connection, $query);
                  if($queryResult) {
                      if(mysqli_num_rows($queryResult) > 0) {
                          // Fetch each row from the result set
                          while($item = mysqli_fetch_assoc($queryResult)) {
                              ?>
                              <div class="col-md-6 cuadvideos">
                                  <div class="col-md-12 videocont">
                                      <div class="video">
                                          <center>
                                              <!-- Dynamically set the video URL using the 'weburl' field from the database -->
                                              <iframe width="100%" height="315" src="<?php echo $item['weburl']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" class="bredondeado"></iframe>
                                          </center>
                                      </div>
                                      <div class="infovideo">
                                          <h3 class="avenir-regular titdemo"><?php echo $item['nombre']; ?></h3>
                                          <p class="avenir-regular textdemo"><i class="bi bi-calendar-date-fill"></i> <?php echo $item['fecha']; ?></p>
                                      </div>
                                  </div>
                              </div>
                              <?php
                          }
                      } else {
                              echo '<h4 class="avenir-medium naranja tituloseccion">No webinars found for the selected criteria.</h4>';
                      }
                  } else {
                      echo '<h4 class="avenir-medium naranja tituloseccion">Query failed: ' . mysqli_error($connection) . '</h4>';
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