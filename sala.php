<?php

session_start();
$usuario=$_SESSION['usuario'];
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
    echo "No se ha podido encontrar la Db";
}
else
{
    //echo "db seleccionada" ;
}

					$consulta="SELECT * from modulos ";
					$resultado=mysqli_query($connection,$consulta);
					
					




?>


<!DOCTYPE html>
<html lang="">
	<head>
		<title>Sala de Aprendizaje Gani</title>
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
		 	<img src="img/sala/portada.jpg" width="100%">
		  	<!--***BOTÓNES PROVEEDORES***-->
			<div class="container text-center contbtnprov">
			  <div class="row">
					<div class="col-md-12">						
							<center>
								<div class="col-md-12 modulotitulo menuactive">
									<h2 class="avenir-medium">Sala de Aprendizaje</h2>
								</div>
							</center>					
					</div>
								
			   </div>
			</div>


			<!--***INICIA DIRECTORIO***-->
			<?php
									$consulta3="SELECT * from usuarios where user='".$usuario."' ";
									$resultado3=mysqli_query($connection,$consulta3);
									$colum3 = mysqli_fetch_array($resultado3);
									$tipo=$colum3['nivel'];


			  ?>
			<div class="container contdirectorio bckgrisclaro">
			  <div class="row">
					<div class="col-md-12">									
							<div class="col-md-12 cuadcontsala">
								<div class="col-md-12">
									<?php if ($tipo=='0') { ?>									
									

					 				<a data-bs-toggle="modal" data-bs-target="#agregarmodulo">
					 					<div class="btnadmagregar btnmodsala">
					 						Agregar Módulo <i class="bi bi-plus-circle-fill"></i> 
					 					</div>
					 				</a>
					 			<?php } ?>
					 			</div>	

					 			
								<?php 
								 	$consulta="SELECT * from modulos ";
					$resultado=mysqli_query($connection,$consulta);
									$nom=0;
								   while ($item=mysqli_fetch_array($resultado)) {
								   	$nom=$nom+1;
			

									echo '
									<h3 class="avenir-medium naranja titmodulo">'.$item['modulo'].'';

									if ($tipo=='0') {

								   	
									echo '<a class="" data-bs-toggle="modal" data-bs-target="#e'.$nom.'"> <i class="bi bi-x-circle-fill icondelete"></i></a>';
								}

									echo '</h3>

								<!--******* VENTANA MODAL ELIMINAR*******-->
								<div class="modal fade" id="e'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-sm">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h2 class="modal-title fs-5 naranja">Eliminar Proveedor</h2>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								      	<div class="row" style="padding: 30px;">
								      			<center>	      			
									      			<div class="col-md-12">			      				
									      				<h3>¿Estás seguro de eliminarlo?</h2>				      				
									      			</div>
									      			<div class="row">
									      			<form  method="post" action="delete_modulo.php?id='.$item['id'].'&page=2" enctype="multipart/form-data">		
								      		
									      				<div class="col-md-12">
										      				<button class="btnconfirmar">Confirmar</button>
										      			</div>
										      		</form>	


										      			<div class="col-md-12">
										      				<button data-bs-dismiss="modal" class="btncancelar">Cancelar</button>
										      			</div>
									      			</div>				      			
									      		</center>
									      	
									        
								      	</div>			        
								      </div>
								      
								    </div>
								  </div>
								</div>';
							
																					
									$consulta2="SELECT * from sala_de_aprendizaje WHERE unidad = '".$item['modulo']."'";
									$resultado2=mysqli_query($connection,$consulta2);
									while ($item2=mysqli_fetch_array($resultado2)) {

										if ($item2['tipo']=='Enlace') {
									    echo '<a href="'.$item2['enlace'].'" target="_blank">
											<p class="avenir-regular descprov salasub">									
												'.$item2['titulo'].'
											</p>
										</a>';
										
										
										}else if ($item2['tipo'] == "Documento") {
        									
        								$files = glob("files/sala/" . $item2['id'] . ".*");
    if (!empty($files)) {
        $displayName = $item2['titulo'];
        $id = $item2['id'];
        // Construye la URL amigable: documentos/{id}/{titulo}.pdf
        echo '<a href="documentos/' . $id . '/' . urlencode($displayName) . '.pdf" target="_blank">
                <p class="avenir-regular descprov salasub">' . htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') . '</p>
              </a>';
    }
              							
    									} else {
										echo '<a data-bs-toggle="modal" href="#'.$item2['id'].'">
											<p class="avenir-regular descprov salasub">									
												'.$item2['titulo'].'
											</p>
										</a>';
										
											
										}
										


								echo '<!-- ******Modal INICIO*****-->
								<div class="modal fade" id="'.$item2['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								      	<center>
								      		<h5 class="modal-title avenir-medium naranja">'.$item2['titulo'].'</h5>
								      	</center>								        
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body modbod">

                                               <div class="col-md-12">

                                                      <p class="infosala avenir">

	                                  					'.$item2['enlace'].'
                                                       </p> 

                                                      

                                               </div>

                                          </div>
								      
								    </div>
								  </div>
								</div>						
								<!-- ******MODAL FIN*****-->';





									}


								   }

								 ?>		
								 <!--			 		
								<h3 class="avenir-medium naranja">Aspectos Básicos</h3>
								<a data-bs-toggle="modal" href="#modal1-1">
									<p class="avenir-regular descprov salasub">									
										1.1 ¿Qué es la Sala de Aprendizaje?
									</p>
								</a>

								<a data-bs-toggle="modal" href="#modal1-1">
									<p class="avenir-regular descprov salasub">									
										1.2 ¿Cómo opera Gani Viajes con sus Franquicias?

									</p>
								</a>	

								<a data-bs-toggle="modal" href="#modal1-1">
									<p class="avenir-regular descprov salasub">									
										1.3 ¿Qué características debe cumplir una Agencia de Viajes para ser exitosa?

									</p>
								</a>

								<a data-bs-toggle="modal" href="#modal1-1">
									<p class="avenir-regular descprov salasub">									
										1.4 Historia del Turismo

									</p>
								</a>-->

							<!-- ******Modal INICIO*****-->
								<div class="modal fade" id="modal1-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								      	<center>
								      		<h5 class="modal-title avenir-medium naranja">¿Qué es la Sala de Aprendizaje?</h5>
								      	</center>								        
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body modbod">

                                               <div class="col-md-12">

                                                      <p class="infosala avenir">

                                                      Una agencia de viajes es aquella empresa privada o negocio cuya función es organizar y vender productos turísticos y se considera como el primer eslabón del turismo.<br><br>

                                                       La persona más importante en este negocio es el “AGENTE DE VIAJES”, quien puede hacer de un viaje la experiencia más inolvidable en la vida de una persona o de una familia. <br><br>

                                                      La Agencia de viajes es el intermediario entre el cliente o consumidor final y el producto turístico (ya sean hoteles, líneas aéreas, servicios de transporte, circuitos, entradas a parques de diversiones, etc.). 

                                                      Las agencias de viajes son un modelo de negocio muy rentable, porque la utilidad se genera por el valor más importante que el ser humano puede dar que es el “servicio”. <br><br>

                                                      La experiencia y el trato de un agente consultor de GANI viajes enamora a un cliente que busca el descanso, el esparcimiento, los viajes corporativos, de trabajo y los viajes familiares y de placer; un agente de viajes se convierte en el fabricante de sueños, porque él sugiere y asesora el lugar ideal para disfrutar del viaje al máximo, ya que le ofrecerá todo lo que necesita un turista para tener una experiencia única.<br><br>

                                                      Las agencias de viajes nacen como el facilitador de todo lo que un cliente desea para hacer un viaje inolvidable sin importar el motivo que lo lleva a desplazarse desde su lugar donde tiene su residencia, hasta el lugar deseado o muchas veces sugerido por un profesional agente consultor de viajes. <br><br>

                                                      Las agencias de viajes son y serán un intermediario muy seguro y confiable que todo turista necesita para realizar el viaje deseado.

                                                      Como cultura general, la primera agencia de viajes nace en Inglaterra en el siglo XIX por Thomas Cook, quien se conoce como el padre del turismo y de los famosos cheques de viajero.

                                                       </p> 

                                                      

                                               </div>

                                          </div>
								      
								    </div>
								  </div>
								</div>						
								<!-- ******MODAL FIN*****-->
							</div>
					</div>	

			   </div>
			</div>

		  </div>

		<!--***INICIA FOOTER***-->
		<?php
			require_once('includes/footer.php');
		?>


<style>
						.btnagrmod:disabled {
    						background-color: gray !important;
    						cursor: not-allowed;
    						opacity: 0.5;
    						box-shadow: none !important;
						}


    .is-invalid {
        border: 2px solid red !important;
        border-color: red !important;
    }
    .is-invalid:focus {
        border-color: red !important;
        outline: none !important;
       
    }
</style>
	<!--******* VENTANA MODAL AGREGAR*******-->
			<div class="modal fade" id="agregarmodulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Agregar Módulo</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form method="post" action="altamodulo.php" enctype="multipart/form-data">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Título Del Módulo"
			      				id="" class="inpmodagreg" required>
			      			</div>
			      					
				        	        	
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod" id="submitBtn">Agregar Módulo</button>
				        		</center>				        		
				        	</div>
				        	
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

			<script>
function openFileInNewTab(fileUrl, displayName) {
    // Abre una nueva ventana
    var newWindow = window.open('', '_blank');
    // Escribe un HTML simple que establezca el título y embeba el PDF
    newWindow.document.write(
        '<html>' +
            '<head>' +
                '<title>' + displayName + '</title>' +
                '<style>html, body { margin: 0; height: 100%; }</style>' +
            '</head>' +
            '<body>' +
                '<embed src="' + fileUrl + '" type="application/pdf" width="100%" height="100%">' +
            '</body>' +
        '</html>'
    );
    newWindow.document.close();
}
</script>

			<script>
document.addEventListener("DOMContentLoaded", function () {
    const tituloInput = document.getElementById("titulo");
    const submitBtn = document.getElementById("submitBtn");

    function validarNombreTipo(input, errorElement) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9.,\s]+$/;
        
        if (!regex.test(input.value.trim())) {
            input.classList.add("is-invalid");
          
            return false;
        } else {
            input.classList.remove("is-invalid");
            
            return true;
        }
    }
    



    function validarFormulario() {
        const esTituloValido = validarNombreTipo(tituloInput, document.getElementById("error-nombre_'.$item['id'].'"));
        submitBtn.disabled = !(esTituloValido);
    }

    tituloInput.addEventListener("input", validarFormulario);

});
</script>


		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>