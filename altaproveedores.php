<?php



$nombre=$_POST['nombre'];

$comision=$_POST['comision'];

$fecha=$_POST['fecha'];

$tipo=$_POST['tipo'];

$categoria=$_POST['categoria'];

$link=$_POST['link'];

$numero=$_POST['numero'];

//$visible='Si';



//echo $nombre;



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



$insertar="INSERT INTO proveedores (nombre_proveedor,tipo,fecha,comision,categoria,link,numero) VALUES ('".$nombre."','".$tipo."','".$fecha."','".$comision."','".$categoria."','".$link."','".$numero."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

// Sube Archivo logo
	$tool_id = mysqli_insert_id($connection);

							$agencia2=str_replace(' ', '', $_POST['agencia']) ;

			 				//$var_nom_firma=$_FILES['file-2']['name'];
							$var_nom_logo='p'.$tool_id.'.jpg';
							$var_tmp_logo=$_FILES['file-2']['tmp_name'];
							
							
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

	header("location: proveedores_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: proveedores_error.php");

}



mysqli_close($connection);

?>



