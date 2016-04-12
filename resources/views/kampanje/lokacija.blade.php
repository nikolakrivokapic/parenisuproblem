
<div>

 <style>
 #map_wrapper {
    height: 600px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
<script>
window.arr=[];
</script>
@foreach ($podrska as $podrza)
<script>

if("{{$podrza->grad}}"!="" && "{{$podrza->lat}}"!="" && "{{$podrza->long}}"!="" )  {


arr.push({"grad":"{{$podrza->grad}}", "lat":"{{$podrza->lat}}", "long":"{{$podrza->long}}" });

}
</script>
@endforeach

<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>
   <script>
jQuery(function($) {
    // Asynchronously Load the map API
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = [
        ['London Eye, London', 51.503454,-0.119562],
        ['Palace of Westminster, London', 51.499633,-0.124755]
    ];

    // Info Window Content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>London Eye</h3>' +
        '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
        ['<div class="info_content">' +
        '<h3>Palace of Westminster</h3>' +
        '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
        '</div>']
    ];

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < arr.length; i++ ) {
         console.log(arr[i]["grad"]);
        var position = new google.maps.LatLng(arr[i]["lat"], arr[i]["long"]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: arr[i]["grad"]
        });

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(4);
        google.maps.event.removeListener(boundsListener);
    });

}
</script>
</div>
