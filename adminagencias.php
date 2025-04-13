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
		<title>Administrador Agencias Gani</title>
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
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Agencias Gani</h3>
			 		</div>

					<div class="col-md-4">
			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc
                            border-0 bg-transparent"></button>
                        
                    </form>
                	</div>





			 	

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregaragencia">
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
			    					<th>Agencia</th>
			    					<th>Ciudad</th>
			    					<th>Propietario</th>	
			    					<th>Teléfono</th>
			    					<th>Dominio</th>		    					
			    					<th></th>
			    				</tr>
			    			</thead>
			    			<tbody>
		    				<?php 
			    				if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   										$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    									$recorridodirectorio = "SELECT * FROM agencias WHERE CONCAT(nombre, titular, estado) LIKE '%$searchTerm%'";
								} else {
   										$recorridodirectorio="SELECT * from agencias ";
								}	

			    				

								$arraydirectorio=mysqli_query($connection,$recorridodirectorio);

                        	$nom=1;

			    				while ($renglon = mysqli_fetch_array($arraydirectorio))
			    					{
			    						$nom=$nom+1;

			    				echo'<tr>
			    					<td style="width: 210px;">'.$renglon['nombre'].'</td>
			    					<td>'.$renglon['estado'].'</td>
			    					<td style="width: 215px;">'.$renglon['titular'].'</td>
			    					<td>'.$renglon['telefono'].'</td>			    		
			    					<td style="width: 200px;">'.$renglon['dominio'].'</td>
		    					
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
			        <h2 class="modal-title fs-5 naranja">Editar Agencia</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="mod_agencias.php?id='.$renglon['id'].'" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre de la Agencia" class="inpmodagreg" value="'.$renglon['nombre'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="titular" placeholder="Nombre del Titular" class="inpmodagreg" value="'.$renglon['titular'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="direccion" placeholder="Dirección" class="inpmodagreg" value="'.$renglon['direccion'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="estado" placeholder="Estado" class="inpmodagreg" value="'.$renglon['estado'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" placeholder="Teléfono" class="inpmodagreg" value="'.$renglon['telefono'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="rfc" placeholder="RFC" class="inpmodagreg" value="'.$renglon['rfc'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="correo" placeholder="Correo Electrónico" class="inpmodagreg" value="'.$renglon['correo'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" class="inpmodagreg" value="'.$renglon['fechaalta'].'" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="dominio" placeholder="Dominio de la Agencia" class="inpmodagreg" value="'.$renglon['dominio'].'" required>
			      			</div> 

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Agencia</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form method="post" action="delete_agencias.php?id='.$renglon['id'].'" enctype="multipart/form-data">
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Agencia</button>
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
			<div class="modal fade" id="agregaragencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Agencia</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="altaagencias.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre de la Agencia" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="titular" placeholder="Nombre del Titular" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="direccion" placeholder="Dirección" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="estado" placeholder="Estado" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="rfc" placeholder="RFC" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="correo" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" class="inpmodagreg" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="dominio" placeholder="Dominio de la Agencia" class="inpmodagreg" required>
			      			</div>       	

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Agencia</button>
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
			        <h2 class="modal-title fs-5 naranja">Editar Agencia</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre de la Agencia" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del Titular" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Dirección" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Estado" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="RFC" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="" placeholder="Dominio de la Agencia" class="inpmodagreg" required>
			      			</div> 

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Agencia</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Agencia</button>
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