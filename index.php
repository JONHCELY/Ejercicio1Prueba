<?php 
require_once('Conections/db.php');
$fecha = date('d/m/Y');
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


?>
<script type="text/javascript">
function GuardarRegistro(){         
    document.form1.action = 'mostrarDatos.php?tipoguardar=GuardarDatos';
    document.form1.submit();		
}    
function ConsultarDatos(){         
    document.form1.action = 'mostrarDatos.php?tipoguardar=ConsultarDatos';
    document.form1.submit();   		
} 
</script>
<html>
    <head>
        <title>Prueba PHP</title>    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
        <link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1.custom/jquery-ui.css">
        <script src="jquery-3.5.1.min.js"></script>
        <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>   
        <link rel="stylesheet" type="text/css" href="css/estilos.css"> 
    </head>
    <body>
        <form action="" method="post" name="form1" id="form1">
        <table width="900" align="center" class="encabezado" id="">
            <thead>
                <tr>
                    <td align="center"><h5>Informacion Personal</h5></td>
                </tr>                   
            </tbody>        
        </table>
        <table width="900" align="center" class="" id="">
            <thead>               
                <tr align="center">
                    <td><b>Nombre</b></td>                    
                    <td><input id="nombre" name="nombre" type="text" class=""></td>                    
                </tr>  
                <tr align="center">
                    <td><b>Apellido</b></td>                    
                    <td><input id="apellido" name="apellido" type="text" class=""></td>                    
                </tr>  
                <tr align="center">
                    <td><b>Cedula</b></td>                    
                    <td><input  id="cedula" name="cedula" type="text" class=""></td>                    
                </tr>  
                <tr align="center">
                    <td><b>Correo</b></td>                    
                    <td><input  id="correo" name="correo" type="text" class=""></td>                    
                </tr>  
                <tr align="center">
                    <td><b>Lenguajes</b></td>                    
                    <td><input  id="lenguajes" name="lenguajes" type="text" class=""></td>                    
                </tr>  
                <tr align="center">
                    <td><b>Fecha de Creacion</b></td>
                    <td><input  type="text" id="fecha" name="fecha" readonly="" ></td>
                </tr>                                   
            </tbody>                  
        </table><br>
        <table width="900" align="center">
            <tr align="center">
                <td>
                    <button type="button" id="btnguardarregistro" onclick="GuardarRegistro()"> Guardar</button>
                    <h4>Solo guarda Datos</h4>
                </td>                
            </tr>     
            <tr align="center">
                <td>
                <button type="button" id="Consultar" onclick="ConsultarDatos()"> Consultar Datos</button>
                <h4>Consulta los programadores Guardados</h4>
                </td>                
            </tr>  
        </table><br>         

        <table width="900" align="center">         
            <tr align="center">              
                <td class="enviar"><input type="button" value="Formato Json">
                <h4>Muestra en formato json y guarda registro</h4>
            </td>                
            </tr>                 
            <tr>  
                <td class="respuesta"></td>          
            </tr>                 
        </table>    
        </form>
    </body>
</html>
<script>
$(function() {
    $(document).ready(function(){
        $("#fecha").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange:'2000:' + 2021,
                dateFormat:"dd-mm-yy"                     
            });
    });
} ); 
</script>
<script>
$(".enviar").click(function(e) {
	e.preventDefault();
	var nombre = $("#nombre").val(),
	apellido = $("#apellido").val(),	
	cedula = $("#cedula").val(),	
	correo = $("#correo").val(),	
	lenguajes = $("#lenguajes").val(),	
	fecha = $("#fecha").val(),	
	datos = {   "nombre":nombre,
                "apellido":apellido,
                "cedula":cedula,
                "correo":correo,
                "lenguajes":lenguajes,
                "fecha":fecha 
            };
	$.ajax({
		url: "formatoJson.php",
		type: "POST",
		data: datos
	}).done(function(respuesta){
		if (respuesta.estado === "Usuario Registrado Con Exito") {
			console.log(JSON.stringify(respuesta));
			var nombre = respuesta.nombre,
			apellido = respuesta.apellido,		
			cedula = respuesta.cedula,		
			correo = respuesta.correo,		
			lenguajes = respuesta.lenguajes,		
			fecha = respuesta.fecha		
			$(".respuesta").html("Servidor:<br><pre>"+JSON.stringify(respuesta, null, 2)+"</pre>");
		}
	});
});
</script>
