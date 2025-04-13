<?php



$nombre=$_POST['titulo'];

$descripcion=$_POST['descripcion'];

$fecha=$_POST['fecha'];

$liga=$_POST['liga'];

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



$insertar="INSERT INTO certificados (titulo,descripcion,fecha,liga) 
VALUES ('".$nombre."','".$descripcion."','".$fecha."','".$liga."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: certificado_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: certificado_error.php");

}



mysqli_close($connection);

?>



