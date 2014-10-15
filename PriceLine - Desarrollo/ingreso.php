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
        
        $query = "EXEC getListas '".$usuario[0]['Email']."'";
        $datos  = $sql->fetchArray($query);
        
        $_SESSION['usuario_nombre'] = $usuario[0]['Nombre']." ".$usuario[0]['Apellido'];
        $_SESSION['usuario_email'] = $usuario[0]['Email'];
        $_SESSION['usuario_lat'] = $usuario[0]['Latitud'];
        $_SESSION['usuario_lon'] = $usuario[0]['Longitud'];
        $_SESSION['listas'] = $datos[0]['lista'];
        
        echo "window.location.href = 'index.php'";
        //header("Location: index.php");  
    }   
}
if($_POST['accion'] == 'facebook'){
    
    $query = "SELECT * FROM Usuarios WHERE email = '".$_POST['email']."'";
    
    $usuario = $sql->fetchArray($query);

    if($usuario[0]['Nombre'] == ""){
        $query = "INSERT INTO Usuarios VALUES ('".$_POST['email']."','".$_POST['nombre']."',"
                    . "'".$_POST['apellido']."',NULL,NULL,'','',"
                    . "'','','".$_POST['email']."','')";

            $ok = $sql->query($query);
            
            $_SESSION['usuario_email'] = $_POST['email'];
            
            echo "window.location.href = 'editarPerfil.php?id=1'";
            
    }else{
        
        $query = "EXEC getListas '".$usuario[0]['Email']."'";
        $datos  = $sql->fetchArray($query);
        
        $_SESSION['usuario_nombre'] = $usuario[0]['Nombre']." ".$usuario[0]['Apellido'];
        $_SESSION['usuario_email'] = $usuario[0]['Email'];
        $_SESSION['usuario_lat'] = $usuario[0]['Latitud'];
        $_SESSION['usuario_lon'] = $usuario[0]['Longitud'];
        $_SESSION['listas'] = $datos[0]['lista'];
        
        echo "window.location.href = 'index.php'";
        //header("Location: index.php");  
    }   
    
}
