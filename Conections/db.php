<?php
    $hostname = "localhost";
    $database = "JonhCely";
    $username = "root";
    $password = "";
    $conexion = mysqli_connect($hostname, $username,$password,$database); 
    mysqli_query($conexion, 'SET time_zone = "-05:00"');
    $conexion->set_charset("utf8"); 
?>