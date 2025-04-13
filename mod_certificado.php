<?php

$id=$_GET['id'];

$titulo=$_POST['titulo'];

$liga=$_POST['liga'];

$fecha=$_POST['fecha'];

$descripcion=$_POST['descripcion'];

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

$insertar="UPDATE certificados SET titulo='".$titulo."',liga='".$liga."',descripcion='".$descripcion."',fecha='".$fecha."' WHERE id='".$id."'";

//$insertar="UPDATE comunicados SET fecha='".$fecha."',nombre='".$nombre."',weburl='".$weburl."',tipo='".$tipo."',provedor='".$provedor."',visible='".$visible."' WHERE id='".$id."'";




if (mysqli_query($connection,$insertar))

{

	echo '<script>alert("Registro Completo");</script>';



if (strpos($origin, 'admincertificaciones.php') !== false) {
    header("Location: mod_cer_correcto.php");
} elseif (strpos($origin, 'certificaciones.php') !== false) {
    header("Location: certificaciones.php");
} else {
    header("Location: certificaciones.php");
}
exit;


}	

else 

{

	echo '<script>alert("Error en el Registro, Intentalo Nuevamente");</script>';

	header("location: mod_cer_error.php");

}



mysqli_close($connection);

?>



