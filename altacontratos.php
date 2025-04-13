<?php



$nombre=$_POST['nombre'];

$destino=$_POST['destino'];

$fecha=$_POST['fecha'];

//$correo=$_POST['correo'];

//$proveedor=$_POST['proveedores'];

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



$insertar="INSERT INTO contratos (nombre,fecha) VALUES ('".$nombre."','".$fecha."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: contratos_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: flyer_error.php");

}



mysqli_close($connection);

?>



