<div class="container">
    <div class="section">
        <p><b>Nous contacter?</b><br/>
            Madame Madame<br/>
            Téléphone: (418) 555-0242<br/>
            Email: <mail>courrieldespam@outlook.com</mail>
        </p>
        <p><b>Ou nous trouver ?</b><br/>
            19 rue des Residences<br/>
            Saint-Romuald<br/>
            Québec, H0H 0H0<br/>
            Canada
        </p>
        <p><b>Heures d'ouverture</b><br/>
        Lundi au Vendredi : 10h00 à 17h00<br/>
        Samedi : 10h00 à 14h00<br/>
        Dimanche : Fermé</p>
    </div>
</div>
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