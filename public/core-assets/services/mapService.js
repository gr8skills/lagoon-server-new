mainApp.factory('mapService', [function() {
            
    var initMap = function() {
        var map = new GMaps({
            div: '#kt_gmap_3',
            lat: 6.7942689,
            lng: 6.5104115,
        });
        map.setZoom(5);
    }

    var addMapMarker = function(mapObj, asset) {
        mapObj.addMarker({
            lat: asset.lat,
            lng: asset.long,
            title: 'Lima',
            details: {
                database_id: 42,
                author: 'HPNeo'
            },
            click: function(e) {
                if (console.log) console.log(e);
                alert('You clicked in this marker');
            }
        });
    };
        
    return {
        initMap: initMap,
        addMapMarker: addMapMarker,
    };
}]);