<?php


include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();

if(isset($_POST['prov'])){
    
    $provincia = $sql->fetchArray("select p.ID , p.Nombre as Nombre from 
      Provincia p  order by p.ID");
    
    if(isset($_POST['val'])){
        $val = $_POST['val'];
    }else{
        $val = '';
    }
    
    $prov = "<option value=''>- Seleccione una provincia -</option>";
    foreach ($provincia as $loc){
        if($loc['ID'] == $val){
            $select = "selected";
        }else{
            $select = '';
        }
        $prov .="<option value='".$loc['ID']."' ".$select." >".$loc['Nombre']."</option>";
    }

    echo $prov;

}

if(isset($_POST['loc'])){
    
    $prov = $_POST['provincia'];
    
    if(isset($_POST['val'])){
        $val = $_POST['val'];
    }else{
        $val = '';
    }
    $localidad = $sql->fetchArray("select p.ID , p.Nombre as Nombre from 
      Departamento p where p.idProvincia = ".$prov."  order by p.Nombre");

    $prov = "<option value=''>- Seleccione una localidad -</option>";
    foreach ($localidad as $loc){
        if($loc['ID'] == $val){
            $select = "selected";
        }else{
            $select = '';
        }
        $prov .="<option value='".$loc['ID']."' ".$select." >".$loc['Nombre']."</option>";
    }

    echo $prov;

}