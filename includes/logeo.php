<?php
	session_start();
	$usuario=$_SESSION['usuario'];
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

$consulta="SELECT * from usuarios where user='".$usuario."'";
$resultado=mysqli_query($connection,$consulta);
					
$total=mysqli_num_rows($resultado);

	
	if ($total == '0')
	{
		header("location: http://viajesreveilduleon.com/intranetnativa/acceso.php");
		exit();

		//echo 'aqui si esta';
	}else
	{
		//echo 'apertura exitosa';
	}
?>

