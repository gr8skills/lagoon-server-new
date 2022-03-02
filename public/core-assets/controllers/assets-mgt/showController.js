mainApp.controller('showController', ['$rootScope', '$scope', '$location', '$window', '$timeout', 'appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.currentUser = {};
        $scope.asset = {};
        // angular.element(document.querySelector('.mySelector'));
        $scope.currentAsset = angular.element(document.querySelector('#activeAsset')).val();



        $scope.getData = function () {

            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-asset/' + $scope.currentAsset,
                function (resp) {
                    $scope.asset = resp.data.asset;
                    $scope.addMarker($scope.asset.lat, $scope.asset.long, $scope.asset);
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
        }

        $scope.getData();

        // start navigation
        $scope.firstPage = function (record) {
            if (record.current_page != 1) {
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.asset = resp.data.asset;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.prevPage = function (record) {
            if (record.prev_page_url) {
                appService.fetchData(record.prev_page_url,
                    function (resp) {
                        $scope.asset = resp.data.asset;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.nextPage = function (record) {
            if (record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        $scope.asset = resp.data.asset;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.lastPage = function (record) {
            if (record.current_page != record.last_page) {
                appService.fetchData(record.last_page_url,
                    function (resp) {
                        $scope.asset = resp.data.asset;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation




        //Mapping
        $scope.markerLat = $scope.asset.lat;
        $scope.markerLng = $scope.asset.long;
        $scope.infoTitle = 'Lagos State Electrification Broad';

        var lagos = new google.maps.LatLng($scope.markerLat, $scope.markerLng);

        var mapOptions = {
            zoom: 20,
            center: lagos,
            mapTypeId: google.maps.MapTypeId.TERRAIN
        }

        $scope.map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

        $scope.markers = [];

        var infoWindow = new google.maps.InfoWindow();

        $scope.addMarker = function (lat, lng, title) {

            var latLang = new google.maps.LatLng(lat, lng);
            if (title.status == 1) {
                var status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Good</span>';
            }
            else if (title.status == 2) {
                var status = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded">Reported</span>';
            }
            else if (title.status == 3) {
                var status = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Bad</span>';
            };

            var marker = new google.maps.Marker({
                map: $scope.map,
                position: latLang,
                title: title.lot.name,
                type: title.type.name,
                nop: title.nop,
                locationCount: title.locationCount,
                status: status,
                id: title.asset_id
            });
            marker.content = '<div class="poi-info-window gm-style">\
            Asset Type: ' + marker.type + '<br>\
            No. of Location: ' + marker.locationCount + '<br>\
            No. of Poles: ' + marker.nop + '<br>\
            Status: ' + marker.status + '<br>\
            <div class="view-link"> <a jstcache="6" href="/asset/' + marker.id + '"> <span> View More </span> </a> </div>\
            </div>';

            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.setContent('<h3 class="title full-width"><i class="flaticon2-start-up"></i> ' + marker.title + '(#'+marker.id+')</h3>' +
                    marker.content);
                infoWindow.open($scope.map, marker);
            });

            $scope.markers.push(marker);

            $scope.map.setCenter(latLang);
        };

        $scope.openInfoWindow = function (e, selectedMarker) {
            e.preventDefault();
            google.maps.event.trigger(selectedMarker, 'click');
        }

    }
]);
