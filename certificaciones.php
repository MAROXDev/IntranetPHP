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
?>

<!DOCTYPE html>
<html lang="">
	<head>
		<title>Certificaciones Gani</title>
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
		 	<img src="img/certificaciones/portada.jpg" width="100%">
		  	
			<!--***INICIA HERRAMIENTAS***-->
			<div class="container text-center contcorporativo">
			  <div class="row">

			  		<h2 class="avenir-medium naranja tituloseccion">Certificaciones</h2>

			  		<?php
			  		$query = "SELECT * from certificados";
					$queryResult = mysqli_query($connection, $query);
					$nom=1;
					while ($item = mysqli_fetch_assoc($queryResult)) {
						$nom=$nom+1;
						$link = $item['liga'];
						// Ensure the link starts with http:// or https://
						if (!preg_match('/^https?:\/\//', $link)) {
    					$link = 'https://' . $link;
					}

						echo '<div class="col-md-12 cuadcertificado">
						<div class="row">
							<div class="col-md-4">
								<img src="img/certificaciones/1.jpg" class="imgherramientas">	
							</div>	
							<div class="col-md-8 cuadcertext">
									<h2 class="avenir-medium naranja tituloherramienta">' . htmlspecialchars($item['titulo']) . '</h2>
									<p class="avenir-regular descprov txtherramienta">									
										' . htmlspecialchars($item['descripcion']) . '
									</p>
									<a href="' . htmlspecialchars($link) . '" target="_blank">
    									<div class="btnherramientas avenir-medium btncertificacion">
        									Acceder
    									</div>
									</a>

									<div class="col-md-12">
										<button data-bs-toggle="modal" data-bs-target="#'.$nom.'" class="btneditadm"><i class="bi bi-pencil-fill"></i></button>
										<button class="btneliminaradm" data-bs-toggle="modal" data-bs-target="#eliminarcertificacion'.$nom.'"><i class="bi bi-trash3-fill"></i></button>
									</div>
							</div>
						</div>									
							
			   			</div>';
			   			echo '

			   			
	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Certificación</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="mod_certificado.php?id='.$item['id'].'" enctype="multipart/form-data">
			      		<input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
			      			<div class="col-md-12">
			      				<input type="text" name="titulo" value="'.$item['titulo'].'" placeholder="Título de la Certificación" class="inpmodagreg" id="titulo_'.$item['id'].'" required>
			      			</div>

			      			<div class="col-md-12">
				        		<input type="text" name="descripcion" value="'.$item['descripcion'].'" placeholder="Descripción" class="inpmodagreg" id="descripcion_'.$item['id'].'" required>
				        	</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" value="'.$item['fecha'].'" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<input type="text" name="liga" value="'.$item['liga'].'"  placeholder="Link de la Certificación" class="inpmodagreg" id="link_'.$item['id'].'" required>
				        	</div>
			      			

			      			<div class="col-md-12">
				        		<p>Tamaño del Flyer 1,500 x 830 px</p>
				        		<input type="file" name="file-2" id="file-2-'.$item['id'].'" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Adjuntar Imagen</span>
								</label>
				        	</div>			      		
			      			

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod" id="submitBtn_'.$item['id'].'">Editar Certificación</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				       
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

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
			<script>
document.addEventListener("DOMContentLoaded", function () {
    const tituloInput = document.getElementById("titulo_'.$item['id'].'");
    const descripcionInput = document.getElementById("descripcion_'.$item['id'].'");
    const linkInput = document.getElementById("link_'.$item['id'].'");
    const fileInput = document.getElementById("file-2-'.$item['id'].'");
    const submitBtn = document.getElementById("submitBtn_'.$item['id'].'");

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
    function validarImagen(input) {
        const maxSize = 2 * 1024 * 1024; // 2MB en bytes
        if (input.files.length > 0) {
            const file = input.files[0];
            if (file.size > maxSize) {
                alert("El tamaño de la imagen es demasiado grande. Máximo permitido: 2MB.");
                input.value = ""; // Limpia el campo
                return false;
            }
        }
        return true;
    }

    function validarLink(input) {
        const regex = /^(https?:\/\/)?([\w\-]+\.)+[\w]{2,}(\/[\w\-._~:/?#[\]@!$&\'()*+,;=%]*)?$/i;
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
        const esDescripcionValido = validarNombreTipo(descripcionInput, document.getElementById("error-tipo_'.$item['id'].'"));
        const esLinkValido = validarLink(linkInput);
        const esImagenValida = validarImagen(fileInput);
        submitBtn.disabled = !(esTituloValido && esDescripcionValido && esLinkValido && esImagenValida);
    }

    tituloInput.addEventListener("input", validarFormulario);
    descripcionInput.addEventListener("input", validarFormulario);
    linkInput.addEventListener("input", validarFormulario);
    fileInput.addEventListener("change", validarFormulario);
});
</script>


			';
			echo '
<div class="modal fade" id="eliminarcertificacion'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 naranja">Eliminar Certificación</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 30px;">
                    <form method="post" action="delete_certificado.php?id='.$item['id'].'" enctype="multipart/form-data"> 
                    <input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
                        <center>
                            <div class="col-md-12">                      
                                <h3>¿Estás seguro de eliminarlo?</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="confirmar" class="btnconfirmar">Confirmar</button>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" data-bs-dismiss="modal" class="btncancelar">Cancelar</button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
';
					}
			  			
			  		  ?>
					
			</div>

		  </div>
		<?php
			require_once('includes/footer.php');
		?>


		<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editarcertificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Certificación</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre de la Certificación" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Descripción" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Link de la Certificación" class="inpmodagreg" required>
			      			</div>			      		
				        	
				        	<div class="col-md-12">
				        		<p>Tamaño de la imagen 1500 x 830 px</p>
				        		<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" multiple />
								<label for="file-2">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Logo de la Certificación</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Certificación</button>
				        		</center>				        		
				        	</div>				        	
				        </form>				        
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

			<!--******* VENTANA MODAL ELIMINAR*******-->
			<div class="modal fade" id="eliminarcertificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Eliminar Certificación</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>		
			      			<center>	      			
				      			<div class="col-md-12">			      				
				      				<h3>¿Estás seguro de eliminarlo?</h2>				      				
				      			</div>
				      			<div class="row">
				      				<div class="col-md-12">
					      				<button class="btnconfirmar">Confirmar</button>
					      			</div>

					      			<div class="col-md-12">
					      				<button data-bs-dismiss="modal" class="btncancelar">Cancelar</button>
					      			</div>
				      			</div>				      			
				      		</center>
				        </form>
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>