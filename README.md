## LeafMapX

* Map component for MODX Revolution

## Description

Just my MODX-wrapper for using Leaflet, require js libs & call snippet

## Example

```
{'LeafMapX' | snippet : [
    'target' => 'swMap',
    'startZoom' => 7,
    'startPoint' => '46.570,8.1',
    'tiles' => 'https://tile.thunderforest.com/neighbourhood/{z}/{x}/{y}.png?apikey=22a9e1c73c9940d1bb412c470b5fa5bc',
    'layers' => [
        [
            'file' => '/assets/maps/sw_catone2.geojson',
            'style' => [
                "color" => "#1d4aa2",
                "weight" => 2,
                "fillOpacity" => 0.35
            ]
        ]
    ]
]}
```

Also may overridden in external JS-file, just add global object LeafMapConfig.maps.__target name__

```javascript
LeafMapConfig.maps.swMap.beforeLayers = function(map) {
    // here some magic
});
```

## override default fields

* beforeLayers
* style
* onEachFeature
* pointToLayer
* prepareLayer
* afterLayers
