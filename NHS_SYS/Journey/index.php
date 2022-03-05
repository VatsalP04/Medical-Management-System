<!DOCTYPE html>
<html?>

<head>
    <title> </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/googlemap.js"></script>
    <style type="text/css">
		.container {
			height: 450px;
		}
		#map {  /* This will style the div which had id map.*/ 
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
	</style>
</head>



<body>
    <div class= "container"> 
        <centre><h1>Access google maps api </h1></centre>    
		<?php
			require "minpath.php";


		?>
        <div id = "map"></div> <!--This is the div where the map will be placed.-->

    </div>

</body>

<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaV4BSInfr43aS_pfAdBKBNcwf7c4tp3w&callback=loadMap"></script>-->

-->
</html>

