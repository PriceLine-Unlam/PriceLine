<?php
session_start();
include('classes/SqlSrv.class.php');
$sql = new SqlSrv();

if($_POST['accion'] == 'ingreso'){
    
    $email = $_POST['email'];
    $password = $_POST['password']; 
    
    
    $query = "SELECT * FROM Usuarios WHERE email = '".$_POST['email']."' and password='".  base64_encode($password)."'";
    
    $usuario = $sql->fetchArray($query);

    if($usuario[0]['Nombre'] == ""){
        //header("Location: Login.php?error=user_incorrect");
        echo "window.location.href = 'Login.php?error=user_incorrect'";
    }else{
        

        $_SESSION['usuario_nombre'] = $usuario[0]['Nombre']." ".$usuario[0]['Apellido'];
        $_SESSION['usuario_email'] = $usuario[0]['Email'];
        $_SESSION['usuario_lat'] = $usuario[0]['Latitud'];
        $_SESSION['usuario_lon'] = $usuario[0]['Longitud'];
        
        echo "window.location.href = 'index.php'";
        //header("Location: index.php");  
    }   
}
