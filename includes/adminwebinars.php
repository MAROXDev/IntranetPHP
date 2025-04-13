<?php 

					session_start();
					$usuario=$_SESSION["usuario"] ;

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
					$telefonoagencia=$colum['telefono'];
					$correo=$colum['correo'];
					$tipo=$colum['nivel'];



					 ?>



<!--***BOTÓN ADMINISTRADOR***-->
	<?php
		if ($tipo=='0') {
		
		}else{
			header("location: http://viajesreveilduleon.com/intranetnativa/acceso.php");
			exit();
		}

	$recorridowebinars="SELECT * from webinnars ";

	$arraywebinars=mysqli_query($connection,$recorridowebinars);



	?>	

<!DOCTYPE html>
<html lang="">
	<head>
		<title>Administrador Webinars Gani</title>
		<!--***INICIA CABECERA***-->
		<?php
		      require_once('includes/cabecera.php');
		    ?>
		    <style type="text/css">

		    	
		    </style>
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
		   <!--***INICIA MENÚ LATERAL***-->
		 	<?php
		      require_once('includes/blateralcorp.php');
		    ?>

		 	<!--***INICIA CONTENIDO DE ADMINISTRADOR***-->
		 	<main class="contadmin">
		 		<div class="row">
		 			<div class="col-md-8">
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Webinars</h3>
			 		</div>
			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarwebinar">
			 				<div class="btnadmagregar">
			 					Agregar <i class="bi bi-plus-circle-fill"></i> 
			 				</div>
			 			</a>
			 		</div>
		 		</div>
		 		
		 		<div class="row admcontapart">
		 			<table class="table table-hover">
			    			<thead>
			    				<tr>
			    					<th>Nombre del Webinar</th>
			    					<th>Proveedor</th>
			    					<th>Fecha</th>	
			    					<th>Categoría</th>		    					
			    					<th></th>
			    				</tr>
			    			</thead>
			    			<tbody>

			    				<?php 

			    				$nom=1;

			    				while ($renglon = mysqli_fetch_array($arraywebinars))
			    					{
			    						$nom=$nom+1;
			    				echo '<tr>
			    					<td>'.$renglon['nombre'].'</td>
			    					<td>'.$renglon['provedor'].'</td>
			    					<td>'.$renglon['fecha'].'</td>
			    					<td>'.$renglon['tipo'].'</td>			    								    					
			    					<td>
			    						<a class="btntab" data-bs-toggle="modal" data-bs-target="#'.$nom.'">Editar <i class="bi bi-zoom-in"></i></a>
			    					</td>
			    				</tr>';



			    				echo '

						<!--******* VENTANA MODAL EDITAR*******-->
								<div class="modal fade" id="'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h2 class="modal-title fs-5 naranja">Editar Webinar </h2>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								      	<div class="row" style="padding: 30px;">
								      		<form method="post" action="mod_webinar.php?id='.$renglon['id'].'" enctype="multipart/form-data">
								      			<div class="col-md-12">
								      				<input type="text" name="nombre" placeholder="Nombre del Webinar"  value="'.$renglon['nombre'].'" class="inpmodagreg" required>
								      			</div>

								      			<div class="col-md-12">
								      				<input type="text" name="provedor" placeholder="Proveedor" 
								      					value="'.$renglon['provedor'].'"
								      					class="inpmodagreg" required>
								      			</div>

								      			<div class="col-md-12">
								      				<input type="date" name="fecha" 
								      					value="'.$renglon['fecha'].'"
								      					class="inpmodagreg" required>
								      			</div>
									        	
									        	<div class="col-md-12">
									        		<select name="tipo" class="inpmodagreg" required>
										        		<option>'.$renglon['tipo'].'</option>
										        		<option>Convertirse en Agencia Gani</option>
										        		<option>Proveedores Premium Gani</option>
										        		<option>Hotélería</option>
										        		<option>Nacionales</option>
										        		<option>Estados Unidos</option>
										        		<option>Sudamérica</option>
										        		<option>Europa</option>
										        		<option>Navieras</option>
										        		<option>Seguros</option>
										        		<option>Eventos</option>
										        		<option>Vuelos</option>
										        		<option>Otros destinos</option>
										        	</select>
									        	</div>

									        	<div class="col-md-12">
								      				<input type="text" name="weburl" placeholder="Link Youtube"
								      					value="'.$renglon['weburl'].'"
								      				 class="inpmodagreg">
								      			</div>

									        	<div class="col-md-12">
									        		<center>
									        			<button class="btnagrmod">Editar Webinar</button>
									        		</center>				        		
									        	</div>				        	
									        </form>
									        <form method="post" action="delete_webinar.php?id='.$renglon['id'].'">
									        	<div class="col-md-12">
									        		<center>
									        			<button class="btneliminarmod">Eliminar Webinar</button>
									        		</center>				        		
									        	</div>
									        </form>
								      	</div>			        
								      </div>
								      
								    </div>
								  </div>
								</div>';



			    			    }
			    			    ?>







			    			</tbody>
			    		</table>
			    </div>	 		

		 	</main>
		  </div>


	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregarwebinar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Webinar</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="altawebinnars.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre del Webinar" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="provedor" placeholder="Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="date" name="fecha" class="inpmodagreg" required>
			      			</div>
				        	
				        	<div class="col-md-12">
				        		<select class="inpmodagreg" required name="tipo">
					        		<option>Categoría de Webinar</option>
					        		<option>Convertirse en Agencia Gani</option>
					        		<option>Proveedores Premium Gani</option>
					        		<option>Hotélería</option>
					        		<option>Nacionales</option>
					        		<option>Estados Unidos</option>
					        		<option>Sudamérica</option>
					        		<option>Europa</option>
					        		<option>Navieras</option>
					        		<option>Seguros</option>
					        		<option>Eventos</option>
					        		<option>Vuelos</option>
					        		<option>Otros destinos</option>
					        	</select>
				        	</div>

				        	<div class="col-md-12">
			      				<input type="text" name="weburl" placeholder="Link Youtube" class="inpmodagreg">
			      			</div>				        	

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Webinar</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>



	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editarwebinar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Webinar</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del Webinar" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>
				        	
				        	<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Categoría de Webinar</option>
					        		<option>Convertirse en Agencia Gani</option>
					        		<option>Proveedores Premium Gani</option>
					        		<option>Hotélería</option>
					        		<option>Nacionales</option>
					        		<option>Estados Unidos</option>
					        		<option>Sudamérica</option>
					        		<option>Europa</option>
					        		<option>Navieras</option>
					        		<option>Seguros</option>
					        		<option>Eventos</option>
					        		<option>Vuelos</option>
					        		<option>Otros destinos</option>
					        	</select>
				        	</div>

				        	<div class="col-md-12">
			      				<input type="text" name="" placeholder="Link Youtube" class="inpmodagreg">
			      			</div>

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar comunicado</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar comunicado</button>
				        		</center>				        		
				        	</div>
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

		<!--***INICIA FOOTER***-->
		<?php
			require_once('includes/footer.php');
		?>


		<!--***SCRIPT INPUT FILE***-->
		<script type="text/javascript">
			'use strict';

			;( function ( document, window, index )
			{
				var inputs = document.querySelectorAll( '.inputfile' );
				Array.prototype.forEach.call( inputs, function( input )
				{
					var label	 = input.nextElementSibling,
						labelVal = label.innerHTML;

					input.addEventListener( 'change', function( e )
					{
						var fileName = '';
						if( this.files && this.files.length > 1 )
							fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
						else
							fileName = e.target.value.split( '\\' ).pop();

						if( fileName )
							label.querySelector( 'span' ).innerHTML = fileName;
						else
							label.innerHTML = labelVal;
					});
				});
			}( document, window, 0 ));
		</script>
		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>