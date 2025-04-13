<?php



$nombre=$_POST['nombre'];

$cargo=$_POST['cargo'];

$telefono=$_POST['telefono'];

$correo=$_POST['correo'];

$proveedor=!empty($_POST['proveedores']) ? $_POST['proveedores'] : "Gani Corporativo";



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



$insertar="INSERT INTO directorio (nombre,cargo,telefono,correo,proveedor) VALUES ('".$nombre."','".$cargo."','".$telefono."','".$correo."','".$proveedor."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: directorio_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: directorio_error.php");

}



mysqli_close($connection);

?>



