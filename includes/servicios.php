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
		<title>Proveedores Gani</title>
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
		 	<img src="img/proveedores/portada.jpg" width="100%">
		  	<!--***BOTÓNES PROVEEDORES***-->
			<div class="container text-center contbtnprov">
			  <div class="row">
					<div class="col-md-4">
						<a href="proveedores.php">
							<center>
								<div class="col-md-12 btnproveedor">
									<h3 class="avenir-medium">Proveedores</h3>
								</div>
							</center>							
						</a>
					</div>

					<div class="col-md-4">
						<a href="servicios.php">
							<center>
								<div class="col-md-12 btnproveedor menuactive">
									<h3 class="avenir-medium">Servicios</h3>
								</div>
							</center>
						</a>
					</div>

					<div class="col-md-4">
						<a href="consumibles.php">
							<center>
								<div class="col-md-12 btnproveedor">
									<h3 class="avenir-medium">Consumibles</h3>
								</div>
							</center>
						</a>
					</div>					
			   </div>
			</div>


			<!--***INICIA PROVEEDORES***-->
			<div class="container contproveedores">
			  <div class="row">

			  		
			  		<?php 
					$query = "SELECT * from proveedores where categoria = 'Servicios'";
                	$queryResult = mysqli_query($connection, $query);
			  	 	while($item = mysqli_fetch_assoc($queryResult)) {
                              ?>
                              	<div class="col-md-4">						
							<div class="col-md-12 cuadproveedor">
								<a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank">
									<?php echo '<img src="img/proveedores/p'.$item['id'].'.jpg" class="imgprov">'; ?>
									
									<span class="avenir-regular descprov">
                    				<?php echo htmlspecialchars($item['tipo']); ?></span><br>
									<?php if ($item['numero'] !== null) { ?>
                    <span class="naranja avenir-regular">
                        <?php echo htmlspecialchars($item['numero']); ?>
                    </span>
                <?php } else { ?>
                    <br>
                <?php } ?>
								</a>
								<?php
								$consulta="SELECT * from usuarios where user='".$usuario."' ";
								$resultado=mysqli_query($connection,$consulta);
								$colum = mysqli_fetch_array($resultado);
								$tipo=$colum['nivel'];

								
								if ($tipo=='0') {
	
						echo '<div class="col-md-12">
									<button data-bs-toggle="modal" data-bs-target="#'.$item['id'].'" class="btneditadm"><i class="bi bi-pencil-fill"></i></button>
									<button class="btneliminaradm" data-bs-toggle="modal" data-bs-target="#elimina'.$item['id'].'"><i class="bi bi-trash3-fill"></i></button>
								</div>';
								}	

							echo'</div>
						
							</div>'	;

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
<!-- VENTANA MODAL EDITAR -->
<div class="modal fade" id="'.$item['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 naranja">Editar Proveedor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 30px;">
                    <form method="post" action="mod_proveedores.php?id='.$item['id'].'&page=2" enctype="multipart/form-data" id="editForm_'.$item['id'].'">
                        <div class="col-md-12">
                            <input type="text" name="nombre" id="nombre_'.$item['id'].'" value="'.$item['nombre_proveedor'].'" class="inpmodagreg" required>
                            
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="tipo" id="tipo_'.$item['id'].'" value="'.$item['tipo'].'" class="inpmodagreg" required>
                            
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="link" id="link'.$item['id'].'" value="'.$item['link'].'" class="inpmodagreg" required>
                        </div>

                        <div class="col-md-12"> 
    						<input type="text" name="numero" id="numero'.$item['id'].'" value="'.$item['numero'].'" class="inpmodagreg" required>
    
						</div>

                        <div class="col-md-12">
                            <p>Fecha de registro</p>
                            <input type="date" name="fecha" value="'.$item['fecha'].'" class="inpmodagreg" required>
                        </div>

                        <div class="col-md-12">
                            <select name="categoria" class="inpmodagreg" required>
                                <option>'.$item['categoria'].'</option>
                                <option>Turístico</option>
                                <option>Servicios</option>
                                <option>Consumibles</option>
                            </select>
                        </div>   

                        <div class="col-md-12">
                            <p>Tamaño del logo 300px X 130 px</p>
                            <label for="provlogo_'.$item['id'].'">Subir Logo</label>
                            <input type="file" id="provlogo_'.$item['id'].'" name="provlogo" accept="image/png, image/jpeg" />
                        </div>

                        <div class="col-md-12">
                            <center>
                                <button class="btnagrmod" id="submitBtn_'.$item['id'].'">Editar Proveedor</button>
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
    const tipoInput = document.getElementById("tipo_'.$item['id'].'");
    const comisionInput = document.getElementById("comision_'.$item['id'].'");
    const fileInput = document.getElementById("provlogo_'.$item['id'].'");
    const submitBtn = document.getElementById("submitBtn_'.$item['id'].'");

    function validarNombreTipo(input) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9.,\s]+$/;
        if (!regex.test(input.value.trim())) {
            input.classList.add("is-invalid");
            return false;
        } else {
            input.classList.remove("is-invalid");
            return true;
        }
    }

    function validarComision(input) {
        const regex = /^\d+(\.\d+)?$/; 
        const valor = parseFloat(input.value.trim()); 
        if (!regex.test(input.value.trim()) || isNaN(valor) || valor < 0 || valor > 100) {
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
        const esNombreValido = validarNombreTipo(nombreInput);
        const esTipoValido = validarNombreTipo(tipoInput);
        const esComisionValida = validarComision(comisionInput);
        const esImagenValida = validarImagen(fileInput);
        submitBtn.disabled = !(esNombreValido && esTipoValido && esComisionValida && esImagenValida);
    }

    nombreInput.addEventListener("input", validarFormulario);
    tipoInput.addEventListener("input", validarFormulario);
    comisionInput.addEventListener("input", validarFormulario);
    fileInput.addEventListener("change", validarFormulario);
});
</script>
';
			echo '
			<!--******* VENTANA MODAL ELIMINAR*******-->
			<div class="modal fade" id="elimina'.$item['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Eliminar Proveedor</h2>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<div class="row" style="padding: 30px;">
			      		<form  method="post" action="delete_proveedores.php?id='.$item['id'].'&page=2" enctype="multipart/form-data">		
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


		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>