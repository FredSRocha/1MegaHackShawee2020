var providers = {
  "copyright": "(c) 2020 LocalBusiness",
  "type": "ProviderCollection",
  "timestamp": "2020-17-02T04:53:00Z",
  "features": [
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          "-43.9379036",
          "-19.9186577",
        ]
      },
      "properties": {
        "id": "1",
        "addr": {
          "city": "Belo Horizonte",
          "country": "Brazil",
          "neighborhood": "Barro Preto",
          "number": "1707",
          "postcode": "30180099",
          "state": "MG",
          "street": "Rua dos Guajajaras"
        },
        "address": "Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099",
        "available": "Ter-Sex (9:00- 13:00 - 14:00-18:00)",
        "category": "servidor",
        "name": "Fernanda Limeira",
        "phone": "31984248321",
        "type":"Consultora Jurídico"
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          "-43.9531309",
          "-19.9174378",
        ]
      },
      "properties": {
        "id": "1",
        "addr": {
          "city": "Belo Horizonte",
          "country": "Brazil",
          "neighborhood": "Barro Preto",
          "number": "1707",
          "postcode": "30180099",
          "state": "MG",
          "street": "Rua dos Guajajaras"
        },
        "address": "Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099",
        "available": "Ter-Sex (9:00- 13:00 - 14:00-18:00)",
        "category": "servidor",
        "name": "Elton Soares",
        "phone": "31984248321",
        "type":"Barbeiro"
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          "-43.950189",
          "-19.9241455",
        ]
      },
      "properties": {
        "id": "1",
        "addr": {
          "city": "Belo Horizonte",
          "country": "Brazil",
          "neighborhood": "Barro Preto",
          "number": "1707",
          "postcode": "30180099",
          "state": "MG",
          "street": "Rua dos Guajajaras"
        },
        "address": "Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099",
        "available": "Ter-Sex (9:00- 13:00 - 14:00-18:00)",
        "category": "entregador",
        "name": "Raimundo Alves",
        "phone": "31992712290",
        "type": "Bicicleta"
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          "-43.9420367",
          "-19.9156405",
        ]
      },
      "properties": {
        "id": "1",
        "addr": {
          "city": "Belo Horizonte",
          "country": "Brazil",
          "neighborhood": "Barro Preto",
          "number": "1707",
          "postcode": "30180099",
          "state": "MG",
          "street": "Rua dos Guajajaras"
        },
        "address": "Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099",
        "available": "Ter-Sex (9:00- 13:00 - 14:00-18:00)",
        "category": "entregador",
        "name": "João Augusto",
        "phone": "31992712290",
        "type": "A pé ou Bicicleta"
      }
    }
  ]
};

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  var crd = pos.coords;

  console.log('Sua posição atual é:');
  console.log('Latitude : ' + crd.latitude);
  console.log('Longitude: ' + crd.longitude);
  console.log('Mais ou menos ' + crd.accuracy + ' metros.');
  
	var map = L.map('map', {
    fullscreenControl: {
        pseudoFullscreen: false // if true, fullscreen to page width and height
    },
    zoom: 14,
    //center: new L.latLng(41.8990, 12.4977),
    center: new L.latLng(-19.9228921, -43.9499226),
    //https://wiki.openstreetmap.org/wiki/Tile_servers
    layers: L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png')
    //https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png
  }),
  geojsonOpts = {
    pointToLayer: function(feature, latlng) {
      return L.marker(latlng, {
        icon: L.divIcon({
          className: feature.properties.category,
          iconSize: L.point(22, 22),
          html: feature.properties.category[0].toUpperCase(),
        })
      }).bindPopup(
        '<aside class="popup-container">'+
        '<div class="popup-header">'+
        '<h2>'+feature.properties.category+'</h2>'+
        '<p>'+feature.properties.type+'</p>'+
        '<img src="../assets/img/category/'+feature.properties.category+'.jpg" alt="">'+
        '</div>'+
        '<div class="popup-body">'+
        '<h3>'+feature.properties.name+'</h3>'+
        '<p>'+feature.properties.available+'</p>'+
        '<address>'+
          feature.properties.address+
        '</address>'+
        '<a href="https://localhost/php/_MegaHack/app/final/p2/admin/manage-request.php?id='+feature.properties.phone+'" class="btn-request '+feature.properties.category+'-color">Solicitar <span>&rsaquo;</span></a>'+
        '</div>'+
        '</aside>'
      );
    }
  };

var poiLayers = L.layerGroup([
  L.geoJson(providers, geojsonOpts)
])
.addTo(map);

L.control.search({
  layer: poiLayers,
  initial: false,
  zoom: 16,
  //https://stackoverflow.com/questions/53745018/search-multiple-attributes-in-leaflet-map
  propertyName: 'type',
  buildTip: function(text, val) {
    var name = val.layer.feature.properties.name;
    var category = val.layer.feature.properties.category;
    var address = val.layer.feature.properties.address;
    var type = val.layer.feature.properties.type;
    return '<a href="#" class="'+category+'"><strong>'+name+' </strong><b>'+category+'</b><small> '+type+'</small><br><small>'+address+'</small></a><br>';
  }
})
.addTo(map);

};

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};

navigator.geolocation.getCurrentPosition(success, error, options);