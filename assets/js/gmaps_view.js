var map;
var idInfoBoxAberto;
var infoBox = [];
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
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng( ponto.latitude, ponto.longitude ),
            title: ponto.title,
            map: map
        });

        var content = "<h2>" + ponto.title + "</h2>";
        if( ponto.image != null ){
            content += "<div class='box-image'><img src='" + ponto.image + "' /></div>";
        }
        console.log(ponto.image);
        if( ponto.content != null){
            content += "<p>" + ponto.content + "</p>";
        }

        var myOptions = {
            content: content,
            pixelOffset: new google.maps.Size(-150, 0)
        };
        infoBox[ponto.id] = new InfoBox(myOptions);
        infoBox[ponto.id].marker = marker;
        infoBox[ponto.id].listener = google.maps.event.addListener(marker, 'click', function (e) {
            abrirInfoBox(ponto.id, marker);
        });
    });
}

function abrirInfoBox(id, marker) {
    if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
        infoBox[idInfoBoxAberto].close();
    }
    infoBox[id].open(map, marker);
    idInfoBoxAberto = id;
}


initialize();