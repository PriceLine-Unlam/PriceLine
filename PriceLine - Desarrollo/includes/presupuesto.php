<?php
session_start();

if(isset($_POST['accion'])){
    include_once('../classes/SqlSrv.class.php');
}else{
    include_once('classes/SqlSrv.class.php');
}


$sql = new SqlSrv();
if($bandeja == 'usuario_login'){
    
    //$lista = $_SESSION['listas'];
    $query = "EXEC getListas '".$_SESSION['usuario_email']."'";
    $dato = $sql->fetchArray($query);
    //print_r($dato);die();
    $listas = explode('|', $dato[0]['lista']);
    //print_r($listas); die();
 
    $datos[] = '';
    if(count($listas) > 1){
        //echo "1"; die();
        for($i=0;$i<count($listas);$i++){
            $query = "EXEC [SPPresupuestoMenor] '".$_SESSION['usuario_email']."',".$listas[$i].",".$_SESSION['usuario_lat'].",".$_SESSION['usuario_lon'];
           
            $datos[] = $sql->fetchArrayMultiple($query);
        }
    }else if(count($listas) == 1 && $listas[0] != '' ){
        
        $query = "EXEC [SPPresupuestoMenor] '".$_SESSION['usuario_email']."',".$listas[0].",".$_SESSION['usuario_lat'].",".$_SESSION['usuario_lon'];
        $datos = $sql->fetchArrayMultiple($query);
    }
    
   //print_r($datos);die();
}

if($bandeja == 'sin_usuario' ){
    
    $query = "EXEC getListas 'SIN_USUARIO'";
    $dato = $sql->fetchArray($query);
    //print_r($dato);die();
    $listas = explode('|', $dato[0]['lista']);
    //print_r($listas); die();
 
    $datos[] = '';
    if(count($listas) > 1){
       // print_r('1'); die();
        for($i=0;$i<count($listas);$i++){
            $query = "EXEC [SPPresupuestoMenor] 'SIN_USUARIO',".$listas[$i];
           
            $datos[] = $sql->fetchArrayMultiple($query);
        }
    }else if(count($listas) == 1 && $listas[0] != ''){
        //print_r('2'); die();
        $query = "EXEC [SPPresupuestoMenor] 'SIN_USUARIO',".$listas[0];
        $datos = $sql->fetchArrayMultiple($query);
    }
}

//Detalles
if(isset($_GET['id'])){
    
    if(isset($_SESSION['usuario_email'])){
         $query = "EXEC [Presupuesto] '".$_SESSION['usuario_email']."',".$_GET['id'].",".$_SESSION['usuario_lat'].",".$_SESSION['usuario_lon'].",1";
         $datos = $sql->fetchArrayMultiple($query);
    }else{
        $query = "EXEC [Presupuesto] 'SIN_USUARIO',".$_GET['id'];
         $datos = $sql->fetchArrayMultiple($query);
    }
    
   
}

if($_POST['accion'] == 'borrarLista'){
    
    
    $query = "EXEC SPBorrarLista ".$_POST['id'];
    $sql->fetchArray($query);

   // $_SESSION['listas'] = str_replace($_POST['id'],'',$_SESSION['listas']);
    
    echo 'alertify.alert("Se a borrado el presupuesto correctamente! ", function () { window.location.reload();  });';
}

if($_POST['accion'] == 'agregarLista'){
    
    $nombre = $_POST['nombre'];
    $productos = $_POST['productos'];
    $importancia = $_POST['importancia'];
    
    $query = "EXEC SPagregarPresupuestos '".$_SESSION['usuario_email']."','".$productos."','".$importancia."','".$nombre."'";
    $sql->fetchArray($query);
    
    echo 'alertify.alert("Se agregado el presupuesto correctamente! ", function () { window.location.reload();  });';
}
if(isset($_GET['idLista'])){
    
    $idLista = $_GET['idLista'];
    
    if(isset($_SESSION['usuario_email'])){
        $query = "EXEC detallePresupuestoSP ".$idLista.",'".$_SESSION['usuario_email']."'";
    }else{
        $query = "EXEC detallePresupuestoSP ".$idLista.",'SIN_USUARIO'";
    }

    $datos = $sql->fetchArray($query);
   
}
if($_POST['accion'] == 'modificarLista'){
    
    
    //print_r($_REQUEST);
    $nombre = $_POST['nombre'];
    $productos = $_POST['productos'];
    $importancia = $_POST['importancia'];
    $idLista = $_POST['idLista'];
    
    $query = "EXEC modificarPresupuesto '".$_SESSION['usuario_email']."','".$productos."','".$importancia."','".$nombre."','".$idLista."'";
    $sql->fetchArray($query);
    
    echo 'alertify.alert("Se ha modificado el presupuesto correctamente! ", function () { window.location.href = "presupuesto.php";  });';    
    
}