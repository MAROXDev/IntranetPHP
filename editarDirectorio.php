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
    echo "No se ha podido encontrar la Db";
}
else
{
    //echo "Tabla seleccionada" ;
}


?>



<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores enviados por el formulario
    $id = $_POST['id']; // ID del usuario
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $proveedor = $_POST['proveedor'];

    // Consulta SQL para actualizar los datos
    $query = "UPDATE directorio 
              SET nombre = '$nombre', cargo = '$cargo', telefono = '$telefono', correo = '$correo', proveedor = '$proveedor' 
              WHERE id = $id";

    // Ejecutar la consulta
    if (mysqli_query($connection, $query)) {
        // Si la actualización fue exitosa, redirigir a la página de lista o mostrar un mensaje
        header("Location: directorio.php"); // Redirigir al listado de directorio
        exit();
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($connection);
    }
}
?>
