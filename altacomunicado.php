<?php



$titulo=$_POST['titulo'];

//$provedor=$_POST['provedor'];

$fecha="10/01/01";

$tipo=$_POST['tipo'];

$link=$_POST['link'];

$visible='';


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



//$insertar="INSERT INTO comunicados (id,titulo,fecha_creacion,tipo,liga) VALUES ('NULL','".$titulo."','".$fecha."','".$tipo."','".$link."')";
$insertar="INSERT INTO comunicados (titulo,fecha_creacion,tipo,liga) VALUES ('".$titulo."','".$fecha."','".$tipo."','".$link."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: comunicado_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: comunicado_error.php");

}



mysqli_close($connection);

?>



