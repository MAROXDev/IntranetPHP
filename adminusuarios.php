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


				$recorrido="SELECT * from agencias order by nombre ";

				$arrayagencias=mysqli_query($connection,$recorrido);



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
			 			<h3 class="naranja avenir-medium titadmonsecc"><i class="bi bi-send-fill"></i> Usuarios Gani</h3>
			 		</div>

			 		 <div class="col-md-4">
			 		<form method="GET" action="" onsubmit="return cleanEmptyInput()">
                        
                            <input type="text" id="search-input" name="searchTerm" class="inpbusqueda" placeholder="Buscar elemento" autocomplete="off" value="<?= isset($_GET['searchTerm']) ? ($_GET['searchTerm']): '' ?>">
                            <button type="submit" id="search-button" class="bi bi-search naranja iconbusc
                            border-0 bg-transparent"></button>
                        
                    </form>
                	</div>



			 		<div class="col-md-4">
			 			<a data-bs-toggle="modal" data-bs-target="#agregarusuario">
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
			    					<th>Apellidos</th>
			    					<th>Agencia</th>
			    					<th>Usuario</th>
			    					
			    					<th>Tipo de Usuario</th>
			    					<th>Estatus</th>		    							    					
			    					<th></th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    			<?php 
			    					if (isset($_GET['searchTerm']) && $_GET['searchTerm'] != '') {
   											$searchTerm = mysqli_real_escape_string($connection, $_GET['searchTerm']);
    										$recorridosala = "SELECT * FROM usuarios WHERE CONCAT(nombre, agencia, user) LIKE '%$searchTerm%'";
									} else {
   											$recorridosala="SELECT * from usuarios";
									}
									$arraysala=mysqli_query($connection,$recorridosala);
                        			$nom=1;
                        			if ($arraysala && mysqli_num_rows($arraysala) > 0) {
        								
        								while ($row = mysqli_fetch_array($arraysala)) {
        									$nom=$nom+1;

        									$bandera1='';
        									if ($row['habilitado']=='0') {
        										$bandera1='Habilitado';
        									}else{
        										$bandera1='DesaHabilitado';
        									}
        									

        									$bandera2='';
        									if ($row['nivel']=='0') {
        										$bandera2='Super Administrador';
        									}
        									if ($row['nivel']=='1') {
        										$bandera2='Agencia';
        									}
        									if ($row['nivel']=='2') {
        										$bandera2='Ventas';
        									}
        									if ($row['nivel']=='3') {
        										$bandera2='Invitado';
        									}
            		echo '
			   				<tr>
			                <td>'.$row['nombre'].'</td>
			                <td>'.$row['apeido'].'</td>
			                <td>'.$row['agencia'].'</td>
			                <td>'.$row['user'].'</td>
			                <td>'.$bandera2.'</td>
			                <td>'.$bandera1.'</td>
			                <td>
			    						<a class="btntab" data-bs-toggle="modal" data-bs-target="#'.$nom.'">Editar <i class="bi bi-zoom-in"></i></a>
			    					</td>';

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
			      		<form method="post" action="mod_usuario.php?id='.$row['id'].'" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" value="'.$row['nombre'].'" placeholder="Nombre" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="apeido" value="'.$row['apeido'].'" placeholder="Apellidos" class="inpmodagreg" required>
			      			</div>
 						     

			      			<div class="col-md-12">
				        		<select name="agencia" class="inpmodagreg" required>
					        		<option>'.$row['agencia'].'</option>
					        							         ';

					         while ($renglon = mysqli_fetch_array($arrayagencias))

	                           {



      						  // echo '<option value='.$renglon['fecha'].'>'.$renglon['fecha'].'</option>'; 

					 		echo '<option value="'.$renglon['nombre'].'" >'.$renglon['nombre'].'</option>';


    						  }					        		
    						  	echo '

					        	</select>
				        	</div>

			      			<div class="col-md-12">
			      				<input type="text" name="correo" value="'.$row['correo'].'" placeholder="Correo" class="inpmodagreg" required>
			      			</div>
			      						      			

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" value="'.$row['telefono'].'" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>
			      			
			      			

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="usuario" value="'.$row['user'].'" placeholder="Usuario" class="inpmodagreg" required>
			      			</div>    

			      			<div class="col-md-12">
			      				<input type="text" name="contra" value="'.$row['psw'].'" placeholder="Contraseña" class="inpmodagreg" required>
			      			</div> 

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" name="tipo" required>
					        		<option value="1">Agencia</option>
					 				<option value="2">Ventas</option>
					 				<option value="3">Invitado</option>
					 				<option value="0">Super usuario</option>				        						        		
					        	</select>
				        	</div>

			      			<div class="col-md-12">				        		
				        		<input type="file" name="file-4" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-4">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Firma Electrónica</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-5" id="file-5" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-5">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Tarjetas de Presentación</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<select class="inpmodagreg" name="habilitado" required>
					        		
					        		<option value="0">Habilitado</option>
					        		<option value="1">Deshabilitado</option>			        						        		
					        	</select>
				        	</div>

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Usuario</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				        <form method="post" action="delete_usuario.php?id='.$row['id'].'" enctype="multipart/form-data">
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



			            ';



    }
    } else {
        echo "<tr><td colspan='4'>No existen bibliografías que cumplan con estas condiciones.</td></tr>";
    }
			    				?>
	


	<!--		    				<tr>
			    					<td>Soyla</td>
			    					<td>Sandoval</td>
			    					<td>Excuviatur</td>			    					
			    					<td>soyla</td>	
			    					<td>ssandoval01</td>
			    					<td>Administrador</td>
			    					<td>Habilitado</td>	    								    					
			    					<td>
			    						<a class="btntab" data-bs-toggle="modal" data-bs-target="#editarusuario">Editar <i class="bi bi-zoom-in"></i></a>
			    					</td>
			    				</tr>

			    				<tr>
			    					<td>Francisco</td>
			    					<td>Pérez</td>
			    					<td>La Vuelta Al Mundo</td>			    					
			    					<td>franciscolam</td>	
			    					<td>fperez01</td>
			    					<td>Agencia</td>
			    					<td>Habilitado</td>	    								    					
			    					<td>
			    						<a class="btntab" data-bs-toggle="modal" data-bs-target="#editarusuario">Editar <i class="bi bi-zoom-in"></i></a>
			    					</td>
			    				</tr>

-->
			    			</tbody>
			    		</table>
			    </div>	 		

		 	</main>
		  </div>


	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Agencia</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="altausuario.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="apeido" placeholder="Apellidos" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" name="agencia" required>
					        		<option>Selecciona la Agencia</option>
					        <?php
					        $recorrido="SELECT * from agencias order by nombre ";

							$arrayagencias=mysqli_query($connection,$recorrido);  		
					         while ($renglon = mysqli_fetch_array($arrayagencias))

	                           {



      						  // echo '<option value='.$renglon['fecha'].'>'.$renglon['fecha'].'</option>'; 

					 		echo '<option value="'.$renglon['nombre'].'" >'.$renglon['nombre'].'</option>';


    						  }		
    						  ?>			        		
					        	</select>
				        	</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>
			      			
			      			<div class="col-md-12">
			      				<input type="text" name="correo" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" class="inpmodagreg" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="usuario" placeholder="Usuario" class="inpmodagreg" required>
			      			</div>    

			      			<div class="col-md-12">
			      				<input type="text" name="contra" placeholder="Contraseña" class="inpmodagreg" required>
			      			</div> 

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" name="tipo" required>
					        		<option>Tipo de Usuario</option>
	       					 		<option value="0">Super usuario</option>
							 		<option value="1">Agencia</option>
							 		<option value="2">Ventas</option>
							 		<option value="3">Invitado</option>
					        						        		
					        	</select>
				        	</div>

			      			<div class="col-md-12">				        		
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Firma Electrónica</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-3" id="file-3" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-3">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Tarjetas de Presentación</span>
								</label>
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
			<div class="modal fade" id="editarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			      				<input type="text" name="" placeholder="Nombre" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Apellidos" class="inpmodagreg" required>
			      			</div>

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
			      				<input type="text" name="" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>
			      			
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="" class="inpmodagreg" required>
			      			</div>			      		
				        	 
				        	<div class="col-md-12">
			      				<input type="text" name="" placeholder="Usuario" class="inpmodagreg" required>
			      			</div>    

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Contraseña" class="inpmodagreg" required>
			      			</div> 

			      			<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Tipo de Usuario</option>
					        		<option>Agencia</option>
					        		<option>Administrador</option>
					        		<option>Invitado</option>				        						        		
					        	</select>
				        	</div>

			      			<div class="col-md-12">				        		
				        		<input type="file" name="file-4" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-4">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Firma Electrónica</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="file" name="file-5" id="file-5" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-5">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Tarjetas de Presentación</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<select class="inpmodagreg" required>
					        		<option>Estatus</option>
					        		<option>Habilitado</option>
					        		<option>Deshabilitado</option>			        						        		
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