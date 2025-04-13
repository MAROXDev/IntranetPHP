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

<?php 
	$query = "SELECT * from directorio";
    $queryResult = mysqli_query($connection, $query);

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



<!DOCTYPE html>
<html lang="">
	<head>
		<title>Directorio Gani</title>
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
		 	<img src="img/directorio/portada.jpg" width="100%">
		  	<!--***BOTÓNES PROVEEDORES***-->
			<div class="container text-center contbtnprov">
			  <div class="row">
					<div class="col-md-6">
						<a href="directorio.php">
							<center>
								<div class="col-md-12 btndirectorio menuactive">
									<h3 class="avenir-medium">Gani Corporativo</h3>
								</div>
							</center>							
						</a>
					</div>

					<div class="col-md-6">
						<a href="directorioprov.php">
							<center>
								<div class="col-md-12 btndirectorio">
									<h3 class="avenir-medium">Proveedores</h3>
								</div>
							</center>
						</a>
					</div>
								
			   </div>
			</div>


			<!--***INICIA DIRECTORIO***-->
			<div class="container contdirectorio">
			  <div class="row">
			  			
			  		<?php  
$nom = 1;

while ($item = mysqli_fetch_assoc($queryResult)) {
    $nom = $nom + 1;

    $proveedor = $item['proveedor'] ?? ''; // Obtener el proveedor actual
	$selectedGani = ($proveedor === "Gani Corporativo") ? 'selected' : '';
	$selectedProveedores = ($proveedor !== "Gani Corporativo" && !empty($proveedor)) ? 'selected' : '';


    echo '<div class="col-md-6">
        <div class="col-md-12 cuadirectorio">
            <!-- Name -->
            <p class="avenir-regular descprov txtdirectorio">
                <i class="bi bi-person icondirectorio"></i>' . htmlspecialchars($item['nombre']) . ' <!-- Display dynamic name -->
            </p>
            <!-- Phone -->
            <p class="avenir-regular descprov txtdirectorio">
                <i class="bi bi-telephone icondirectorio"></i>' . htmlspecialchars($item['telefono']) . ' <!-- Display dynamic phone -->
            </p>
            <!-- Email -->
            <p class="avenir-regular descprov txtdirectorio">
                <i class="bi bi-envelope icondirectorio"></i>' . htmlspecialchars($item['correo']) . ' <!-- Display dynamic email -->
            </p>


            <!-- Edit/Delete Buttons -->';
								$consulta="SELECT * from usuarios where user='".$usuario."' ";
								$resultado=mysqli_query($connection,$consulta);
								$colum = mysqli_fetch_array($resultado);
								$tipo=$colum['nivel'];

								
								if ($tipo=='0') {
	
	            echo' <div class="col-md-12">
                <button data-bs-toggle="modal" data-bs-target="#' . $nom . '" class="btneditadm">
                    <i class="bi bi-pencil-fill"></i>
                </button>
                <button class="btneliminaradm" data-bs-toggle="modal" data-bs-target="#eliminardirectorio' . $nom . '">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>';
        }

        echo '</div>						
    </div>';

    // edit
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
    <div class="modal fade" id="' . $nom . '" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Directorio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de edición -->
                        <form  method="post" action="mod_directorio.php?id='.$item['id'].'" enctype="multipart/form-data">
			      		<input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
			      			<div class="col-md-12">
			      				<input type="text" name="nombre" placeholder="Nombre del usuario" value="'.$item['nombre'].'" class="inpmodagreg" id="nombre_'.$item['id'].'" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="cargo" value="'.$item['cargo'].'" id="cargo_'.$item['id'].'" placeholder="Cargo" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="text" name="telefono" id="telefono_'.$item['id'].'" value="'.$item['telefono'].'" placeholder="Teléfono" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12">
			      				<input type="mail" name="correo" id="correo_'.$item['id'].'" value="'.$item['correo'].'" placeholder="Correo Electrónico" class="inpmodagreg" required>
			      			</div>

			      			<div class="col-md-12"> 
                            <select id="opcdirectorioedit_' . $nom . '" class="inpmodagreg" name="proveedores">
                                <option value="Gani Corporativo" ' . $selectedGani . '>Gani Corporativo</option>
                                <option value="proveeedit" ' . $selectedProveedores . '>Proveedores</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <select id="proveedoresedit_' . $nom . '" class="inpmodagreg" name="proveedoresedit" ' . ($selectedProveedores ? '' : 'disabled') . '>
                                <option selected disabled>' . htmlspecialchars($item["proveedor"]) . '</option>
                                ' . $proveedoresOptions . '
                            </select>     
                        </div>

			 
				        	<div class="col-md-12">
				        		<center>
				        			<button class="btnagrmod" id="submitBtn_'.$item['id'].'">Editar Directorio</button>
				        		</center>				        		
				        	</div>				        	
				        </form>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const nombreInput = document.getElementById("nombre_'.$item['id'].'");
    const cargoInput = document.getElementById("cargo_'.$item['id'].'");
    const telefonoInput = document.getElementById("telefono_'.$item['id'].'");
    const correoInput = document.getElementById("correo_'.$item['id'].'");
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
    



    function validarFormulario() {
        const esNombreValido = validarNombreTipo(nombreInput, document.getElementById("error-nombre_'.$item['id'].'"));
        const esTipoValido = validarNombreTipo(tipoInput, document.getElementById("error-tipo_'.$item['id'].'"));
        const esComisionValida = validarComision(comisionInput);
        submitBtn.disabled = !(esNombreValido && esTipoValido && esComisionValida);
    }

    nombreInput.addEventListener("input", validarFormulario);
    tipoInput.addEventListener("input", validarFormulario);
    comisionInput.addEventListener("input", validarFormulario);
});
</script>

        ';
        // delete
    echo '<div class="modal fade" id="eliminardirectorio' . $nom . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5 naranja">Eliminar Directorio</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding: 30px;">
                            <form method="post" action="delete_directorio.php?id='.$item['id'].'" enctype="multipart/form-data">		
                                <center>	      			
                                    <div class="col-md-12">			      				
                                        <h3>¿Estás seguro de eliminarlo?</h3>				      				
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btnconfirmar">Confirmar</button>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" data-bs-dismiss="modal" class="btncancelar">Cancelar</button>
                                        </div>
                                    </div>				      			
                                </center>
                                <input type="hidden" name="origin" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
                                <input type="hidden" name="id" value="' . $item['id'] . '" />
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
			<div class="modal fade" id="editardirectorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Editar Usuario</h2>
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


			<!--******* VENTANA MODAL ELIMINAR*******-->
			<div class="modal fade" id="eliminardirectorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title fs-5 naranja">Eliminar Directorio</h2>
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

			<script>
    const firstSelect = document.getElementById('opcdirectorioedit');
    const secondSelect = document.getElementById('proveedoresedit');

    firstSelect.addEventListener('change', function() {
        secondSelect.disabled = !this.value; // Disable if value is empty
    });
</script>

			


		<!--***BOOTSTRAP JS***-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>