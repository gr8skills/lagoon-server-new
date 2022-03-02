mainApp.controller('locationController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.confirmationDialogConfig = {};
        $scope.model.searchLocation = null;
        $scope.dbRespond = {}
        $scope.newLocation = {}

        $scope.currentUser = null;
        $scope.model.locations = null;
        $scope.model.lots = null;
        $scope.model.lgas = null;
        $scope.model.locations = null;


        $scope.getData = function() {
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-locations',
                function (resp) {
                    $scope.model.locations = resp.data.locations;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-lots',
                function (resp) {
                    $scope.model.tempLots = resp.data.lots;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-lgas',
                function (resp) {
                    $scope.model.lgas = resp.data.lgas;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-lgas',
                function (resp) {
                    $scope.model.allLgas = resp.data.lgas;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });


            appService.fetchData('/get-power-source',
                function (resp) {
                    $scope.model.powerSources = resp.data.powerSource;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-assets',
                function (resp) {
                    $scope.model.assets = resp.data.assets;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
        };

        $scope.getData();

        $scope.showData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4view').modal('show');
        };


        $scope.saveLocation = function () {
            $scope.payload = {
                'name': $scope.newLocation.name,
                'local_government_area': $scope.newLocation.lga,
                'lot': $scope.newLocation.lot,
                'power_source': $scope.newLocation.ps,
                'power_source_size': $scope.newLocation.pss,
                'number_of_poles': $scope.newLocation.nop,
                'number_of_poles': $scope.newLocation.nop,
                'assets': $scope.newLocation.assets,
            };
            appService.sendNormalData('/add-new-location', $scope.payload,
                function (resp) {
                    $scope.newLocation = {};
                    $('#kt_modal_4').modal('hide');
                    $scope.getData();
                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };

        //Start edit role
        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        };

        $scope.updateLocation = function () {

            $scope.payload = {
                'id': $scope.myAction.id,
                'name': $scope.myAction.name,
                'local_government_area': $scope.myAction.lga_id,
                'lot': $scope.myAction.lot_id,
                'power_source': $scope.myAction.power_source_id,
                'power_source_size': $scope.myAction.size,
                'number_of_poles': $scope.myAction.nop,
                'assets': $scope.myAction.assets,
            };
            appService.sendNormalData('/update-location',$scope.payload,
                function (resp) {
                    $scope.getData();
                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                    $scope.myAction = {};
                    $('#kt_modal_4edit').modal('hide');
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };

        $scope.cancelUpdate = function(){
            $scope.myAction = {};
            $scope.newLocationType = {};
            $scope.dbRespond = {}
            $scope.getData();
        }
        //End edit role

        //Start role delete
        $scope.deleteData = function(record){
            $scope.myAction = record;
            $scope.confirmationDialogConfig = {
                title: "Delete Data",
                message: "Do you want to remove this data?",
                buttons: [{
                    label: "Remove",
                    action: "remove"
                }]
            };
            $('#confirmationDialog').modal('show');
        };

        $scope.executeDialogAction = function(action){

            // Remove role
            if(action == "remove"){

                console.log($scope.myAction);
                $scope.payload = {
                    'id': $scope.myAction.id,
                };
                appService.sendNormalData('/delete-location', $scope.payload,
                    function (resp) {
                        if(resp.data.success == true){
                            $scope.getData();
                            $scope.dbRespond = resp.data;
                            appService.showMessage('success', resp.data.message);
                        }
                        $scope.myAction = {}
                    },
                    function (resp) {
                        $scope.dbRespond = resp.data;
                        appService.showMessage('error', resp.data.message);
                    });

                $('#confirmationDialog').modal('hide');
            }

            if(action == "close"){
                $scope.myAction = {};
            }
        };
        //End role delete

        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.model.locations = resp.data.locations;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.prevPage = function(record){
            if(record.prev_page_url) {
                appService.fetchData(record.prev_page_url,
                    function (resp) {
                        $scope.model.locations = resp.data.locations;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.nextPage = function(record){
            if(record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        $scope.model.locations = resp.data.locations;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.lastPage = function(record){
            if(record.current_page != record.last_page) {
                appService.fetchData(record.last_page_url,
                    function (resp) {
                        $scope.model.locations = resp.data.locations;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort location by search
        $scope.locationSearch = function() {
            if($scope.model.searchLocation){

                appService.fetchData('/search-location/'+$scope.model.searchLocation,
                    function (resp) {
                        $scope.model.locations = resp.data.locations;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };


    }]);