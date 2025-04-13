<?php



$nombre=$_POST['nombre'];

$tipo=$_POST['tipo'];

$fecha=$_POST['fecha'];

$apeido=$_POST['apeido'];

$usuario=$_POST['usuario'];

$contra=$_POST['contra'];

$agencia=$_POST['agencia'];

$telefono=$_POST['telefono'];

$correo=$_POST['correo'];

$habilitado='0';

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



$insertar="INSERT INTO usuarios (nombre,apeido,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('".$nombre."','".$apeido."','".$contra."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$habilitado."')";



//$insertar="INSERT INTO webinnars (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: usuario_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: usuario_error.php");

}



mysqli_close($connection);

?>



