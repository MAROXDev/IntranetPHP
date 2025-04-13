<?php



$nombre=$_POST['nombre'];

$titular=$_POST['titular'];

$fecha=$_POST['fecha'];

$direccion=$_POST['direccion'];

$usuario=$_POST['usuario'];

$contra=$_POST['contra'];

$estado=$_POST['estado'];

$telefono=$_POST['telefono'];

$correo=$_POST['correo'];

$rfc=$_POST['rfc'];

$dominio=$_POST['dominio'];

$tipo=$_POST['tipo'];



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



$insertar="INSERT INTO agencias (nombre,direccion,titular,estado,telefono,rfc,fechaalta,correo,dominio,tipo) VALUES ('".$nombre."','".$direccion."','".$titular."','".$estado."','".$telefono."','".$rfc."','".$fecha."','".$correo."','".$dominio."','".$tipo."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: agencia_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: agencia_error.php");

}



mysqli_close($connection);

?>



