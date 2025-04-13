<?php

$id=$_GET['id'];

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

//$proveedor=$_POST['proveedoresedit'];

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

$insertar="UPDATE agencias SET nombre='".$nombre."',direccion='".$direccion."',titular='".$titular."',estado='".$estado."',telefono ='".$telefono."',rfc='".$rfc."',fechaalta='".$fecha."',correo='".$correo."',dominio ='".$dominio."',tipo ='".$tipo."' WHERE id='".$id."'";

//$insertar="INSERT INTO usuarios (id_user,nombre,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('1','".$nombre."','".$contrasena."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$tipo2."')";



//$insertar="INSERT INTO usuarios (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: mod_age_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: mod_age_error.php");

}



mysqli_close($connection);

?>



