<?php
session_start();

if(isset($_POST['accion'])){
    include_once('../classes/SqlSrv.class.php');
}else{
    include_once('classes/SqlSrv.class.php');
}


$sql = new SqlSrv();

if($_POST['accion'] == 'registrar'){
   
    //print_r($_REQUEST);
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $numero = $_POST['numero'];
    $provincia = $_POST['provincia'];
    $provincia_nombre = $_POST['provincia_nombre'];
    $localidad = $_POST['localidad'];
    $localidad_nombre = $_POST['localidad_nombre'];
    $HorarioDesde = $_POST['HorarioDesde'];
    $HorarioHasta = $_POST['HorarioHasta'];
    $AbiertoDias_nombre = $_POST['AbiertoDias_nombre'];
	
	$direccion_google = $direccion.' '.$numero .', ' . $localidad_nombre .', ' . $provincia_nombre .', Argentina ';
	try{
		$resultado = file_get_contents(sprintf('http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s', urlencode($direccion_google)));
		$resultado = json_decode($resultado, TRUE);

		$lat = $resultado['results'][0]['geometry']['location']['lat'];
		$lng = $resultado['results'][0]['geometry']['location']['lng'];

	}catch(Exception $e){

		echo "alert('". $e->getMessage()."')";
	}
	
	$horario = $AbiertoDias_nombre.' de '.$HorarioDesde.'hs a '.$HorarioHasta.'hs';
    
    $query = "INSERT INTO [priceline].[dbo].[Supermercado] VALUES
           ('".$nombre."'
           ,'".$direccion."'
           ,'".$numero."'
           ,'".$localidad."'
           ,'".$provincia."'
           ,'".$lat."'
           ,'".$lng."'
           ,'".$horario."'
           ,'0')";
		   
    $ok = $sql->query($query);
	
	if($ok){
                $query = "INSERT INTO [priceline].[dbo].[Supermercado_log] VALUES
					   ((SELECT MAX(idSupermercado) FROM [priceline].[dbo].[Supermercado])
					   ,'".$nombre."'
					   ,'".$direccion."'
					   ,'".$numero."'
					   ,'".$localidad."'
					   ,'".$provincia."'
					   ,'".$lng."'
					   ,'".$lat."'
					   ,'".$horario."'
					   ,'0'
					   ,'".$_SESSION['usuario_email']."'
					   ,'".date('Y-m-d')."'
					   ,'A')";

                $ok = $sql->query($query);
            }
    
    echo $query;    
    
}