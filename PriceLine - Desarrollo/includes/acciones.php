<?php

include('../classes/SqlSrv.class.php');
$sql = new SqlSrv();

if($_POST['accion'] == 'registrar'){
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $provincia = $_POST['provincia'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $numero = $_POST['numero'];
    $provincia_nombre = $_POST['provincia_nombre'];
    $localidad_nombre = $_POST['localidad_nombre'];
    $email = $_POST['email'];
    $password = base64_encode($_POST['password']);

    $query = "SELECT 1 as Existe FROM Usuarios WHERE email = '".$_POST['email']."'";
    $usuario = $sql->fetchArray($query);
    
    if( $usuario[0]['Existe'] != 1){
        // $direccion_google = 'Calle, Población, Provincia / Estado, País';
        //$direccion_google = 'San ignacio 2588, ituzaingo, buenos aires, argentina';
        $direccion_google = $direccion+' '+$numero +', ' + $localidad_nombre +', ' + $provincia_nombre +', Argentina ';
        try{
            $resultado = file_get_contents(sprintf('http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s', urlencode($direccion_google)));
            $resultado = json_decode($resultado, TRUE);

            $lat = $resultado['results'][0]['geometry']['location']['lat'];
            $lng = $resultado['results'][0]['geometry']['location']['lng'];

        }catch(Exception $e){

            echo "alert('". $e->getMessage()."')";
        }

        //Insert nuevo usuario
        try{

            $query = "INSERT INTO Usuarios VALUES ('".$email."','".$nombre."',"
                    . "'".$apellido."',".$lat.",".$lng.",'".$direccion."','".$numero."',"
                    . "'".$localidad."','".$provincia."','".$email."','".$password."')";

            $ok = $sql->query($query);
           // echo $query;
            if($ok){
                $query = "INSERT INTO Usuarios_log VALUES ('".$email."','".$nombre."',"
                    . "'".$apellido."',".$lat.",".$lng.",'".$direccion."','".$numero."',"
                    . "'".$localidad."','".$provincia."','".$email."','".$password."','".$email."','".date('Y-m-d')."','A')";

                $ok = $sql->query($query);
            }

        }catch(Exception $e){
             echo "alert('". $e->getMessage()."')";
        }
        echo 'alertify.alert("<u>Registración</u></br> El usuario se ha creado con exito!!", function () {  });$(".alertify-dialog").css("height","200px");';
    }else{
        echo 'alertify.alert("<u>Registración</u></br> El usuario ya existe, intente recuperar la contraseña si no la recuerda..", function () {  });$(".alertify-dialog").css("height","250px");';
    }
}



