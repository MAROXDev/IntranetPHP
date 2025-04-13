<?php

$id=$_GET['id'];

$nombre=$_POST['nombre'];

$cargo=$_POST['cargo'];

$telefono=$_POST['telefono'];

$correo=$_POST['correo'];

$proveedor = !empty($_POST['proveedoresedit']) ? $_POST['proveedoresedit'] : "Gani Corporativo";



$origin = $_POST['origin']; 

//$visible='Si';




//$weburl=$_POST['weburl'];

//$visible=$_POST['visible'];
foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}




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

 echo "Hemos conectado al servidor <br>" ;

}



$db = mysqli_select_db($connection,"cortega_pueblosmagicos");



if (!$db)

{

	 echo "No se ha podido encontrar la Tabla";

}

else

{

 echo "Tabla seleccionada" ;

} 

$insertar="UPDATE directorio SET cargo='".$cargo."',nombre='".$nombre."',telefono='".$telefono."',correo='".$correo."',proveedor='".$proveedor."' WHERE id='".$id."'";

//$insertar="INSERT INTO usuarios (id_user,nombre,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('1','".$nombre."','".$contrasena."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$tipo2."')";



//$insertar="INSERT INTO usuarios (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';


	// Check if the origin exists and decide the redirection
if (strpos($origin, 'admindirectorio.php') !== false) {
    // If it comes from admindirectorio.php, redirect to a specific file
    header("Location: mod_dir_correcto.php");
} elseif (strpos($origin, 'directorio.php') !== false) {
    // If it comes from directorio.php, redirect back to directorio
    header("Location: directorio.php");
} else {
    // Fallback redirection if the origin is not identified
    header("Location: directorio.php");
}
exit;

	

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: mod_dir_error.php");

}



mysqli_close($connection);

?>



