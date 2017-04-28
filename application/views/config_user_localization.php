<? 
    $latphp = $this->session->userdata('last_lat'); 
    $logphp = $this->session->userdata('last_log'); 
    $cityphp = $this->session->userdata('last_city');
    
    $latphp = isset($latphp) ? $latphp : "-23.550519";
    $logphp = isset($logphp) ? $logphp : "-46.633309";
    $cityphp = isset($cityphp) ? $cityphp : "São Paulo";
?>


<div class="container hero">
    <div class="row" style="margin-top:15px;">
        

        <!-- COMEÇO COLUNA -->
        <div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0">
            <!-- PROFILE -->
            <? constroy_perfil_left($this->session->userdata()) ?>
            <!-- BOTÕES CONFIGURAÇÕES -->
            <? constroy_btn_config("localization") ?>
        </div>
        <!-- FINAL COLUNA -->




        <div class="col-lg-8 col-lg-offset-0 col-md-6 col-md-offset-0 phone-holder">
            <ul class="ca bqe bqf agk">
                
                    <? alerts($this->session->flashdata('success'));  ?>
            <!-- POST NEW WAVE -->
                <li class="tu b ahx">
                    <h2>Localização</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget egestas sapien. Donec rutrum dapibus auctor. Vivamus aliquam neque vitae ante aliquet, nec elementum justo tincidunt. Donec dignissim tortor at consectetur sollicitudin. Aenean consectetur vehicula turpis, ut ultricies lacus sagittis ut. Mauris et urna ante. Nunc at justo imperdiet, condimentum turpis ac, efficitur justo.</p>
                </li>
                <li class="tu b ahx" id="mapPlace">

                    <div class="row" style="height: 400px; width: 100%" id="mapDiv">
                    <input id="pac-input" class="controls" type="text" placeholder="Enter a location">
                    <div id="type-selector" class="controls">
                        
                        
                    </div>
                    <div id="map"></div>

                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV_MDoq9eQCK1gQWSRJ5fmTTJMzEALaJ0&libraries=places&callback=initMap" async defer></script>
                    </div>
                </li>
                <li class="tu b ahx" id="btnAtivar">
                    <div class="tv">
                        <div class="bqi">
                            <form class="form-horizontal cem" action="<?= base_url('localization') ?>" method="POST">
                                <input type="text" id="lat" name="lat" value="<?= $latphp ?>">
                                <input type="text" id="log" name="log" value="<?= $logphp ?>">
                                <input type="text" id="city" name="city" value="<?= $cityphp ?>">
                                <button class="cg pj cem" type="submit">Salvar Localização</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

                    


                
<script type="text/javascript">
var  $lat;
var  $log;

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: <?= $latphp ?>, lng: <?= $logphp ?>},
    zoom: 10

  });


  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();

  var marker = new google.maps.Marker({
    position: {lat: <?= $latphp ?>, lng: <?= $logphp ?>},
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("Local não encontrado: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(10);  // Why 17? Because it looks good.
    };
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
    document.getElementById("lat").value = place.geometry.location.lat();
    document.getElementById("log").value = place.geometry.location.lng();
    document.getElementById("city").value = place.name;
    console.log(place);
  });

}

</script>

<style type="text/css">
    /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map {
height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
</style>


