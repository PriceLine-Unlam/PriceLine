<?php
session_start();

if(isset($_POST['accion'])){
    include_once('../classes/SqlSrv.class.php');
}else{
    include_once('classes/SqlSrv.class.php');
}


$sql = new SqlSrv();

if($bandeja == 'sin_usuario' ){
    
    $datos[] = '';
	$query = " 	SELECT D.Nombre+' - '+P.Nombre as provincia FROM Departamento D
				INNER JOIN Provincia P ON D.idProvincia = P.ID
				WHERE D.ID = '".base64_decode($_GET[idLocalidad])."' ";
	$datosUsr = $sql->fetchArrayMultiple($query);
	
	$resultado = file_get_contents(sprintf('http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s', urlencode($datosUsr[0][0][provincia])));
	$resultado = json_decode($resultado, TRUE);

	$lat = $resultado['results'][0]['geometry']['location']['lat'];
	$lng = $resultado['results'][0]['geometry']['location']['lng'];
	
	$datosUsr[0][0][Latitud] = $lat;
	$datosUsr[0][0][Longitud] = $lng;
    
}

if($bandeja == 'usuario_login' ){
    
    $datos[] = '';
	$query = " 	SELECT Direccion, Nro, P.Nombre+' - '+D.Nombre AS provincia, Latitud, Longitud  FROM Usuarios U
				INNER JOIN Departamento D ON U.Localidad = D.ID
				INNER JOIN Provincia P ON D.idProvincia = P.ID
				WHERE U.Email = '".$_SESSION['usuario_email']."' ";
	$datosUsr = $sql->fetchArrayMultiple($query);
	
}

if($_POST['accion'] == 'generarLink'){
   
    //print_r($_REQUEST);
    $idLocalidad = base64_encode($_POST['idLocalidad']);
    $idProducto = base64_encode($_POST['idProducto']);
    
    echo "window.location.href='ResultadoBusqueda.php?idProducto=".$idProducto."&idLocalidad=".$idLocalidad."';";
    
}

if($bandeja == 'traer_datos_producto' ){
    
    $datosPrd[] = '';
	$query = " 	SELECT P.Nombre+' - '+P.Marca producto
				, S.Nombre
				, REPLACE(PR.Valor,'.',',') valor
				, S.Direccion+' '+CAST(S.Numero AS VARCHAR(MAX)) direccion
				,P.Foto 
				,D.Nombre+' - '+PROV.Nombre provincia
				,S.Latitud
				,S.Longitud
                                ,PR.Validez
                                ,S.idSupermercado
                                ,P.idProducto
				FROM Precio PR
				INNER JOIN Producto P ON PR.idProducto = P.idProducto
				INNER JOIN Supermercado S ON PR.idSupermercado = S.idSupermercado
				INNER JOIN Departamento D ON S.Localidad = D.ID
				INNER JOIN Provincia PROV ON D.idProvincia = PROV.ID
				WHERE PR.idProducto = '".base64_decode($_GET[idProd])."' AND PR.idSupermercado = '".base64_decode($_GET[idSuper])."' ";
	$datosPrd = $sql->fetchArrayMultiple($query);
	
	$queryD = " EXEC dbo.PLObtenerPreciosCercanos '".$datosPrd[0][0][Latitud]."', '".$datosPrd[0][0][Longitud]."', '".base64_decode($_GET[idProd])."', '".base64_decode($_GET[idSuper])."' ";
	$datosPrdSec = $sql->fetchArrayMultiple($queryD);
	
	
}

if($_POST['accion'] == 'traerSupermercados'){
   
    $ph = $sql->fetchArray("execute dbo.spGetNearLocations ".$_POST['lat']." , ".$_POST['longitud'].", '".$_POST['idProducto']."' "); //devuelve un array 

	$i = 0;
	foreach($ph as $supermercado){
		
		$StringJS .= "   var myLatlng".$i." = new google.maps.LatLng(".$supermercado['Latitud'].",".$supermercado['Longitud']."); "
				. "      var marker".$i." = new google.maps.Marker({
						 position: myLatlng".$i.",
						 map: map,
						 title: '".$supermercado['Nombre']."'}); "
				. "      var infowindow".$i." = new google.maps.InfoWindow({
						 content: '<div style=width:200px; height:75px><h2 align=center>".$supermercado['Nombre']."</h2><p align=center>".$supermercado['direccion']."</p><p align=center>".ucwords(strtolower($supermercado['provincia']))."</p><br><ul class=\"ulMap\" align=center><li><a href=\"finBusqueda.php?idSuper=".base64_encode($supermercado['idSupermercado'])."&idProd=".base64_encode($_POST['idProducto'])."\" class=\"buttonMap small fa fa-arrow-circle-right\">Ir</a></li></ul></div>' });
						  google.maps.event.addListener(marker".$i.", 'click', function() {
							infowindow".$i.".open(map,marker".$i.");
						  }); ";
		$i++;
	}

	echo $StringJS; 
    
}