<?php

include('classes/SqlSrv.class.php');

$sql = new SqlSrv();


$ph = $sql->fetchArray("execute dbo.Presupuesto '2,1,22','3,3,1'"); //devuelve un array 

//echo '<pre>';
//print_r($ph);

//echo '</pre>';
?>
	<head>
		<title>Verti by HTML5 UP</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,800" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/app.css">
		</noscript>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
	</head>

                                                                        <div>
										<section id="menu">
											<div class="row">
												<p>Seleccioná Tu Localidad</p>
											</div>
											<div class="row">
												<div class="menu" style="width:100%;">
													<div id="controls"></div>
												</div>
											</div>
											<div class="row">
												<div id="gmap-4" style="width:100%;height:300px;"></div>
											</div>
										</section>
									</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

function initialize() {
  var myLatlng = new google.maps.LatLng(-34.638409,-58.689340);
  
  var mapOptions = {
    zoom: 15,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('gmap-4'), mapOptions);

  
  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
  
  var infowindow = new google.maps.InfoWindow({
      content: "Home"
  });

  
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

  
  $.post("ajax.php",{lat : -34.638409 ,long : -58.689340},function(data){
      eval(data)
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
