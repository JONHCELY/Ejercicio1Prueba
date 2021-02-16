<?php
require_once('Conections/db.php');
$queryM = "INSERT INTO programador (
    id,
    nombre,
    apellido,
    cedula,
    correo,
    lenguajes,
    fecha                                          
    )
    values
    (
    NULL,                                            
    '".$_POST['nombre']."',
    '".$_POST['apellido']."',
    '".$_POST['cedula']."',
    '".$_POST['correo']."',
    '".$_POST['lenguajes']."',
    '".$_POST['fecha']."'
    )";
$queryRsExecute = mysqli_query($conexion, $queryM) or die(mysqli_error($conexion));
$query_RsUltInsert = "SELECT LAST_INSERT_ID() DATO";
$RsUltInsert       = mysqli_query($conexion,$query_RsUltInsert) or die(mysqli_error($conexion));   

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$cedula = $_POST["cedula"];
$correo = $_POST["correo"];
$lenguajes = $_POST["lenguajes"];
$fecha = $_POST["fecha"];

header('Content-Type: application/json');
$datos = array(
    'estado' => 'Usuario Registrado Con Exito',
    'nombre' => $nombre, 
    'apellido' => $apellido,
    'cedula' => $cedula,
    'correo' => $correo,
    'lenguajes' => $lenguajes,
    'fecha' => $fecha
);

echo json_encode($datos, JSON_FORCE_OBJECT);
?>