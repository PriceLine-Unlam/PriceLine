<?php

include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();
$productos = $sql->fetchArray("SELECT (Nombre +' - '+ Marca + '  ' + Cantidad) Nombre , idProducto from Producto where (Nombre +' '+ Marca) like '%".$_REQUEST['term']."%' "); //devuelve un array

$a_json = array();
$a_json_row = array();
//print_r($productos);die();

foreach($productos as $row) {
  $a_json_row["id"] = $row['idProducto'];
  $a_json_row["value"] = $row['Nombre'];
  $a_json_row["label"] = $row['Nombre'];
  array_push($a_json, $a_json_row);
  
}
//print_r($a_json);
$json = json_encode($a_json);

echo $json;

