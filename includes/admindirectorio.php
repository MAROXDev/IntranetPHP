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


					$queryProveedores = "SELECT nombre_proveedor FROM proveedores";
$queryProveedoresResult = mysqli_query($connection, $queryProveedores);

// Construir opciones dinámicamente
$proveedoresOptions = "";
if ($queryProveedoresResult && mysqli_num_rows($queryProveedoresResult) > 0) {
    while ($row = mysqli_fetch_assoc($queryProveedoresResult)) {
        $proveedoresOptions .= '<option value="' . htmlspecialchars($row['nombre_proveedor']) . '">' . htmlspecialchars($row['nombre_proveedor']) . '</option>';
    }
} else {
    $proveedoresOptions = '<option disabled>No hay proveedores disponibles</option>';
}



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
	<head>
		<title>Administrador Directorio Gani</title>
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
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Directorio</h3>
			 		</div>

  				<div class="col-md-4">
			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc
                            border-0 bg-transparent"></button>
                        
                    </form>
                	</div>

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregardirectorio">
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
			    					<th>Nombre</th>
			    					<th>Cargo</th>
			    					<th>Teléfono</th>	
			    					<th>Correo</th>
			    					<th>Proveedor</th>		    					
			    					<th class="vermashid">Ver Información</th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    				<?php 
			    				if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   										$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    									$recorridodirectorio = "SELECT * FROM directorio WHERE CONCAT(nombre, cargo, telefono, correo, proveedor) LIKE '%$searchTerm%'";
								} else {
   										$recorridodirectorio="SELECT * from directorio ";
								}	

			    				

								$arraydirectorio=mysqli_query($connection,$recorridodirectorio);

                        	$nom=1;

			    				while ($renglon = mysqli_fetch_array($arraydirectorio))
			    					{
			    						$nom=$nom+1;
			    						$proveedor = $renglon['proveedor'] ?? ''; // Obtener el proveedor actual
	$selectedGani = ($proveedor === "Gani Corporativo") ? 'selected' : '';
	$selectedProveedores = ($proveedor !== "Gani Corporativo" && !empty($proveedor)) ? 'selected' : '';
			    				echo '<tr>
			    					<td>'.$renglon['nombre'].'</td>
			    					<td>'.$renglon['cargo'].'</td>
			    					<td>'.$renglon['telefono'].'</td>
			    					<td style="width: 250px;">'.$renglon['correo'].'</td>			    		
			    					<td>'.$renglon['proveedor'].'</td>
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
			        <h2 class="modal-title fs-5 naranja">Editar Directorio</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="mod_directorio.php?id='.$renglon['id'].'" enctype="multipart/form-data">
			      		<input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre del usuario" value="'.$renglon['nombre'].'" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="cargo" value="'.$renglon['cargo'].'" placeholder="Cargo" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" value="'.$renglon['telefono'].'" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="mail" name="correo" value="'.$renglon['correo'].'" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12"> 
                            <select id="opcdirectorioedit_' . $nom . '" class="inpmodagreg" name="proveedores">
                                <option value="Gani Corporativo" ' . $selectedGani . '>Gani Corporativo</option>
                                <option value="proveeedit" ' . $selectedProveedores . '>Proveedores</option>
                            </select>
                        	</div>

                        	<div class="col-md-12">
                            <select id="proveedoresedit_' . $nom . '" class="inpmodagreg" name="proveedoresedit" ' . ($selectedProveedores ? '' : 'disabled') . '>
                                <option selected disabled>' . htmlspecialchars($renglon["proveedor"]) . '</option>
                                ' . $proveedoresOptions . '
                            </select>     
                        	</div>
			      			
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Directorio</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form method="post" action="delete_directorio.php?id=' . $renglon['id'] . '" enctype="multipart/form-data">
    <input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
    <div class="col-md-12">
        <center>
            <button class="btneliminarmod" type="submit">Eliminar Directorio</button>
        </center>				        		
    </div>
</form>
			      	</div>			        
			      </div>

			      
			    </div>
			  </div>
			</div>

<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let var1 = document.getElementById("opcdirectorioedit_' . $nom . '");
            let var2 = document.getElementById("proveedoresedit_' . $nom . '");

            function toggleProveedores() {
                let selectedValue = var1.value.trim();
                var2.disabled = (selectedValue === "Gani Corporativo") ? true : false;
            }

            toggleProveedores();
            var1.addEventListener("change", toggleProveedores);
        });
    </script>
			';
			    			}
			    				 ?>
			    			</tbody>
			    		</table>
			    </div>	 		

		 	</main>
		  </div>
 

	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregardirectorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Usuario Directorio</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
	      		<form method="post" action="altadirectorio.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre del usuario" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="cargo" placeholder="Cargo" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="mail" name="correo" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
					        	 <select id="opcdirectorio" class="inpmodagreg" name="proveedor">
				                    <option selected="selected" value="">Gani Corporativo</option>
				                    <option value="provee">Proveedores</option>
				                 </select> 
				        	</div>

				        	<div class="col-md-12">
    <select id="proveedores" class="inpmodagreg" name="proveedores" disabled>
        <option selected disabled>Elige el Proveedor</option>
        <?php echo $proveedoresOptions; ?>
    </select>     
</div>

			      			
				        	        	
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Usuario</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>



	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editardirectorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja"> <?php echo $idid; ?>  Editar Proveedor</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre del usuario" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Cargo" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="mail" name="" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
					        	 <select id="opcdirectorioedit" class="inpmodagreg" name="">
				                    <option selected="selected" value="">Gani Corporativo</option>
				                    <option value="proveeedit">Proveedores</option>
				                 </select> 
				        	</div>

				        	<div class="col-md-12">
					        	 <select id="proveedoresedit" class="inpmodagreg" name="proveedoresedit" disabled>
									  <option selected disabled >Elige el Proveedor</option>
									  <option value="Facebook">Bcortes</option>
									  <option value="Instagram">Hoteldo</option>
									  <option value="LinkedIn ">Imacop </option>
									  <option value="YouTube ">Juiatours </option>
								  </select>     
				        	</div>
			      			

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Usuario</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Usuario</button>
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

		<!--***SCRIPT HABILITAR PROVEEDORES***-->
		<script>
document.addEventListener("DOMContentLoaded", function () {
    const opcdirectorio = document.getElementById("opcdirectorio");
    const proveedores = document.getElementById("proveedores");

    opcdirectorio.addEventListener("change", function () {
        if (this.value === "provee") {
            proveedores.removeAttribute("disabled");
        } else {
            proveedores.setAttribute("disabled", "disabled");
            proveedores.selectedIndex = 0; // Reinicia la selección
        }
    });
});
</script>

		

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