<?php

include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();
$localidades = $sql->fetchArray("select l.Nombre + ' - ' + d.Nombre + ' - ' +  p.Nombre as Nombre from 
  Provincia p inner join Departamento d on p.ID = d.idProvincia
  inner join Localidad l on l.idDepartamento = d.ID where l.Nombre like '%".$_REQUEST['term']."%'
  order by p.ID, d.ID ,l.ID");

$lista_loc = '[';
foreach ($localidades as $loc){
    $lista_loc.= '"'.$loc['Nombre'].'",';
}

 $lista_loc = substr($lista_loc, 0 , -1);
echo $lista_loc.']';