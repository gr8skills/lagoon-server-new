mainApp.controller('lotController', ['$rootScope','$scope','$location','$window','$timeout','appService', 'mapService',
    function ($rootScope, $scope, $location, $window, $timeout, appService, mapService) {

        $scope.model = {};
        $scope.lots = {};
        $scope.assets = {};
        $scope.newLot = {};
        $scope.myAction = {};
        $scope.confirmationDialogConfig = {};

        $scope.getData = function() {
            
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-lots',
                function (resp) {
                    $scope.lots = resp.data.lots;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            // appService.fetchData('');
            appService.fetchData('/get-all-lots',
                function (resp) {
                    $scope.tempLots = resp.data.lots;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
        };
        $scope.getData();


        $scope.saveLot = function () {
            $scope.payload = {
                'name': $scope.newLot.name,
                'description': $scope.newLot.description,
            }
            appService.sendNormalData('/add-new-lot', $scope.payload,
                function (resp) {
                    $scope.newLot = {};
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

        $scope.showData = function(record){
            $scope.myAction = record;
            // console.log(record.id);
            //Fetch the assets belonging to a lot
            appService.fetchData('/get-lot-asset/'+record.id, 
                function(response) {
                    $scope.assets = response.data.lot.assets;
                    console.log($scope.assets);
                }, 
                function(response) {
                    appService.showMessage('error', response.data.message);
                }
            );
            if($scope.assets) {
                mapService.initMap();
                $('#kt_modal_4view').modal('show');
            }            
            
        }

        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        }

        $scope.cancelUpdate = function(){
            $scope.myAction = {};
            $scope.model.newLot = {};
            $scope.dbRespond = {};
            $scope.getData();
        }

        // Update Lot
        $scope.updateLot = function () {
            $scope.payload = {
                'name': $scope.myAction.name,
                'id': $scope.myAction.id,
                'description': $scope.myAction.description,
            }
            appService.sendNormalData('/update-lot',$scope.payload,
                function (resp) {
                    $scope.myAction = {};
                    $scope.getData();

                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                    
                    $('#kt_modal_4edit').modal('hide');
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };
        // Stop Edit Lot

        // Start Remove Lot
        $scope.deleteData = function(record){
            $scope.myAction = record;
            $scope.myAction.on = record;
            $scope.confirmationDialogConfig = {
                title: "Delete Lot",
                message: "Do you want to remove this lot?",
                buttons: [{
                    label: "Remove",
                    action: "remove"
                }]
            };
            $('#confirmationDialog').modal('show');
        }

        $scope.executeDialogAction = function(action){

            if(action == "remove"){
                $scope.payload = {
                    'id': $scope.myAction.id,
                };
                appService.sendNormalData('/delete-lot', $scope.payload,
                    function (resp) {
                        $scope.getData();
                        $scope.myAction = {}
                        $scope.dbRespond = resp.data;
                        appService.showMessage('success', resp.data.message);
                    },
                    function (resp) {
                        $scope.getData();
                        $scope.myAction = {}
                        $scope.dbRespond = resp.data;
                        appService.showMessage('error', resp.data.message);
                    });

                $('#confirmationDialog').modal('hide');
            }

            if(action == "close"){
                $('#confirmationDialog').modal('hide');
                $scope.myAction = {};
            }
        };
        // End Remove Lot


        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.lots = resp.data.lots;
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
                        $scope.lots = resp.data.lots;
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
                        $scope.lots = resp.data.lots;
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
                        $scope.lots = resp.data.lots;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort Lots by search
        $scope.lotSearch = function() {
            if($scope.model.searchLot){
                appService.fetchData('/search-lots/'+$scope.model.searchLot,
                    function (resp) {
                        $scope.lots = resp.data.lots;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };


    }]);