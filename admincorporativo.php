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
<html lang="">
	<head>
		<title>Administrador Usuarios Gani</title>
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
		   <!--***INICIA MENÚ LATERAL***-->
		 	<?php
		      require_once('includes/blateralcorp.php');
		    ?>

		 	<!--***INICIA CONTENIDO DE ADMINISTRADOR***-->
		 	<main class="contadmin">
		 		<div class="row">
		 			<div class="col-md-4">
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Corporativo Gani</h3>
			 		</div>

			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        <div class="col-md-4">
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc"></button>
                        </div>
                    </form>

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarcorporativo">
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
			    					<th>Nombre de la Agencia</th>			    				
			    					<th>Propietario</th>	
			    					<th>Dominio</th>		    					
			    					<th></th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    				<?php 
			    					if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   										$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    									$recorridoCorporativo = "SELECT * FROM corporativo WHERE CONCAT(name, propietario, dominio) LIKE '%$searchTerm%'";
								} else {
   										$recorridoCorporativo="SELECT * from corporativo";
								}
								$arrayCorporativo=mysqli_query($connection,$recorridoCorporativo);
								$nom=1;

			    				while ($renglon = mysqli_fetch_array($arrayCorporativo))
			    				{
			    						$nom=$nom+1;
			    				echo '<tr>
			    					<td>'.$renglon['name'].'</td>
			    					<td>'.$renglon['propietario'].'</td>
			    					<td>'.$renglon['dominio'].'</td>
			    					<td>
			    						<a class="btntab" data-bs-toggle="modal" data-bs-target="#'.$nom.'">Editar<i class="bi bi-zoom-in"></i></a>
			    					</td>
			    				</tr>';
			    				echo '
	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar corporativo</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="mod_certificado.php?id='.$renglon['id'].'" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" value="'.$renglon['name'].'" placeholder="Nombre del corporativo" class="inpmodagreg" required>
			      			</div>
			      			<div class="col-md-12">
			      				<input type="text" name="propietario" value="'.$renglon['propietario'].'" placeholder="Propietario del corporativo" class="inpmodagreg" required>
			      			</div>
			      			<div class="col-md-12">
			      				<input type="text" name="dominio" value="'.$renglon['dominio'].'" placeholder="Dominio del corporativo" class="inpmodagreg" required>
			      			</div>



			      

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar corporativo</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form method="post" action="delete_certificado.php?id='.$renglon['id'].'" enctype="multipart/form-data">
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar corporativo</button>
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
			<div class="modal fade" id="agregarcorporativo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Documentos Corporativos</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>			      			
			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Selecciona la Agencia</option>
					        		<option>Excuviatur</option>
					        		<option>Gani</option>
					        		<option>La Vuelta al Mundo</option>
					        		<option>Ok Travels</option>					        		
					        	</select>
				        	</div>

			      			<div class="col-md-12">				        		
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Logotipos en JPG, PNG PDF</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-3" id="file-3" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-3">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Hoja Membretada</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-4" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-4">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Recibos de Compra</span>
								</label>
				        	</div>			        	
			      			

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Documentos</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>



	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editaragencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Documentos</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<h3 class="avenir-regular naranja">Nombre de la Agencia</h3>
			      			<div class="col-md-12">				        		
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Logotipos en JPG, PNG PDF</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-3" id="file-3" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-3">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Hoja Membretada</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-4" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-4">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Recibos de Compra</span>
								</label>
				        	</div>			        	

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Documentos</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Documentos</button>
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
