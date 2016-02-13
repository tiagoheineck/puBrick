function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 14,
        disableDefaultUI: true,
        zoomControl: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.SATELLITE
            ]
        },
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false
    });


    //var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };


            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Você!');
            map.setCenter(pos);
            $.getJSON("/near/"+pos.lat+'/'+pos.lng, function(json) {
                $.each(json.data, function(key, data) {
                    var latLng = new google.maps.LatLng(data.latitude, data.longitude);
                    // Creating a marker and putting it on the map
                    console.log(1);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                        title: 'Obra: ' + data.titulo + ' - Valor: ' + data.valor,
                        url: '/view/'+data.id
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        window.location.href = this.url;
                    });
                });

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