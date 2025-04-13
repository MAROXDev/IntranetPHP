<?php

$enlace=$_POST['enlace'];

$nombre=$_POST['nombre'];

$tipo=$_POST['tipo'];

$fecha=$_POST['fecha'];

$unidad=$_POST['unidad'];

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



$insertar="INSERT INTO sala_de_aprendizaje (titulo,fecha_creacion,tipo,unidad,enlace) VALUES ('".$nombre."','".$fecha."','".$tipo."','".$unidad."','".$enlace."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: sala_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: sala_error.php");

}



mysqli_close($connection);

?>



