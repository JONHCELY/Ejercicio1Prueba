<?php 
require_once('Conections/db.php');

$nombre = '';
$apellido = '';
$cedula = '';
$correo = '';
$lenguajes = '';
$fecha = '';

if(isset($_POST['nombre']) && $_POST['nombre'] != ''){
	$nombre = $_POST['nombre'];
}
if(isset($_POST['apellido']) && $_POST['apellido'] != ''){
	$apellido = $_POST['apellido'];
}
if(isset($_POST['cedula']) && $_POST['cedula'] != ''){
	$cedula = $_POST['cedula'];
}
if(isset($_POST['correo']) && $_POST['correo'] != ''){
	$correo = $_POST['correo'];
}
if(isset($_POST['lenguajes']) && $_POST['lenguajes'] != ''){
	$lenguajes = $_POST['lenguajes'];
}
if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
    $fecha = $_POST['fecha'];    
}

if (isset($_GET['tipoguardar']))
	$tipoguardar=$_GET['tipoguardar'];
else $tipoguardar = "";

$query_Concatenar = " SELECT 
                            p.id id,
                            p.nombre nombre,
                            p.apellido apellido,
                            p.cedula cedula,
                            p.correo correo,
                            p.lenguajes lenguajes,
                            p.fecha fecha
                        FROM programador p ";

$Concatenar = mysqli_query($conexion, $query_Concatenar) or die(mysqli_error($conexion));
$row_Concatenar = mysqli_fetch_assoc($Concatenar);
$totalRows_Concatenar = mysqli_num_rows($Concatenar);	

$array_concatenar = array();
do{array_push($array_concatenar, $row_Concatenar);
}while($row_Concatenar = mysqli_fetch_assoc($Concatenar)); 

function insertar($conexion){
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
}

if ($tipoguardar == 'GuardarDatos')
{
    $cedulaRepetida ='';
    foreach($array_concatenar as $row_Concatenar){
        $cedulaRepetida =$row_Concatenar['cedula'];    
    }

    if ($_POST['cedula'] == ''){  
        echo '<script type="text/javascript">';
        echo 'alert("Por favor ingrese numero de cedula");';    
        echo 'window.location.href = "index.php"';    
        echo '</script>';    
    }else{
        if ($cedulaRepetida == $_POST['cedula']){  
            echo '<script type="text/javascript">';
            echo 'alert("El usuario ingresado ya existe Por favor valide los datos");';    
            echo 'window.location.href = "index.php"';    
            echo '</script>';    
        }else{
            insertar($conexion);    
            echo '<script type="text/javascript">';
            echo 'alert("Usuario Guardado Con exito, para validar ingrese a Consultar Datos");';    
            echo 'window.location.href = "index.php"';    
            echo '</script>';  
        }   
    }
}
?>
<script>
    function regresar(){   
        window.location.href = 'index.php';                		
    } 
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loosb.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    <script src="jquery-3.5.1.min.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>	1
<table width="900" align="center" id="dataTable"> 
	<tr>				
		<?php            
		if ($tipoguardar == 'ConsultarDatos')
		{
			if ($totalRows_Concatenar > 0) {
                ?>
                <tr class = "encabezado"  align="center">                    
                    <td>id</td>                    
                    <td>Nombre</td>                    
                    <td>Apellido</td>                    
                    <td>Cedula</td>                    
                    <td>Correo</td>                    
                    <td>Lenguajes</td>                    
                    <td>Fecha de Creación</td>                                        
                </tr>  
                <?php
				foreach($array_concatenar as $row_Concatenar){                    
				?>                               
                <tr align="center" >                                                           
                    <td id="id"> <?php echo($row_Concatenar['id']);?></td>                    
                    <td id="nombre"> <?php echo($row_Concatenar['nombre']);?></td>                    
                    <td id="apellido"> <?php echo($row_Concatenar['apellido']);?></td>                    
                    <td id="cedula"> <?php echo($row_Concatenar['cedula']);?></td>                    
                    <td id="correo"> <?php echo($row_Concatenar['correo']);?></td>                    
                    <td id="lenguajes"> <?php echo($row_Concatenar['lenguajes']);?></td>                    
                    <td id="fecha"> <?php echo($row_Concatenar['fecha']);?></td>                                        
                </tr>                                 
			<?php
				}
			}else{
                echo '<script type="text/javascript">';
                echo 'alert("No existen Datos para Mostrar");';    
                echo 'window.location.href = "index.php"';    
                echo '</script>'; 
            }
		}
        ?>
            </td>		
        </tr>
    </table><br><br>    
    <table width="900" align="center">
        <tr align="center" >                                                                       
            <td><b>Total Programadores registrados</b></td>            
        </tr> 
        <tr align="center" >                                                                                   
            <td> <?php echo($totalRows_Concatenar);?></td>
        </tr>         
    </table> <br>
    <table width="900" align="center">	
    <tr align="center">  
            <td><button class="button" type="button" id="regresar" onclick="regresar()"> Regresar</button></td>            
        </tr>                 
    </table>  
</body>
</html>
