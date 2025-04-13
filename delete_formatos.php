<?php



$id=$_GET['id'];




//$weburl=$_POST['weburl'];

//$visible=$_POST['visible'];
foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}

echo $_POST;




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

$insertar="DELETE FROM formatos WHERE id='".$id."'";


//$insertar="UPDATE usuarios SET id_user='1',nombre='".$nombre."',apeido='".$apeido."',psw='".$contrasena."',user='".$usuario."',nivel='".$tipo."',agencia='".$agencia."',telefono='".$telefono."',correo='".$correo."',habilitado='".$tipo2."' WHERE nombre='".$nombre."'";

//$insertar="INSERT INTO usuarios (id_user,nombre,psw,user,nivel,agencia,telefono,correo,habilitado) VALUES ('1','".$nombre."','".$contrasena."','".$usuario."','".$tipo."','".$agencia."','".$telefono."','".$correo."','".$tipo2."')";



//$insertar="INSERT INTO usuarios (nombre) VALUES ('".$nombre."')";



if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';

	header("location: delete_for_correcto.php");

}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: delete_fly_error.php");

}



mysqli_close($connection);

?>



