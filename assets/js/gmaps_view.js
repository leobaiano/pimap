var map;
var markers = [];

function initialize() {

    var latlng = new google.maps.LatLng( data_pimap.latitude, data_pimap.longitude );

    var options = {
        zoom: parseInt( data_pimap.zoom),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
    };

    map = new google.maps.Map(document.getElementById("pimap_gMaps"), options);

    jQuery.each(pins, function(index, ponto) {
        console.log( index + " : " + ponto );
    });

    // if( data_pimap_post.latitude !== "" && data_pimap_post.longitude !== "" ){
    //     var marker = new google.maps.Marker({
    //         position: new google.maps.LatLng( data_pimap_post.latitude, data_pimap_post.longitude ),
    //         map: map
    //     });
    // }
}
initialize();