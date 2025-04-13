	<?php 

					session_start();
					
					$usuario=$_SESSION['usuario'] ;
				
					//print_r($usuario);
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

					$consulta="SELECT * from usuarios where user='".$usuario."' ";
					$resultado=mysqli_query($connection,$consulta);
					$colum = mysqli_fetch_array($resultado);
					$agencia=str_replace(' ', '', $colum['agencia']) ;
					$contra=$colum['psw'];
					$correo=$colum['correo'];
					$id_user=$colum['id'];
					
					



					 ?>





<!DOCTYPE html>
<html lang="">
	<head>
		<title>Corporativo Gani</title>
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
		 	<img src="img/corporativo/portada.jpg" width="100%">
		  	
			<!--***INICIA CORPORATIVO***-->
			<div class="container contcorporativo">
			  <div class="row">
			  	<center>
			  		<h2 class="avenir-medium naranja tituloseccion">Identidad Corporativa</h2>
			  	</center>
			  	<!--*******LOGO AGENCIAS*******-->
					<div class="col-md-4">	
						<a data-bs-toggle="modal" data-bs-target="#logomodal" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/1.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Logotipo</h3>							
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL LOGO*******-->
			<div class="modal fade" id="logomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Logo Corporativo</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php  
			      				 echo '<img src="img/agencias/'.$agencia.'/logo_most.jpg" width="90%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       	<div class="col-md-4">
			       		<?php  
			       		echo '
			       		<a href="img/agencias/'.$agencia.'/logo.pdf" download="Logo PDF">';
			       		?>
							<div class="btnpdf nunito">
								PDF
							</div>
						</a>
			       	</div>

			       	<div class="col-md-4">
			       		<?php echo' 
						<a href="img/agencias/'.$agencia.'/logo.jpg" download="Logo JPG">';
						?>	
							<div class="btnword nunito">
								JPG
							</div>
						</a>									
					</div>

			       	<div class="col-md-4">
			       		<?php echo' 
						<a href="img/agencias/'.$agencia.'/logo.png" download="Logo PNG Sin Fondo">';
							?>
							<div class="btnword nunito">
								PNG
							</div>
						</a>									
					</div>
			        
			      </div>
			      
			    </div>
			  </div>
			</div>

			<!--******* HOJA MEMBRETADA*******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#hojamembretada" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/2.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Hoja Membretada</h3>
								</div>
							</div>
						</a>
					</div>	

			<!--******* VENTANA MODAL HOJA MEMBRETADA*******-->
			<div class="modal fade" id="hojamembretada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Hoja Membretada</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php 
			      				echo '<img src="img/agencias/'.$agencia.'/membrete.jpg" width="80%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       <div class="col-md-6">							
			       	<?php  
						echo '<a href="img/agencias/'.$agencia.'/membrete.pdf" download="Membrete Editable">';
					?>	
							<div class="btnpdf nunito">
								Descargar PDF
							</div>
						</a>								
					</div>

			       	<div class="col-md-6">					
			       	<?php  					
						echo '<a href="img/agencias/'.$agencia.'/membrete.docx" download="Membrete para Imprimir">';
					?>	
							<div class="btnword nunito">
								Descargar Word
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>

			<!--******* FIRMA ELECTRÓNICA *******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#firmamodal" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/3.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Firma Electrónica</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL FIRMA ELECTRÓNICA*******-->
			<div class="modal fade" id="firmamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Firma Electrónica</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '<img src="img/agencias/'.$agencia.'/'.$usuario.'firma.jpg" width="80%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">			       
			       	<div class="col-md-12">										
			       		<?php
						 echo '<a href="img/agencias/'.$agencia.'/'.$usuario.'firma.jpg" download="Firma Electrónica">';
						?>	
							<div class="btnword nunito">
								Descargar Firma
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>


			<!--******* CARTA RESPONSIVA *******-->
					<div class="col-md-4">
						<a href="http://gani.com.mx/admin/agencias/admin/images/corporativo/responsiva.pdf" target="_blank">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/4.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Carta Responsiva</h3>
								</div>
							</div>
						</a>
					</div>

			

				<!--******* RECIBOS DE COMPRA*******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#recibosmodal" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/5.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Recibos de Compra</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL RECIBOS DE COMPRA*******-->
			<div class="modal fade" id="recibosmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Recibos de Compra</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '<img src="img/agencias/'.$agencia.'/recibo.jpg" width="90%">';
			      			?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       <div class="col-md-6">
			            <?php							
						echo '<a href="img/agencias/'.$agencia.'/recibo.jpg" target="_blank">';
						?>	
							<div class="btnpdf nunito">
								Imprimir
							</div>
						</a>								
					</div>

			       	<div class="col-md-6">					
			       	<?php					
						echo '<a href="img/agencias/'.$agencia.'/recibo_editar.docx" download="Recibo editar">';
						?>
							<div class="btnword nunito">
								Editar
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>

				<!--******* TARJETAS DE PRESENTACIÓN *******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#tarjetasmodal" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/6.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Tarjetas de Presentación</h3>
								</div>
							</div>
						</a>
					</div>


			<!--******* VENTANA MODAL TARJETAS DE PRESENTACIÓN*******-->
			<div class="modal fade" id="tarjetasmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Tarjetas de Presentación</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '<img src="img/agencias/'.$agencia.'/'.$usuario.'tarjetas.jpg" width="90%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       	<div class="col-md-12">						
			       	<?php				
						echo '<a href="img/agencias/'.$agencia.'/'.$usuario.'tarjetas.pdf" download="Tarjeta de Presentacion">';
						?>
							<div class="btnword nunito">
								Descargar
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>

				<!--******* DATOS BCORTES *******-->
					<div class="col-md-4">
						<a href="https://gani.com.mx/admin/agencias/admin/images/corporativo/cuentas.pdf" target="_blank">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/7.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Datos Bcortes</h3>
								</div>
							</div>
						</a>
					</div>

				<!--******* AUTORIZACIÓN DE CARGO TDC*******-->
					<div class="col-md-4">
						<a href="https://gani.com.mx/admin/agencias/admin/images/corporativo/autorizacion.pdf" target="_blank">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/8.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Autorización de  cargo TDC</h3>
								</div>
							</div>
						</a>
					</div>

				<!--******* ACCESOS*******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#accesosmodal" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/9.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Accesos</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL ACCESOS*******-->
			<div class="modal fade" id="accesosmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Accesos Intranet</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<p>Usuario:  <?php echo $usuario; ?> </p>	
			      			<p>Contraseña:  <?php echo $contra; ?> </p>		        		
				        </div>
			      	</div>			        
			      </div>
			    </div>
			  </div>
			</div>




				<center>
			  		<h2 class="avenir-medium naranja tituloseccion">Redes Sociales</h2>
			  	</center>

			  <!--******* PORTADA FACEBOOK*******-->
			  	<div class="col-md-4">
			  		<a data-bs-toggle="modal" data-bs-target="#portadafacebook" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/10.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Portada Facebook</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL PORTADA DE FACEBOOK*******-->
			<div class="modal fade" id="portadafacebook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Portada de Facebook</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '<img src="img/agencias/'.$agencia.'/portada_facebook.jpg" width="90%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       	<div class="col-md-12">		
			       	<?php								
						echo '<a href="img/agencias/'.$agencia.'/portada_facebook.jpg" download="Portada de Facebook">';
						?>
							<div class="btnword nunito">
								Descargar
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>

				<!--*******LOGO FACEBOOK *******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#logofacebook" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/11.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Logotipo Facebook</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* VENTANA MODAL LOGOTIPO DE FACEBOOK*******-->
			<div class="modal fade" id="logofacebook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Portada de Facebook</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '<img src="img/agencias/'.$agencia.'/logo_facebook.jpg" width="95%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       	<div class="col-md-12">
			       	<?php										
						echo '<a href="img/agencias/'.$agencia.'/logo_facebook.jpg" download="logotipo de Facebook">';
						?>
							<div class="btnword nunito">
								Descargar
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
			  </div>
			</div>

				<!--******* ICONO GANI *******-->
					<div class="col-md-4">
						<a data-bs-toggle="modal" data-bs-target="#iconogani" class="curspoint">						
							<div class="row cuadcorporativo">
								<div class="col-md-5">
									<img src="img/corporativo/11.jpg" width="140px">
								</div>

								<div class="col-md-7">
									<h3 class="avenir-regular naranja titcorporativo">Icono Gani</h3>
								</div>
							</div>
						</a>
					</div>

			<!--******* ICONO GANI*******-->
			<div class="modal fade" id="iconogani" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Icono Gani</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<div class="col-md-12">	
			      			<center>
			      				<?php
			      				echo '
			      				<img src="img/agencias/'.$agencia.'/isotipo_facebook.jpg" width="90%">';
			      				?>
			      			</center>		        		
				        </div>
			      	</div>			        
			      </div>
			       <div class="row footmodcorp">
			       	<div class="col-md-12">					
			       	<?php					
						echo '<a href="img/agencias/'.$agencia.'/isotipo_facebook.jpg" download="Icono de Gani">';
						?>
							<div class="btnword nunito">
								Descargar
							</div>
						</a>									
					</div>	       	 
			      </div>
			      
			    </div>
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