<?php

include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();
$productos = $sql->fetchArray("SELECT DISTINCT (Nombre +' - '+ Marca) Nombre from Producto where Nombre +' '+ Marca like '%".$_REQUEST['term']."%' "); //devuelve un array

$lista_prod = '[';

foreach ($productos as $prod){
    $lista_prod .= '"'.$prod['Nombre'].'",';
}
 $lista_prod = substr($lista_prod, 0 , -1);
echo $lista_prod.']';