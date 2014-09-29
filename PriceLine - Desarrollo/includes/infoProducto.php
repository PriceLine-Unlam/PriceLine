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
    
    
}