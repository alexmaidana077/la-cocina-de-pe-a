<?php 
$mysql= new mysqli(
    "localhost",
    "root",
    "",
    "cocina"
);
if ($mysql->connect_error){
    die("no funciona".$mysql->connect_error);
    echo "Error en el codigo mysql o conexion";
}else{
    
}
?>