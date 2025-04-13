
<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
</head>
<body><?php   

session_start(); //to ensure you are using same session
$usuario=" ";
$_SESSION["usuario"]=$usuario;
echo $_SESSION['usuario'];
session_start();
echo $_SESSION['usuario'];

header("location: http://viajesreveilduleon.com/intranetnativa/index.php"); //to redirect back to "index.php" after logging out
exit();

?>
</body>
</html>