function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 18
    });


    //var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            document.getElementById('latitude').setAttribute("value",pos.lat);
            document.getElementById('longitude').setAttribute("value",pos.lng);

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('A obra');
            map.setCenter(pos);
            var myLatlng = new google.maps.LatLng(pos.lat,pos.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                draggable:true,
                title:"Drag me!"
            });
            google.maps.event.addListener(marker, 'dragend', function(evt){
                document.getElementById('latitude').setAttribute("value",evt.latLng.lat());
                document.getElementById('longitude').setAttribute("value",evt.latLng.lng());
                console.log(evt.latLng.lat() + evt.latLng.lng());
            });
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}