var map;
var geocoder;

function loadMap()
{
  var location = {lat:51.583015, lng:-0.337820}; // this is the location that will shown on the map
    map = new google.maps.Map(document.getElementById("map"),{ //This will place the map that is fetched and place into to container with id map
        zoom: 12,
        center: location 
    });


  var cdata =  JSON.parse(document.getElementById('data').innerHTML);; // The data will parsed as a json file from the div with the id data. It will will be parsed and saved in variable cdata.
  console.log(cdata)
  geocoder = new google.maps.Geocoder();  // variable created to access geocode api
  codeAddress(cdata)

  var allData = JSON.parse(document.getElementById('allData').innerHTML);;
  showAllPatientHomes(allData)

  //showCurrentLocation(allData)
}



function codeAddress(cdata){
//This function will get cdata and iteratively get the lat and long and the response wil be saved in variable called results. 
    Array.prototype.forEach.call(cdata, function(data){ // iteratively go through each row in cdata.
         
    	var address = data.Postcode;
         geocoder.geocode( { 'address': address}, function(results, status) {
           if (status == 'OK') {
             map.setCenter(results[0].geometry.location);
             var points ={}; 
             points.id = data.id;
             points.lat= map.getCenter().lat(); // gets lat and lng from geocoder function and updates points array
             points.lng= map.getCenter().lng();
             updatePatientHomesWithLatLng(points);

            } else {
             //alert('Geocode was not successful for the following reason: ' + status);
           }
         });
     });
}


function updatePatientHomesWithLatLng(points) 
{
	$.ajax({ // using ajax i will send all data stored in points to the database using ajax. 
		url:"action.php", // goes to action.php to be stored to db. 
		method:"post",
		data: points,
		success: function(res) {
			console.log(res)
		}
	})
}


function showAllPatientHomes(allData)
{ // This will show all patient postcodes on the map.
  //var infoWind = new google.map.InfoWindow;
  Array.prototype.forEach.call(allData, function(data)// iteratively go through each row in allData.
  { 
    
    var marker = new google.maps.Marker({ //just calls the function .Marker, which places the marker on the position and location variables below. 
      position: new google.maps.LatLng(data.lat, data.lng),
      map: map
    });

  });
}


/*function showCurrentLocation() {
  var currentLocation= navigator.geolocation.getCurrentPosition();
  var marker = new google.maps.Marker({ //just calls the function .Marker, which places the marker on teh position and location variables below. 
    position: new google.maps.LatLng(currentLocation.lat, currentLocation.lng),
    map: map,
    icon: 
    {
      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    }
  });
}*/