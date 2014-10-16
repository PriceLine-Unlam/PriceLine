<?php
session_start();
include('classes/SqlSrv.class.php');
$sql = new SqlSrv();

    
    $email = $_SESSION['usuario_email'];
    
    
    $query = "SELECT * FROM Usuarios WHERE email = '".$email."'";
    
    $usuario = $sql->fetchArray($query);
