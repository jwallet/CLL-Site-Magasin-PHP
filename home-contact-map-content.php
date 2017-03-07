<div id="map" style="height: 400px; width: 100%; pointer-events: none;"></div>
<script>
    function initMap() {
        var uluru = {lat: 46.7308251, lng: -71.2937554};
        var ulurc = {lat: 46.735, lng: -71.2937554};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: ulurc,
            disableDefaultUI: true
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: 'css/ico/pin.png'
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt_9EOJGlNq42uK4xVSSiWgCVjT63gN1g&callback=initMap">
</script>