<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/map-icons.css">
    <!-- Snap ik github? -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <script src="dist/js/map-icons.js"></script>
    <title>Veilig Zwemmen</title>
    <style>
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
      .floating-panel {
        position: absolute;
        top: 5px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        height: 80px;
        padding-left: 10px;
      }
      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        opacity: 1;
      }
      #latlng {
        width: 225px;
      }
      #nav{
        width:100vw;
        position: absolute;
        /* top: 10px; */
        z-index: 5;
        height: 50px;
        background-color: #999;
        /* opacity: 0.5; */

      }
      #addcode{
        width: 350px;
        left: 10%;
      }

      #logout{
        width: 350px;
        left: 90%;
        margin-left: -360px;
      }
    </style>
  </head>
  <body>
    <div id='nav'>

      <div class="floating-panel" id="floating-panel">
        Zoek een locatie<br>
        <select id='searchselect' onchange="selectsearch()">
        </select>
        <!-- <div id="test"></div> -->
        <!-- <input id="latlng" type="text" value="40.714224,-73.961452">
        <input id="submit" type="button" value="Reverse Geocode"> -->
      </div>
      <div class="floating-panel" id="addcode">
        Nog een bandje toevoegen<br>
        <a href='/link' class='btn btn-primary'><i class="fas fa-plus"></i></a>
      </div>
      <div class="floating-panel" id="logout">
        Uitloggen<br>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='btn btn-primary'>
            <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
    <div id="map"></div>
    <script>
      var jsn = {!!$locations!!};
      var jsnchild = {!!$childnames!!};
      var map;
      var markers = [];
      var jsnchild = Array.from(jsnchild);
      var jsn = Array.from(jsn);
      var select = document.getElementById('searchselect');



      function selectsearch(){
        var x = select.value;
        console.log(markers);
        google.maps.event.trigger(markers[x], 'click');
      }






      function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: new google.maps.LatLng(52.204132, 4.391399),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        setMarkers();
        // setInterval(function(){setMarkers()},5000);
      }


      function setMarkers(){
        while(select.firstChild){
          select.removeChild(select.firstChild);
        }
        var image = {
          url: 'nat.png',
          scaledSize: new google.maps.Size(40, 40),
          origin: new google.maps.Point(0, -4)
        };
        //alle database markers setten als ze bestaan
        jsn.forEach(function(e){
          console.log(jsn);
          // test = document.getElementById('floating-panel');
          // test.innerText = e[0].latitude;

          var lastE = e[e.length-1];
          if(typeof lastE !== 'undefined'){
            long = parseFloat(lastE.longitude);
            lati = parseFloat(lastE.latitude);
            ix = jsn.indexOf(e);
            var pos = new google.maps.LatLng(lati, long)
            console.log(lastE.isWet);
            if(typeof jsnchild[ix].label == 'undefined'){
              if(lastE.isWet == 0){
                var marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                }), infowindow = new google.maps.InfoWindow({content: jsnchild[ix].name});
              }else{
                var marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  icon: image
                }), infowindow = new google.maps.InfoWindow({content: jsnchild[ix].name + "'s watersensor is nat"});
              }
            }else{
              if(lastE.isWet == 0){
                var marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  label: jsnchild[ix].label
                }), infowindow = new google.maps.InfoWindow({content: jsnchild[ix].name});
              }else{


                var marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  label: jsnchild[ix].label,
                  icon: image,
                  size: '10px'
                }), infowindow = new google.maps.InfoWindow({content: jsnchild[ix].name + "'s watersensor is nat"});
              }
            }

            markers.push(marker);
            console.log(marker);
            google.maps.event.addListener(marker, 'click', (function(marker) {
              return function() {
                infowindow.open(map, marker);
                map.setCenter(pos);
              }
            })(marker));

            // infowindow.setContent('lati');
            // infowindow.open(map, marker);
          }
        })
        var marker;
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            marker = new google.maps.Marker({
              position: pos,
              map: map,
              icon: 'http://maps.google.com/mapfiles/kml/pal5/icon28.png'
            }), infowindow = new google.maps.InfoWindow({content: 'Hier bent u'});
            marker.color = 'blue';
            console.log(marker);
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker) {
              return function() {
                infowindow.open(map, marker);
                map.setCenter(pos);
              }
            })(marker));

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        jsnchild.forEach(function(e){
          var option = document.createElement('option');
          option.innerText = e.name;
          option.value = jsnchild.indexOf(e);

          select.appendChild(option);

        });
        var option = document.createElement('option');
        option.innerText = 'Uw locatie';
        option.value = jsnchild.length;
        select.appendChild(option);


      }




    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU8FG9SLFcQTcmmWYRVecNW28DRSg0AfI&callback=initMap">
    </script>
  </body>
</html>
