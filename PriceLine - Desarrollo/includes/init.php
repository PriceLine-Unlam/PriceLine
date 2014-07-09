<?php

include('classes/SqlSrv.class.php');

$sql = new SqlSrv();
$productos = $sql->fetchArray("SELECT DISTINCT (Nombre +' - '+ Marca) Nombre from Producto"); //devuelve un array

foreach ($productos as $prod){
    $lista_prod .= '"'.$prod['Nombre'].'",';
}


$vistos_prod = $sql->fetchArray("SELECT TOP 8 (Nombre +' - '+ Marca) Nombre , Foto from Producto ORDER BY Visitado desc"); //devuelve un array


//print_r($vistos_prod);exit();
