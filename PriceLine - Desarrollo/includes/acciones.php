<?php
session_start();
include('../classes/SqlSrv.class.php');
include('class.phpmailer.php');
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
if($_POST['accion'] == 'editar'){
    
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

            $query = "UPDATE [Usuarios]
                        SET [Nombre] = '".$nombre."'
                           ,[Apellido] = '".$apellido."'
                           ,[Latitud] = ".$lat."
                           ,[Longitud] = ".$lng."
                           ,[Direccion] = '".$direccion."'
                           ,[Nro] = '".$numero."'
                           ,[Localidad] = '".$localidad."'
                           ,[Provincia] = '".$provincia."'
                      WHERE Usuario = '".$email."'";
            
            $ok = $sql->query($query);
            
            if($password != ''){
                 $query = "UPDATE [Usuarios]
                            SET [Password] = '".$password."'
                            WHERE Usuario = '".$email."'";
                 $ok = $sql->query($query);
            }
           // echo $query;
            if($ok){
                $query = "INSERT INTO Usuarios_log VALUES ('".$email."','".$nombre."',"
                    . "'".$apellido."',".$lat.",".$lng.",'".$direccion."','".$numero."',"
                    . "'".$localidad."','".$provincia."','".$email."','".$password."','".$email."','".date('Y-m-d')."','M')";

                $ok = $sql->query($query);
            }

        }catch(Exception $e){
             echo "alert('". $e->getMessage()."')";
        }
        echo 'alertify.alert("<u>Editar Perfil</u></br> Se ha editado la informacion con exito!", function () { window.location.href="login.php"  });$(".alertify-dialog").css("height","200px");';
    
}
if($_POST['accion'] == 'modificarPrecio'){
    
    $precio = str_replace(',','.',$_POST['valor']);
    $supermercado = $_POST['idSupermercado'];
    $producto = $_POST['idProducto'];
    $usuario = $_SESSION['usuario_email'];
    
    $query = "EXEC modificarPrecio '".$precio."',".$producto.",".$supermercado.",'".$usuario."'";
    
    $ok = $sql->query($query);
    echo 'alertify.alert("<u>Producto</u></br> Se ha ingresado el valor con exito!", function () {  });$(".alertify-dialog").css("height","250px");';
}

if($_POST['accion'] == 'validarPrecio'){
    
    $supermercado = $_POST['idSupermercado'];
    $producto = $_POST['idProducto'];
    $usuario = $_SESSION['usuario_email'];
    
    $query = "EXEC validarPrecio ".$producto.",".$supermercado.",'".$usuario."'";
    
    $ok = $sql->fetchArray($query);
    
    if($ok[0]['resultado'] == 1){
            echo 'alertify.alert("<u>Producto</u></br>  Ha validado con exito el precio!", function () { location.reload();  });$(".alertify-dialog").css("height","250px");';
    }else{
        echo 'alertify.alert("<u>Producto</u></br> Usted ya ha validado este precio!", function () {  });$(".alertify-dialog").css("height","250px");';
    }
}


if($_POST['accion'] == "RecuperarContrasena"){
    
    $email = $_POST['email'];
    $query = "SELECT count(*) as count   FROM Usuarios WHERE Usuario = '".$email."'";
    $ok = $sql->fetchArray($query);
    
    if($ok[0]['count'] == 1){
        
                $pass = generaPass();
		$query = "UPDATE  Usuarios SET password='".base64_encode($pass)."' where Usuario='".$email."'";
                //echo $query;
                $sql->fetchArray($query);		
		$body = "<html>
                <head>
                <style type='text/css'>
                  .logo img{
                       float:left;
                   }
                       #page #registrat{
                        width:100%;
                        float:none;
                    }
                    #registrat{
                            width:500px;
                            float:left;
                    }
                    .headleft:before, .headleft:after, .headleft {
                        height:33px;
                       backgroud-color:#f00;
                            color:#4e4e4d;	
                            font-size:24px;
                            color:#cb9797;
                            font-weight:700;
                            font-style:italic;
                            margin-top:18px;
                            margin-left:10px;
                            float:left;
                            display:block;
                    }

                    #page #registrat{
                        width:100%;
                        float:none;
                    }
                    #registrat{
                            width:500px;
                            float:left;
                    }
                    .headleft:before, .headleft:after, .headleft {
                        height:33px;
                        backgroud-color:red;                      
                        width:725px;
                       }
                       #foot{
                           height:15px;
                           width:500px;
                       }
                       #medio{
                           
                       }
                </style>
                </head>

                <body>
                     <img src='cid:1001'/>
                     <div id='medio' style='height: 75px;width:500px;font-size:16px;margin-left:10px;'>
                         <br>
                         <b>Tu Nueva Contrase&ntilde;a : ".trim($pass)."</b>
                         <br>
                     </div>
                    <footer>
                         <img src='cid:1002'/>
                    </footer>

                </body>
                </html>
                ";
		send_mail($body,$email,"Recuperacion de contraseña!  ");
                
                echo 'alertify.alert("<u>Recuperacion de Contraseña</u></br>  Tu Nueva Contrase&ntilde;a : '.trim($pass).' ", function () { });$(".alertify-dialog").css("height","250px");';
    }else{
        echo 'alertify.alert("<u>Recuperacion de Contraseña</u></br>  El usuario no existe, por favor registrese o intente nuevamente!.!", function () {   });$(".alertify-dialog").css("height","250px");';
    }
}

function send_mail($body,$email,$title){

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "smtp.live.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPDebug  = 0; 
        
	//$mail->SMTPSecure = “tls”;
	$mail->From = "priceline@outlook.com.ar"; // Desde donde enviamos (Para mostrar)
	$mail->Username = "priceline@outlook.com.ar";
	$mail->Password  = "Unlam2014";
	$mail->FromName = "PriceLine";
	//$mail->AddAddress("mgimenez@4it.com.ar");
	$mail->AddAddress($email);
	$mail->Subject = $title." PriceLine"; // Este es el titulo del email.
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $mail->AddEmbeddedImage("images/logo.png",1001,"logo.png");
        $mail->AddEmbeddedImage("images/logo_correo.png",1002,"footer.png");
	//$exito = $mail->Send(); 
	 $mail->Body = $body;
	 $mail->send();

}
function generaPass(){
		//Se define una cadena de caractares. Te recomiendo que uses esta.
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		//Obtenemos la longitud de la cadena de caracteres
		$longitudCadena=strlen($cadena);

		//Se define la variable que va a contener la contraseña
		$pass = "";
		//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
		$longitudPass=6;

		//Creamos la contraseña
		for($i=1 ; $i<=$longitudPass ; $i++){
			//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
			$pos=rand(0,$longitudCadena-1);

			//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
			$pass .= substr($cadena,$pos,1);
		}
		return trim($pass);
}