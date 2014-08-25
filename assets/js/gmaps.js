var map;
var markers = [];

function initialize() {

    var latlng = new google.maps.LatLng( data_pimap.latitude, data_pimap.longitude );

    var options = {
        zoom: parseInt( data_pimap.zoom),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: true,
    };

    map = new google.maps.Map(document.getElementById("pimap_gMaps"), options);

    google.maps.event.addListener(map, 'click', function(event) {
	    addMarker(event.latLng);
	});

    if( data_pimap_post.latitude !== "" && data_pimap_post.longitude !== "" ){
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng( data_pimap_post.latitude, data_pimap_post.longitude ),
            map: map
        });
    }
}

// Add a marker to the map and push to the array.
function addMarker(location) {
	clearMarkers();
	var latitude = location.lat();
	var longitude = location.lng();

	jQuery( "#pin_latitude").val( latitude );
	jQuery( "#pin_longitude").val( longitude );

	var marker = new google.maps.Marker({
    	position: location,
    	map: map
  	});

  	markers.push(marker);
}

function clearMarkers() {
    if ( markers ) {
        for (i in markers) {
            markers[i].setMap(null);
        }
    	markers.length = 0;
    }
}

initialize();