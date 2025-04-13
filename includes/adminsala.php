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
		<title>Administrador Sala de Aprendizaje Gani</title>
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
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Sala de Aprendizaje</h3>
			 		</div>

                    <div class="col-md-4">
			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc
                            border-0 bg-transparent"></button>
                        
                    </form>
                	</div>

			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarsala">
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
			    					<th>Título</th>
			    					<th>Fecha de Creación</th>
			    					<th>Tipo</th>	
			    					<th>Unidad</th>			    							    					
			    					<th class="vermashid">Ver Información</th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    				<?php 
			    					if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   											$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    										$recorridosala = "SELECT * FROM sala_de_aprendizaje WHERE CONCAT(titulo, tipo, unidad) LIKE '%$searchTerm%'";
									} else {
   											$recorridosala="SELECT * from sala_de_aprendizaje";
									}
									$arraysala=mysqli_query($connection,$recorridosala);
                        			$nom=1;
                        			if ($arraysala && mysqli_num_rows($arraysala) > 0) {
        								while ($row = mysqli_fetch_array($arraysala)) {
        									$nom=$nom+1;
            						echo '
            				<tr>
                <td>'.$row['titulo'].'</td>
                <td>'.$row['fecha_creacion'].'</td>
                <td>'.$row['tipo'].'</td>
                <td>'.$row['unidad'].'</td>
                <td><a class="btntab" data-bs-toggle="modal" data-bs-target="#'.$nom.'">Editar <i class="bi bi-zoom-in"></i></a></td>
            </tr>';

            echo '
            			<div class="modal fade" id="'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Sala</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="mod_sala.php?id='.$row['id'].'" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" value="'.$row['titulo'].'" placeholder="Título del tema" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required name ="unidad">
				        				
				        				<option>'.$row['unidad'].'</option>';

				        				$recorridomodulo = "SELECT * from modulos";
				        				$arraymodulo=mysqli_query($connection,$recorridomodulo);
				        				while ($item2=mysqli_fetch_array($arraymodulo)) {
				        				echo'<option>'.$item2['modulo'].'</option>';	
				        				}
				        			
				        	echo '</select>
				        	</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" value="'.$row['fecha_creacion'].'" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" name ="tipo" required>
					        		<option>'.$row['tipo'].'</option>
					        		<option>Texto</option>
					        		<option>Enlace</option>
					        		<option>Documento</option>					        		
					        	</select>
				        	</div>
				        	<!--
			      			<div class="col-md-12">
					        	 <select id="opcdirectorio" class="inpmodagreg" name="">
				                    <option selected="selected" value="">Gani Corporativo</option>
				                    <option value="provee">Proveedores</option>
				                 </select> 
				        	</div>

				        	<div class="col-md-12">
					        	 <select id="proveedores" class="inpmodagreg" name="proveedores" disabled>
									  <option selected disabled >Elige el Proveedor</option>
									  <option value="Facebook">Bcortes</option>
									  <option value="Instagram">Hoteldo</option>
									  <option value="LinkedIn ">Imacop </option>
									  <option value="YouTube ">Juiatours </option>
								  </select>     
				        	</div>
				        	
			      			
			      			<div class="col-md-12">
					        	 <input type="text" value="'.$row['enlace'].'" name="enlace" placeholder="enlace o texto" class="inpmodagreg" required>
				        	</div>
				        	-->

				        	<div class="col-md-12">
			      				<textarea id="textocomp" name="enlace" rows="4" cols="50" placeholder="texto" >'.$row['enlace'].'
								</textarea>	
			      			</div>
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Tema</button>
				        		</center>				        		
				        	</div>				        	
				        </form>

				        <form method="post" action="delete_salas.php?id='.$row['id'].'" enctype="multipart/form-data">
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btneliminarmod">Eliminar Tema</button>
				        		</center>				        		
				        	</div>
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>            ';






        }
    } else {
        echo "<tr><td colspan='4'>No existen bibliografías que cumplan con estas condiciones.</td></tr>";
    }
			    				?>
			    			</tbody>
			    		</table>
			    </div>	 		

		 	</main>
		  </div>


	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregarsala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Tema de la Sala</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="altasala.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Título del tema" class="inpmodagreg" required>
			      			</div>
			      				

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required name ="unidad">
				        			<?php 
				        				$recorridomodulo = "SELECT * from modulos";
				        				$arraymodulo=mysqli_query($connection,$recorridomodulo);
				        				while ($item2=mysqli_fetch_array($arraymodulo)) {
				        				echo'<option>'.$item2['modulo'].'</option>';	
				        				}
				        				

				        			 ?>
					        		<!--<option>Unidad a la que pertenece</option>
					        		<option>Unidad 1 ¿Qué es Gani Viajes?</option>
					        		<option>Unidad 2 Aspectos básicos</option>
					        		<option>Unidad 3 Documentos Oficiales</option>					 -->       		
					        	</select>
				        	</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" name ="tipo" required>
					        		<option>Tipo</option>
					        		<option>Texto</option>
					        		<option>Enlace</option>
					        		<option>Documento</option>					        		
					        	</select>
				        	</div>

			      			<!--<div class="col-md-12">
					        	 <input type="text" name="enlace" placeholder="enlace" class="inpmodagreg" required>
				        	</div>-->

				        	<div class="col-md-12">
			      				<textarea id="textocomp" name="enlace" rows="4" cols="50" placeholder="texto">
								</textarea>	
			      			</div>
				        	<!--<div class="col-md-12">
					        	 <select id="proveedores" class="inpmodagreg" name="proveedores" disabled>
									  <option selected disabled >Elige el Proveedor</option>
									  <option value="Facebook">Bcortes</option>
									  <option value="Instagram">Hoteldo</option>
									  <option value="LinkedIn ">Imacop </option>
									  <option value="YouTube ">Juiatours </option>
								  </select>     
				        	</div>-->
			      			
				        	        	
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Agregar Tema</button>
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
			        <h2 class="modal-title fs-5 naranja">Editar Proveedor</h2>
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

		<script>
		function cleanEmptyInput() {
    	const input = document.getElementById('search-input');
    	if (input.value.trim() === '') {
        	input.name = ''; // Remove the name attribute to exclude it from the URL.
    	}
    	return true; // Allow the form to submit.
		}
		</script>

		<!--***SCRIPT HABILITAR PROVEEDORES***-->
		<script type="text/javascript">
			let ee = document.getElementById('opcdirectorio');
				let cs = document.getElementById('proveedores');
				ee.addEventListener("change", function(){
				    if (ee.value == 'provee') {
				        cs.disabled = false;
				    }else {
				        cs.disabled = true;
				    }
				});

		</script>

		<!--***SCRIPT HABILITAR EDITAR PROVEEDORES***-->
		<script type="text/javascript">
			let var1 = document.getElementById('opcdirectorioedit');
				let var2 = document.getElementById('proveedoresedit');
				var1.addEventListener("change", function(){
				    if (var1.value == 'proveeedit') {
				        var2.disabled = false;
				    }else {
				        var2.disabled = true;
				    }
				});

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