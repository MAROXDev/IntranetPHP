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
	 echo "No se ha podido encontrar la Tabla";
}
else
{
 //echo "Tabla seleccionada" ;
} 

$consulta="SELECT * from usuarios where user='".$usuario."'";
$resultado=mysqli_query($connection,$consulta);
					
$total=mysqli_num_rows($resultado);

	
	if ($total == '0')
	{
		header("location: http://viajesreveilduleon.com/intranetnativa/acceso.php");
		exit();

		//echo 'aqui si esta';
	}else
	{
		//echo 'apertura exitosa';
	}
?>







<!DOCTYPE html>
<html lang="">
	<head>
		<title>Bienvenido a la Intranet</title>
		<!--***INICIA CABECERA***-->
		<?php
		      require_once('includes/cabecera.php');
		    ?>

        <?php
        require_once ('includes/logeo.php')
        ?>


        <!--***Linking SwiperJS CSS***-->
        <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />

        <link rel="stylesheet" href="css/estilos.css">
	</head>
	<body>

	<!--***INICIA MENÚS***-->
	<?php
		require_once('includes/menus.php');
	?>  
  			

	<!--***INICIA CONTENIDO***-->

		<div class="container text-center contprinc">
		  <div class="row">

		  	<!--***CAROUSEL INICIO***-->
			<div class="col-md-8" style="padding-right: 35px;">
				<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
				  <div class="carousel-indicators">
				    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
				    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
				  </div>
				  <div class="carousel-inner bredondeado">
				    <div class="carousel-item active" data-bs-interval="3000">
				      <img src="img/inicio/slide1.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
				        <h3 class="avenir-bold">Recuperación de comisiones Hoteldo 2025</h3>
				      </div>
				    </div>
				    <div class="carousel-item" data-bs-interval="3000">
				      <img src="img/inicio/slide2.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
				       <h3 class="avenir-bold">Políticas de cancelación Juliatours</h3>
				      </div>
				    </div>
				    <div class="carousel-item" data-bs-interval="3000">
				      <img src="img/inicio/slide3.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
				        <h3 class="avenir-bold">Conoce sobre Imacop</h3>
				      </div>
				    </div>
				  </div>
				  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				    <span class="carousel-control-prev-icon iccarousel" aria-hidden="true"></span>
				    <span class="visually-hidden">Previous</span>
				  </button>
				  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				    <span class="carousel-control-next-icon iccarousel" aria-hidden="true"></span>
				    <span class="visually-hidden">Next</span>
				  </button>
				</div>
			</div>
			<!--***CAROUSEL FIN***-->

			<!--***PRIMERA BARRA LATERAL DERECHA***-->
			<div class="col-md-4 bckgris bredondeado" style="padding: 0; -webkit-box-shadow: 5px 13px 13px -2px rgba(163,161,163,1); -moz-box-shadow: 5px 13px 13px -2px rgba(163,161,163,1); box-shadow: 5px 13px 13px -2px rgba(163,161,163,1);">
				<!--***CLIMA***-->
				<!--<div class="row">
					<div class="col-md-4">
						<img src="img/inicio/clima.png" width="140px">
					</div>-->
					<div class="col-md-12">
						<!--<p class="avenir-regular letragris textbl">
							Consulta el estado del tiempo en cualquier ciudad del mundo
						</p>
					</div>
					<a href="">
						<div class="col-md-12 menuactive">
							<h3 class="avenir-medium textbco algizq">Estado del Tiempo <i class="bi bi-caret-right-fill"></i></h3>
						</div>
					</a>-->
					<div id="ww_7a376ee029e12" v='1.3' loc='auto' a='{"t":"horizontal","lang":"es","sl_lpl":1,"ids":["wl907"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"rgba(255,69,0,1)","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#FFFFFF","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FFFFFF"}'>Más previsiones: <a href="https://oneweather.org/es/seville/25_days/" id="ww_7a376ee029e12_u" target="_blank">Tiempo en Sevilla</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_7a376ee029e12"></script>

					<a href="https://www.meteored.mx/" target="_blank"><p class="naranja montse busclima"><i class="bi bi-search"></i> Buscar Zona</p></a>
				</div>

				<!--***TIPO DE CAMBIO***-->
				<div class="row">
					<div class="col-md-4">
						<img src="img/inicio/tcambio.png" width="140px">
					</div>
					<div class="col-md-8">
						<p class="avenir-regular letragris textbl">
							Comprueba el tipo de cambio en tiempo real
						</p>
					</div>
					<a href="https://www.banamex.com/economia-finanzas/es/mercado-de-divisas/index.html" target="_blank">
						<div class="col-md-12 menuactive">
							<h3 class="avenir-medium textbco algizq">Tipo de Cambio <i class="bi bi-caret-right-fill"></i></h3>
						</div>
					</a>
				</div>

				<!--***TIPO DE CAMBIO***-->
				<div class="row">
					<div class="col-md-4">
						<img src="img/inicio/vuelos.png" width="140px">
					</div>
					<div class="col-md-8">
						<p class="avenir-regular letragris textbl">
							Revisa el estado del vuelo de tu cliente
						</p>
					</div>
					<a href="https://www.flightaware.com/live/" target="_blank">
						<div class="col-md-12 menuactive">
							<h3 class="avenir-medium textbco algizq">Rastreador de Vuelos <i class="bi bi-caret-right-fill"></i></h3>
						</div>
					</a>
				</div>
			
			</div>
		  </div>
		</div>


		<div class="container text-center contprinc">
		  <div class="row">

		  	<!--***IMAGEN AGENTE***-->
			<div class="col-md-8">
				<img src="img/inicio/agente.png" width="80%">
			</div>
			<!--***IMAGEN AGENTE***-->


			<!--***PRIMERA BARRA LATERAL DERECHA***-->
			<div class="col-md-4">
				<!--***MANUAL OPERATIVO***-->
				<div class="col">
					<a href="">
			          <div class="card shadow-sm">
			            <img src="img/inicio/manual.jpg" width="100%">
			            <div class="card-body">
			            	<h3 class="naranja avenir-medium">Manual Operativo</h3>
			              <p class="avenir-regular letragris textbl">Guía básica para conocer algunos usos de la intranet</p>      
			            </div>
			          </div>
		          </a>
		        </div>


		        <!--***MANUAL CORPORATIVO***-->
				<div class="col">
					<a href="">
			          <div class="card shadow-sm">
			            <img src="img/inicio/manual2.jpg" width="100%">
			            <div class="card-body">
			            	<h3 class="naranja avenir-medium">Manual Corporativo</h3>
			              <p class="avenir-regular letragris textbl">Guía para  conocer la esencia de la franquicia GANI VIAJES </p>        
			            </div>
			          </div>
		          </a>
		        </div>
			</div>

		  </div>
		</div>

		<!--***CARRUSEL NOTICIAS TURÍSTICAS***-->
		<div class="col-md-12" style="margin-top: 120px; margin-bottom: 120px;">
				<rssapp-carousel id="jX1gnEF54QKK91m3"></rssapp-carousel><script src="https://widget.rss.app/v1/carousel.js" type="text/javascript" async></script>

			</div>


			<div class="col-md-12" style="margin-top: 120px; margin-bottom: 120px; padding-left: 5%; padding-right: 5%;">

				<rssapp-imageboard id="jX1gnEF54QKK91m3"></rssapp-imageboard><script src="https://widget.rss.app/v1/imageboard.js" type="text/javascript" async></script>				
			</div>
			<iframe style="margin-top: 120px;" width="100%" height="450" src="https://www.youtube.com/embed/TkZBns3Rcvo?si=h1WyNV_iUZxO-9R2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

		<!--***FLYERS***-->
    <div class="container" id="custom-cards">
        <h2 class="pb-2 border-bottom naranja avenir-medium">Flyers Marketing</h2>

        <div class="body-container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/playas.jpg');">
                        <a href="flyersplayas.php">
                            <div class="text-container">
                                <h3 class="user-name avenir-regular letragris">Playas</h3>
                            </div>
                        </a>
                    </li>
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/europa.jpg');">
                        <div class="text-container">
                            <h3 class="user-name avenir-regular letragris">Europa</h3>
                        </div>
                    </li>
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/cuba.jpg');">
                        <div class="text-container">
                            <h3 class="user-name avenir-regular letragris">Cuba</h3>
                        </div>
                    </li>
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/playas.jpg');">
                        <a href="flyersplayas.php">
                            <div class="text-container">
                                <h3 class="user-name avenir-regular letragris">Playas</h3>
                            </div>
                        </a>
                    </li>
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/europa.jpg');">
                        <div class="text-container">
                            <h3 class="user-name avenir-regular letragris">Europa</h3>
                        </div>
                    </li>
                    <li class="card-item swiper-slide" style="background-image: url('img/inicio/cuba.jpg');">
                        <div class="text-container">
                            <h3 class="user-name avenir-regular letragris">Cuba</h3>
                        </div>
                    </li>
                </ul>
                <!-- Pagination and Navigation buttons -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>


    <!--***ACCESOS RAPIDOS***-->
		<div class="container text-center contprinc">
		  <div class="row">
				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a1.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Temporalidad de Cruceros
						</p>
					</a>
				</div>

				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a2.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Check list pasajeros
						</p>
					</a>
				</div>

				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a3.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Alfabeto aeronáutico
						</p>
					</a>
				</div>

				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a4.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Descuentos Imacop
						</p>
					</a>
				</div>

				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a5.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Diccionario turístico
						</p>
					</a>
				</div>

				<div class="col-md-2">
					<a href="">
						<img src="img/inicio/a6.jpg" width="100%">
						<p class="avenir-regular letragris textbl">
							Claves de aeropuertos 
						</p>
					</a>
				</div>
		   </div>
		</div>

		<!--***INICIA FOOTER***-->
		<?php
			require_once('includes/footer.php');
		?>


		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!--***Swiper JS***-->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!--***INITIALIZE SWIPER***-->
        <script src="scripts/swiper.js"></script>
	</body>
</html>

<!--*** COLOCAR TÍTULO DE COMUNICADOS*** -->