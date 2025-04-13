<!DOCTYPE html>
<html lang="">
	<head>
		<title>Directorio Gani</title>
		<!--***INICIA CABECERA***-->
		<?php
		      require_once('includes/cabecera.php');
		    ?>
	</head>
	<body>
	<!--***INICIA Logeo***-->
	<?php
		require_once('includes/logeo.php');
	?>
	<!--***INICIA MENÚS***-->
	<?php
		require_once('includes/menus.php');
	?>  
  			

	<!--***INICIA CONTENIDO***-->		
		 <div class="row">
		 	<img src="img/directorio/portada.jpg" width="100%">
		  	<!--***BOTÓNES PROVEEDORES***-->
			<div class="container text-center contbtnprov">
			  <div class="row">
					<div class="col-md-6">
						<a href="directorio.php">
							<center>
								<div class="col-md-12 btndirectorio">
									<h3 class="avenir-medium">Gani Corporativo</h3>
								</div>
							</center>							
						</a>
					</div>

					<div class="col-md-6">
						<a href="directorioprov.php">
							<center>
								<div class="col-md-12 btndirectorio menuactive">
									<h3 class="avenir-medium">Proveedores</h3>
								</div>
							</center>
						</a>
					</div>
								
			   </div>
			</div>


			<!--***INICIA DIRECTORIO***-->
			<div class="container contdirectorio">
			  <div class="row">
					<div class="col-md-6">						
							<div class="col-md-12 cuadirectorio">
								<h2 class="avenir-bold naranja">Bcortes</h2>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-person icondirectorio"></i>
									Marlon Garcia - Sistemas, Marketing
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-telephone icondirectorio"></i>
									+52 449 257 59 64
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-envelope icondirectorio"></i>
									sistemas@gani.com.mx
								</p>
							</div>
					</div>	


					<div class="col-md-6">						
							<div class="col-md-12 cuadirectorio">
								<h2 class="avenir-bold naranja">Hoteldo</h2>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-person icondirectorio"></i>
									Roxana Vega - Gerente de Ventas
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-telephone icondirectorio"></i>
									+52 551 486 92 05
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-envelope icondirectorio"></i>
									ventas.ganiviajes@gmail.com
								</p>
							</div>
					</div>	

					<div class="col-md-6">						
							<div class="col-md-12 cuadirectorio">
								<h2 class="avenir-bold naranja">Imacop</h2>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-person icondirectorio"></i>
									Beatriz Rodríguez - Altas y capacitaciones
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-telephone icondirectorio"></i>
									+52 449 196 13 67
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-envelope icondirectorio"></i>
									ventas.triptequila@gmail.com
								</p>
							</div>
					</div>

					<div class="col-md-6">						
							<div class="col-md-12 cuadirectorio">
								<h2 class="avenir-bold naranja">Julia Tours</h2>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-person icondirectorio"></i>
									Beatriz Rodríguez - Altas y capacitaciones
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-telephone icondirectorio"></i>
									+52 449 196 13 67
								</p>
								<p class="avenir-regular descprov txtdirectorio">
									<i class="bi bi-envelope icondirectorio"></i>
									ventas.triptequila@gmail.com
								</p>
							</div>
					</div>

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