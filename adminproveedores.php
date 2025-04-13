<?php 

					session_start();
					$usuario=$_SESSION["usuario"] ;
					//$usuario = "admin";
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


	?>




<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
		<title>Administrador Proveedores Gani</title>
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
		 			<div class="col-md-4">
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Proveedores Gani</h3>
			 		</div>

                <div class="col-md-4">
			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc
                            border-0 bg-transparent"></button>
                        
                    </form>
                	</div>

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarproveedor">
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
			    					<th>Nombre del Proveedor</th>
			    					<th>Tipo</th>
			    					<th>Fecha</th>	
			    					<th>Comisión</th>
			    					<th>Categoría</th>
			    					<th>Link</th>
			    					<th>Número telefónico</th>	

			    					<th class="vermashid">Ver Información</th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    				<?php

			    				if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   										$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    									$recorridoproveedores = "SELECT * FROM proveedores WHERE CONCAT(nombre_proveedor, tipo, categoria) LIKE '%$searchTerm%'";
								} else {
   										$recorridoproveedores="SELECT * from proveedores ";
								}	
								$arrayproveedores=mysqli_query($connection,$recorridoproveedores);
                        		$nom=1;
			    				while ($renglon = mysqli_fetch_array($arrayproveedores))
			    					{
			    						$nom=$nom+1;
			    				echo '<tr>
			    					<td>'.$renglon['nombre_proveedor'].'</td>
			    					<td>'.$renglon['tipo'].'</td>
			    					<td>'.$renglon['fecha'].'</td>
			    					<td>'.$renglon['comision'].'</td>
			    					<td>'.$renglon['categoria'].'</td>
			    					<td>'.$renglon['link'].'</td>
			    					<td>'.$renglon['numero'].'</td>	

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
							        <h2 class="modal-title fs-5 naranja">Editar Proveedor</h2>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body">
							      	<div class="row" style="padding: 30px;">
							      		<form method="post" action="mod_proveedores.php?id='.$renglon['id'].'&page=1" enctype="multipart/form-data">
							      			<div class="col-md-12">
							      				<input type="text" name="nombre"
							      				 value="'.$renglon['nombre_proveedor'].'"
							      				 placeholder="Nombre del Proveedor" class="inpmodagreg" required>
							      			</div>

							      			<div class="col-md-12">
							      				<input type="text" name="tipo" 
							      				value="'.$renglon['tipo'].'" placeholder="Tipo de Proveedor" class="inpmodagreg" required>
							      			</div>

							      			<div class="col-md-12">
                            <input type="text" name="link" id="link'.$renglon['id'].'" value="'.$renglon['link'].'" class="inpmodagreg" placeholder="Link del Proveedor" required>
                        </div>
                        					<div class="col-md-12">
                            <input type="text" name="numero" id="numero'.$renglon['id'].'" value="'.$renglon['numero'].'" 	class="inpmodagreg" placeholder="Número del Proveedor">
                        					</div>



							      			<div class="col-md-12">
							      				<input type="text" name="comision"
							      				value="'.$renglon['comision'].'"
							      				 placeholder="Comisión del Proveedor" class="inpmodagreg">
							      			</div>

							      			<div class="col-md-12">
							      				<p>Fecha de registro</p>
							      				<input type="date" name="fecha" value="'.$renglon['fecha'].'" class="inpmodagreg" required>
							      			</div>

							      			<div class="col-md-12">
								        		<select name= "categoria" class="inpmodagreg" required>
									        		<option>'.$renglon['categoria'].'</option>
									        		<option>Turístico</option>
									        		<option>Servicios</option>
									        		<option>Consumibles</option>
									        	</select>
								        	</div>
								        	<!--
								        	<div class="col-md-12">
								        		<p>Tamaño del logo 300px X 130 px</p>
								        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
												<label for="file-2">
												<i class="bi bi-upload"></i>
												<span class="iborrainputfile">Logo del Proveedor</span>
												</label>
								        	</div> -->

								        	<div class="col-md-12">
								        		<p>Tamaño del logo 300px X 130 px</p>
									        	<div class="file-select">
												  <input type="file" name="file-2" id="file-2" aria-label="Archivo">
												</div>
											</div>
											
								        	<div class="col-md-12">
								        		<center>
								        			<button class="btnagrmod">Editar Proveedor</button>
								        		</center>				        		
								        	</div>				        	
								        </form>
								        <form method="post" action="delete_proveedores.php?id='.$renglon['id'].'&page=1">
								        	<div class="col-md-12">
								        		<center>
								        			<button class="btneliminarmod">Eliminar Proveedor</button>
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
			<div class="modal fade" id="agregarproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Proveedor</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="altaproveedores.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre del Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="tipo" placeholder="Tipo de Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="link" placeholder="Link del Proveedor" class="inpmodagreg">
			      			</div>
			      			<div class="col-md-12">
			      				<input type="text" name="numero" placeholder="Número del Proveedor" class="inpmodagreg">
			      			</div>


			      			<div class="col-md-12">
			      				<input type="text" name="comision" placeholder="Comisión del Proveedor" class="inpmodagreg">
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select name="categoria" class="inpmodagreg" required>
					        		<option>Categoría</option>
					        		<option>Turístico</option>
					        		<option>Servicios</option>
					        		<option>Consumibles</option>
					        	</select>
				        	</div>
				        	
				        	

				        	<div class="col-md-12">
				        		<p>Tamaño del logo 300px X 130 px</p>
				        		<input type="file" name="file-2" id="file-2" />
								
				        	</div>
				        	        	

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Proveedor</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>



	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editarproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Proveedor</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Tipo de Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Comisión del Proveedor" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Categoría</option>
					        		<option>Turístico</option>
					        		<option>Servicio</option>
					        		<option>Consumible</option>
					        	</select>
				        	</div>
				        	
				        	<div class="col-md-12">
				        		<p>Tamaño del logo 300px X 130 px</p>
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Logo del Proveedor</span>
								</label>
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

		<script>
		function cleanEmptyInput() {
    	const input = document.getElementById('search-input');
    	if (input.value.trim() === '') {
        	input.name = ''; // Remove the name attribute to exclude it from the URL.
    	}
    	return true; // Allow the form to submit.
		}
		</script>


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