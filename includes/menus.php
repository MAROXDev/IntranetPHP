
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
			echo '
				<a href="administrador.php">
					<div class="btnadministrador" title="Modulo Administrador Gani">
						<i class="bi bi-gear-fill"></i>
					</div>
				</a> ';
			}
	?>									

		
 		



<!--***MENÚ PRINCIPAL***-->
		<nav class="navbar navbar-expand-lg bg-body-tertiary menu1">
		    <div class="container-fluid">
		    <?php 	
		      echo '<a class="navbar-brand" href="#"><img src="
		      	img/agencias/'.$agencia.'/logo.png" width="250px"></a>';
		      ?>	
		      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>
		      <div class="collapse navbar-collapse" id="navbarNav">
			      <div class="container text-center">
				      <div class="row">
					       <div class="col-md-8">
					         <h2 class="naranja avenir-bold">BIENVENIDO</h2> 
					        </div>
					        <div class="col-md-4">
					          <h3 class="naranja avenir-medium"><?php echo $colum['nombre']; ?> <?php echo $colum['apeido']; ?><a href="http://viajesreveilduleon.com/intranetnativa/cerrarsesion.php"><i class="bi bi-box-arrow-in-right naranja"></i></a></h3> 
					        </div>
				     </div>
			    </div>
			   </div>
			</div>
		  </nav>

		  <?php 
		  	$pagina=$_GET['pagina'];

		   ?>

	<!--***MENÚ SECUNDARIO***-->
	<nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Twelfth navbar example" id="navajustado">
      <div class="container-fluid containlinks">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExample10" style="">
          <ul class="navbar-nav">
            <li class="nav-item">
            	<?php	
            	if ($pagina=='1') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="index.php?pagina=1"><i class="bi bi-house-door-fill iconhouse"></i></a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="index.php?pagina=1"><i class="bi bi-house-door-fill iconhouse"></i></a>		';
            	}
            	
               ?>
            </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='2') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="proveedores.php?pagina=2">Proveedores</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="proveedores.php?pagina=2">Proveedores</a>		';
            	}
            	
               ?>



		        <!--<a class="nav-link avenir-medium navbco" href="proveedores.php">Proveedores</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='3') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="directorio.php?pagina=3">Directorio</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="directorio.php?pagina=3">Directorio</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="directorio.php">Directorio</a>--></li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='4') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="corporativo.php?pagina=4">Corporativo</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="corporativo.php?pagina=4">Corporativo</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="corporativo.php">Corporativo</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='5') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="promocionales.php?pagina=5">Promocionales</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="promocionales.php?pagina=5">Promocionales</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="promocionales.php">Promocionales</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='6') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="herramientas.php?pagina=6">Herramientas</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="herramientas.php?pagina=6">Herramientas</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="herramientas.php">Herramientas</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='7') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="sala.php?pagina=7">Sala de Aprendizaje</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="sala.php?pagina=7">Sala de Aprendizaje</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="sala.php">Sala de Aprendizaje</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='8') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="capacitaciones.php?pagina=8">Capacitaciones</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="capacitaciones.php?pagina=8">Capacitaciones</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="capacitaciones.php">Capacitaciones</a>-->
		    </li>
		    <li class="nav-item">
		    	<?php	
            	if ($pagina=='9') {
            		echo '<a class="nav-link menuactive avenir-medium navbco" aria-current="page" href="certificaciones.php?pagina=9">Certificaciones</a>		';
            	} else {
            		echo '<a class="nav-link avenir-medium navbco" aria-current="page" href="certificaciones.php?pagina=9">Certificaciones</a>		';
            	}
            	
               ?>
		        <!--<a class="nav-link avenir-medium navbco" href="certificaciones.php">Certificaciones</a>-->
		     </li>
          </ul>
        </div>
      </div>
    </nav>
