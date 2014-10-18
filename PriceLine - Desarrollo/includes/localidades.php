<?php

include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();
$localidades = $sql->fetchArray("select l.Nombre+' - '+p.Nombre as NombreCompleto,l.Nombre as Nombre, l.idDepartamento idSupermercado from 
  Provincia p inner join Departamento d on p.ID = d.idProvincia
  inner join Localidad l on l.idDepartamento = d.ID where l.Nombre like '%".$_REQUEST['term']."%'
  order by p.ID, d.ID ,l.ID");
  
$a_json = array();
$a_json_row = array();
//print_r($productos);die();

foreach($localidades as $row) {
  $a_json_row["id"] = $row['idSupermercado'];
  $a_json_row["Nombre"] = $row['Nombre'];
  $a_json_row["value"] = $row['NombreCompleto'];
  array_push($a_json, $a_json_row);
  
}
//print_r($a_json);
$json = json_encode($a_json);

echo $json;