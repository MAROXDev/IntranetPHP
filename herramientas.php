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
		<title>Herramientas</title>
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
		 	<img src="img/herramientas/portada.jpg" width="100%">
		  	
			<!--***INICIA HERRAMIENTAS***-->
			<div class="container text-center contcorporativo">
			  <div class="row">

			  		<h2 class="avenir-medium naranja tituloseccion">Herramientas para Profesionales</h2>

			  		<?php
$query = "SELECT * from herramientas";
$queryResult = mysqli_query($connection, $query);
$nom=1;
while ($item = mysqli_fetch_assoc($queryResult)) {
	$nom=$nom+1;
    echo '
    <div class="col-md-4">
        <center>						
            <div class="col-md-12 cuadherramientas">
                <!-- Image -->
                <a href="' . $item['link_aplicacion'] . '"" target="_blank">
        			<img src="img/herramientas/' . $item['id'] . '.jpg?' . time() . '" class="imgherramientas">
    			</a>
                <!-- Dynamic Name -->
                <h2 class="avenir-bold naranja tituloherramienta">' . htmlspecialchars($item['nombre']) . '</h2>
                <!-- Dynamic Description -->
                <p class="avenir-regular descprov txtherramienta">' . htmlspecialchars($item['descripcion']) . '</p>';
                

                //BOTÓN DE EDITAR Y ELIMINAR
             $consulta="SELECT * from usuarios where user='".$usuario."' ";
                                $resultado=mysqli_query($connection,$consulta);
                                $colum = mysqli_fetch_array($resultado);
                                $tipo=$colum['nivel'];

                                
                                if ($tipo=='0') {
    

                        echo '<div class="col-md-12">
                                    <button data-bs-toggle="modal" data-bs-target="#' . $nom . '" class="btneditadm">
					                        <i class="bi bi-pencil-fill"></i>
					                    </button>
					                    <button class="btneliminaradm" data-bs-toggle="modal" data-bs-target="#eliminarherramienta' . $item['id'] . '">
					                    <i class="bi bi-trash3-fill"></i>
					                </button>
                                </div>';
                                }                           
                            

                 echo '<a href="' . htmlspecialchars($item['link']) . '" target="_blank">
        			<div class="btnherramientas avenir-medium">
            			Ver Tutorial
        			</div>
      			</a>
	
            </div>
        </center>
    </div>';
    echo '
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
	<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="'.$nom.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Herramienta</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="mod_herramienta.php?id='.$item['id'].'" enctype="multipart/form-data">
			      		<input type="hidden" name="id" value="' .$item['id']. '">
			      		<input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" value="'.$item['nombre'].'" id="nombre_'.$item['id'].'" placeholder="Nombre de la Herramienta" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
				        		<input type="text" name="descripcion" id="descripcion_'.$item['id'].'" value="'.$item['descripcion'].'" placeholder="Descripción" class="inpmodagreg" required>
				        	</div>

			      			<div class="col-md-12">
			      				<p>Fecha de registro</p>
			      				<input type="date" name="fecha" value="'.$item['fecha'].'" class="inpmodagreg" required>
			      			</div>

							<div class="col-md-12">
				        		<input type="text" name="link" value="'.$item['link'].'" id="link_'.$item['id'].'" placeholder="Link del tutorial" class="inpmodagreg" required>
				        	</div>

				        	<div class="col-md-12">
				        		<input type="text" name="link_aplicacion" value="'.$item['link_aplicacion'].'"
				        		 id="link_aplicacion_'.$item['id'].'" placeholder="Link de la aplicación" class="inpmodagreg" required>
				        	</div>

				        	<div class="col-md-12">
				        		<p>Tamaño de la imagen 1000 x 1000 px</p>
				        		<input type="file" name="file-3" id="file-3-'.$item['id'].'" class="inputfile inputfile-2" />
								<label for="file-3-'.$item['id'].'">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Adjuntar Imagen</span>
								</label>
				        	</div>
			      			



				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod" id="submitBtn_'.$item['id'].'">Editar Herramienta</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
				       
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const nombreInput = document.getElementById("nombre_'.$item['id'].'");
    const descripcionInput = document.getElementById("descripcion_'.$item['id'].'");
    const linkInput = document.getElementById("link_'.$item['id'].'");
    const fileInput = document.getElementById("file-3-'.$item['id'].'");
   
    const submitBtn = document.getElementById("submitBtn_'.$item['id'].'");

    function validarNombreCargo(input) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9.,\s]+$/;
        if (!regex.test(input.value.trim())) {
            input.classList.add("is-invalid");
            return false;
        } else {
            input.classList.remove("is-invalid");
            return true;
        }
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

    function validarFormulario() {
        const esNombreValido = validarNombreCargo(nombreInput);
        const esDescripcionValido = validarNombreCargo(descripcionInput);
        const esLinkValido = validarLink(linkInput);
        const esImagenValida = validarImagen(fileInput);

        submitBtn.disabled = !(esNombreValido && esDescripcionValido && esLinkValido && esImagenValida);
    }

    nombreInput.addEventListener("input", validarFormulario);
    descripcionInput.addEventListener("input", validarFormulario);
    linkInput.addEventListener("input", validarFormulario);
    fileInput.addEventListener("change", validarFormulario);
    
});
</script>

			';
			echo '<div class="modal fade" id="eliminarherramienta' . $item['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 naranja">Eliminar Herramienta</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" style="padding: 30px;">
          <!-- Eliminar formulario -->
          <form  method="post" action="delete_herramienta.php?id='.$item['id'].'" enctype="multipart/form-data">
            <!-- Campo oculto con el ID -->
            <input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
            <input type="hidden" name="id" value="' . $item['id'] . '">
            <center>
              <div class="col-md-12">
                <h3>¿Estás seguro de eliminar esta herramienta?</h3>
              </div>
              <div class="row">
                <!-- Botón Confirmar -->
                <div class="col-md-12">
                  <button type="submit" class="btnconfirmar">Confirmar</button>
                </div>
                <!-- Botón Cancelar -->
                <div class="col-md-12">
                  <button type="button" class="btncancelar" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>';
}
?>

			   </div>
			</div>

		  </div>

		<!--***INICIA FOOTER***-->
		<?php
			require_once('includes/footer.php');
		?>


		<!--******* VENTANA MODAL EDITAR*******-->
			<div class="modal fade" id="editarherramienta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Herramienta</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form>
			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Nombre de la Herramienta" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Descripción" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="" placeholder="Link del Tutorial" class="inpmodagreg" required>
			      			</div>			      		
				        	
				        	<div class="col-md-12">
				        		<p>Tamaño de la imagen 1000 x 1000 px</p>
				        		<input type="file" name="file-3" id="file-3" class="inputfile inputfile-2" />
								<label for="file-3">
								<i class="bi bi-upload"></i>
								<span class="iborrainputfile">Adjuntar Imagen</span>
								</label>
				        	</div>

				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod">Editar Herramienta</button>
				        		</center>				        		
				        	</div>				        	
				        </form>				        
			      	</div>			        
			      </div>
			      
			    </div>
			  </div>
			</div>

			<!--******* VENTANA MODAL ELIMINAR*******-->
			<div class="modal fade" id="eliminarherramienta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Eliminar Herramienta</h2>
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