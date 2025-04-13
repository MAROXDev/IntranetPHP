<?php

$id=$_GET['id'];

$page=$_GET['page'];

$nombre=$_POST['nombre'];

$comision=$_POST['comision'];

$fecha=$_POST['fecha'];

$categoria=$_POST['categoria'];

$tipo=$_POST['tipo'];

$visible='Si';




//$weburl=$_POST['weburl'];

//$visible=$_POST['visible'];
foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}




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

 echo "Hemos conectado al servidor <br>" ;

}



$db = mysqli_select_db($connection,"cortega_pueblosmagicos");



if (!$db)

{

	 echo "No se ha podido encontrar la Tabla";

}

else

{

 echo "Tabla seleccionada" ;

} 

$insertar="UPDATE proveedores SET fecha='".$fecha."',nombre_proveedor='".$nombre."',categoria='".$categoria."',tipo='".$tipo."',comision='".$comision."' WHERE id='".$id."'";

//$insertar="INSERT INTO usuarios (id_user,nombre,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('1','".$nombre."','".$contrasena."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$tipo2."')";



//$insertar="INSERT INTO usuarios (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

// Sube Archivo logo
//	$tool_id = mysqli_insert_id($connection);

							$agencia2=str_replace(' ', '', $_POST['agencia']) ;

			 				//$var_nom_firma=$_FILES['file-2']['name'];
							$var_nom_logo='p'.$id.'.jpg';
							$var_tmp_logo=$_FILES['provlogo']['tmp_name'];
							
							
							$varnombrecarpeta='img/proveedores/';
												

							// sube foto portada

							if (!file_exists(''.$varnombrecarpeta)) {
								mkdir(''.$varnombrecarpeta,0777,true);
								move_uploaded_file($var_tmp_logo,''.$varnombrecarpeta.'/'.$var_nom_logo);

								if (!file_exists(''.$varnombrecarpeta)) {
									if (!move_uploaded_file($var_tmp_logo,''.$varnombrecarpeta.'/'.$var_nom_logo)) {
										echo "Lo Sentimos el Archivo no se ha podido cargar ";
									}else{ 
										//echo "El Archivo se cargo con exito";
									}
								}

							}else{
								if (!move_uploaded_file($var_tmp_logo,''.$varnombrecarpeta.'/'.$var_nom_logo)) {
									echo "Lo Sentimos el Archivo no se ha podido cargar";
								}else{ 
									//echo "El Archivo se cargo con exito";
								} 

							}








	echo '<script>alert("Registro Completo");</script>';

	if ($page=='2') {
	header("location: proveedores.php");	
	} else {
		header("location: mod_prov_correcto.php");
	}

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: mod_prov_error.php");

}



mysqli_close($connection);

?>



