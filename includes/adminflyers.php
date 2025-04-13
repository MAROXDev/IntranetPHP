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
	?>



<?php
// Handle AJAX Request Directly
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if a search term is provided
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    if ($searchTerm !== '') {
        // Filter results based on the search term
        $query = "SELECT * FROM `flyers` WHERE lower(`nombre_flyer`) LIKE lower(?)";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            $searchTermWithWildcard = $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $searchTermWithWildcard);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    } else {
        $query = "SELECT * FROM `flyers`";
        $result = mysqli_query($connection, $query);
    }

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['nombre_flyer']}</td>
                <td>{$row['destino']}</td>
                <td>{$row['fecha']}</td>
                <td><a class='btntab' data-bs-toggle='modal' data-bs-target='#editarcom'>Editar <i class='bi bi-zoom-in'></i></a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No existen flyers que cumplan con estas condiciones.</td></tr>";
    }

    mysqli_close($connection);
    exit;
}
?>

<!DOCTYPE html>
<html lang="">
	<head>
		<title>Administrador Flyers Gani</title>
		<!--***INICIA CABECERA***-->
		<?php
		      require_once('includes/cabecera.php');
		    ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Flyers</h3>
			 		</div>

                    <form id="search-form">
                        <div class="col-md-4">
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off">
                            <button type="button" id="search-button" class="bi bi-search naranja iconbusc"></button>
                        </div>
                    </form>

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarflyers">
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
			    					<th>Nombre del Flyer</th>
			    					<th>Destino</th>
			    					<th>Fecha</th>				    							    					
			    					<th></th>
			    				</tr>
			    			</thead>
			    			<tbody id="search-results"></tbody>
			    		</table>
			    </div>	 		

		 	</main>
		  </div>


	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregarflyers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Flyer</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del Flyer" class="inpmodagreg" required>
			      			</div>			      			

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Categoría</option>
					        		<option>Playas</option>
					        		<option>Europa</option>
					        		<option>Cuba</option>
					        		<option>Las Vegas</option>
					        		<option>Orlando</option>
					        		<option>Disney</option>
					        		<option>Costa Rica</option>
					        	</select>
				        	</div>
				        	
				        	<div class="col-md-12">
				        		<p>Tamaño del Flyer 900 x 1181 px</p>
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Adjuntar Flyer</span>
								</label>
				        	</div>
				        	        	

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Flyer</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>



	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editarflyer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Flyer</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del Flyer" class="inpmodagreg" required>
			      			</div>			      			

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Categoría</option>
					        		<option>Playas</option>
					        		<option>Europa</option>
					        		<option>Cuba</option>
					        		<option>Las Vegas</option>
					        		<option>Orlando</option>
					        		<option>Disney</option>
					        		<option>Costa Rica</option>
					        	</select>
				        	</div>
				        	
				        	<div class="col-md-12">
				        		<p>Tamaño del Flyer 900 x 1181 px</p>
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Editar Flyer</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Flyer</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Flyer</button>
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
    <script src="scripts/search.js"></script>
    </body>
</html>