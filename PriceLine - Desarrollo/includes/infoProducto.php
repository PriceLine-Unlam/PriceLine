<?php
session_start();

if(isset($_POST['accion'])){
    include_once('../classes/SqlSrv.class.php');
}else{
    include_once('classes/SqlSrv.class.php');
}
$sql = new SqlSrv();
//var_dump($sql); 
if(isset($_GET['idProducto'])){
    $idProducto = $_GET['idProducto'];
    $query = "EXEC detalleProducto ".$idProducto;
    
    if(isset($_SESSION['usuario_lon'])){
        $query .= " , ".$_SESSION['usuario_lon'].",".$_SESSION['usuario_lat'];
    }
   //print_r($query);
    $info_producto = $sql->fetchArrayMultiple($query);
    
    //print_r($info_producto); die();
    $query = "select top 4 * from Producto order by visitado desc";
    $productos_visitados = $sql->fetchArrayMultiple($query);
    
    $query = " EXEC PLObtenerSupermercadosCercanos '".$_SESSION['usuario_email']."','".$_SESSION['usuario_lat']."','".$_SESSION['usuario_lon']."' ";
    $datos = $sql->fetchArrayMultiple($query);
    
    $option_sup = "<option value=''>SELECCIONE UN SUPERMERCADO</option>";
    foreach($datos[0] as $sup){
        $option_sup .= "<option value='".$sup['idSupermercado']."'>".$sup['Nombre'].'-'.$sup['Direccion']."</option>";
    }
    
}