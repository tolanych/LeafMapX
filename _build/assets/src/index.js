if (typeof window['L'] == 'undefined') {
  document.write('<script src="' + LeafMapConfig.jsUrl + 'lib/leaflet.js"><\/script>');
  check_script_loaded();
}

const LeafMap = {
  init: function(config) {
    const map = L.map(config.target);
    var startPoint = config.startPoint.split(',');

    const defaultCenter = [startPoint[0].trim(),startPoint[1].trim()];
    const defaultZoom = config.startZoom;
    const basemap = L.tileLayer(config.tiles, {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });

    map.setView(defaultCenter, defaultZoom);
    basemap.addTo(map);

    if (typeof(config.beforeLayers) !== 'undefined') {
      config.beforeLayers(map);
    }

    config.layers.forEach(element => {

      element.style = element.style || [];

      fetch(element.file)
      .then(function(response) {
        return response.json()
      }).then(function(json) {

        var fnargs = {};

        // find implementation in global config
        if (typeof(config.style) !== 'undefined') {
          fnargs.style = config.style;
        }
        if (typeof(config.onEachFeature) !== 'undefined') {
          fnargs.onEachFeature = config.onEachFeature;
        }
        if (typeof(config.pointToLayer) !== 'undefined') {
          fnargs.pointToLayer = config.pointToLayer;
        }

        // find implementation in current layer
        if (typeof(element.style) !== 'undefined') {
          fnargs.style = element.style;
        }
        if (typeof(element.onEachFeature) !== 'undefined') {
          fnargs.onEachFeature = element.onEachFeature;
        }
        if (typeof(element.pointToLayer) !== 'undefined') {
          fnargs.pointToLayer = element.pointToLayer;
        }

        var geojson = L.geoJSON(json, fnargs).addTo(map);
        if (typeof(config.prepareLayer) !== 'undefined') {
          config.prepareLayer(geojson);
        }
        if (typeof(element.prepareLayer) !== 'undefined') {
          element.prepareLayer(geojson);
        }
      }).catch(function(ex) {
        console.log('file: ' + element.file + 'parsing failed', ex)
      })
    });

    if (typeof(config.afterLayers) !== 'undefined') {
      config.afterLayers(map);
    }
  }
}


function check_script_loaded() {
  if(typeof(window['L']) !== 'undefined') {
    for(var key in LeafMapConfig.maps) {
      LeafMap.init(LeafMapConfig.maps[key]);
    }
  } else {
    setTimeout(function() {
      check_script_loaded();
    }, 500)
  }
}