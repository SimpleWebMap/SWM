<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($the_title)) ? '{the_title} | {title_default}' : '{title_default}'; ?></title>
        {headerinc}
    </head>
    <body>

    <header>
        <div id="title" class="row hide-for-small-only"><h1>Título do mapa</h1></div>
        <div id="menu" class="row">
            <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
              <button class="menu-icon" type="button" title="Menu" data-toggle></button>
              <div class="title-bar-title">Título do mapa</div>
            </div>
            <div class="top-bar" id="main-menu">
              <div id="responsive-menu">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li><a href="#"><i class="fa fa-map"></i>BaseMap</a></li>
                    <li><a href="#"><i class="fa fa-search"></i>Find</a></li>
                  </ul>
                </div>
                <div class="top-bar-right">
                  <ul class="menu" data-dropdown-menu>
                    <li><a href="#"><i class="fa fa-list"></i></a></li>
                    <li><a href="#"><i class="fa fa-info"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>        
    </header>

    <div id="main" class="main row">
        <div id="map" class="map"></div>
        <div id="sidebar"><p>Sidebar</p></div>
    </div>

    <footer class="row show-for-medium">
        <p>Lat: 45.13°N  Lon: 7.92°E | Escala: 1 : 289 Km |  Zoom: 11</p>
    </footer>


<div id="map" class="map"></div>
    <script>
window.onload = function(){
var map = new ol.Map({
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        target: 'map',
        view: new ol.View({
          center: [0, 0],
          zoom: 2
        })
      });
}
    </script>


        {footerinc}
    </body>
</html>
