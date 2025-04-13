<?php



$nombre=$_POST['nombre'];

$provedor=$_POST['provedor'];

$fecha=$_POST['fecha'];

$tipo=$_POST['tipo'];

$weburl=$_POST['weburl'];

$visible='Si';



echo $nombre;



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



$insertar="INSERT INTO webinnars (nombre,provedor,fecha,tipo,weburl,visible) VALUES ('".$nombre."','".$provedor."','".$fecha."','".$tipo."','".$weburl."','".$visible."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: webinar_error.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: webinar_error.php");

}



mysqli_close($connection);

?>



