<!DOCTYPE html>
<html?>

<!--
#session_start();
#include("connection.php");
#include("functions.php");
#$user_data = check_login($con)
#-->

<head>
    <title> </title>
   <!-- <link rel="stylesheet" href="bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
			require 'patient_homes.php';
            $path = new minpath;
			$patient_details = $path->getPatientDetailBlankLatLng();
            $patient_details = json_encode($patient_details, true);
			echo '<div id="data">' . $patient_details . '</div>'; // This will echo all the patient details on the webpage in a div with an id data. 

            $allData = $path->getAllPatientDetail(); // the returned data will be stores as variable $allData

            $allData = json_encode($allData, true); // will be encoded in a json format.
			echo '<div id="allData">' . $allData . '</div>'; // then will be printed on page, but won't show. 

		 ?>   
        <div id = "map"></div> <!--This is the div where the map will be placed.-->

    </div>

</body>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaV4BSInfr43aS_pfAdBKBNcwf7c4tp3w&callback=loadMap"></script>


</html>

