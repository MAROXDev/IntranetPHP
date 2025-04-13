<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
</head>
<body>

<?php

$usuario=$_POST['usuario'];
$password=$_POST['password'];



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

$consulta="SELECT * from usuarios where user='".$usuario."' AND psw='".$password."' AND habilitado='0'";
$resultado=mysqli_query($connection,$consulta);
					
$total=mysqli_num_rows($resultado);


if ($total == '0')
{
	

	echo "usuario o contraseña incorrecta";
        header("Location: acceso_error.php");
}
else
{
	echo "usuario encontrado";

	session_start();
	$_SESSION["usuario"] = $usuario;
	header("Location: bienvenida.php");
	

}

?>

</body>
</html>