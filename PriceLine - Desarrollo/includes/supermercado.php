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
	$query = " EXEC PLObtenerSupermercadosCercanos 'SIN_USUARIO' ";
	$datos = $sql->fetchArrayMultiple($query);
    
}

if($bandeja == 'usuario_login' ){
    
    $datos[] = '';
	$query = " EXEC PLObtenerSupermercadosCercanos '".$_SESSION['usuario_email']."','".$_SESSION['usuario_lat']."','".$_SESSION['usuario_lon']."' ";
	$datos = $sql->fetchArrayMultiple($query);
	
}

if($bandeja == 'informa_super' ){
    
	$datos[] = '';
	$query = " EXEC dbo.PLObtenerDatosSupermercado '".base64_decode(base64_decode($_GET[idSupermercado]))."'  ";
	$datos = $sql->fetchArrayMultiple($query);
	
}

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
           ,'".$lng."'
           ,'".$lat."'
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
    
    echo 'alertify.alert("<u>Supermercado</u></br> El supermercado fué registrado con éxito!", function () { window.location.reload(); });$(".alertify-dialog").css("height","250px");';    
    
}

if($_POST['accion'] == 'registrarProducto'){
   
    //print_r($_REQUEST);
    $idProducto = $_POST['idProducto'];
    $Precio = $_POST['Precio'];
    $supermercado = base64_decode(base64_decode($_POST['supermercado']));
    
    $query = " EXEC dbo.PLInsertarNuevoProductoASupermercado '".$idProducto."', '".$supermercado."' ,'".$Precio."' ,'".$_SESSION['usuario_email']."' ";
    $sql->query($query);
	
    echo 'alertify.alert("<u>Producto</u></br> El producto fué registrado con éxito!", function () { window.location.reload(); });$(".alertify-dialog").css("height","250px");';    
    
}