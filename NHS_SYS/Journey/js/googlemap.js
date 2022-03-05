function loadMap() {
    var location = {lat:-25.363, lng:131.044}; // this is the location that will shown on the map
    var map = new google.maps.Map(document.getElementById("map"),{ //This will place the map that is fetched and place into to container with id map
        zoom: 4,
        center: location 
    });


    var marker = new google.maps.Marker({ //just calls the function .Marker, which places the marker on teh position and location variables below. 
        position: location,
        map: map
      });
    
    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();  
    codeAddress(cdata);
}

