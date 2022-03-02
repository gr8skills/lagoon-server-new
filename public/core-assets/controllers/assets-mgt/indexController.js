mainApp.controller('indexController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.roles = {};
        $scope.model.users = {};
        $scope.confirmationDialogConfig = {};
        $scope.newAsset = {};
        $scope.dbAddRespond = {};
        $scope.dbRespond = {};
        $scope.model.searchAsset = null;
        $scope.searchFilter = {};

        $scope.currentUser = null;
        $scope.model.locations = null;
        $scope.model.assets = null;
        $scope.model.organizations = null;
        $scope.model.assetTypes = null;
        $scope.model.lots = null;
        $scope.model.lgas = null;
        $scope.model.locations = null;
        $scope.model.tempAssets = {}
        $scope.assetUnit = false;

        $scope.sortUnit = 0;
        $scope.sortType = 0;
        $scope.sortStatus = 0;
        $scope.sortLot = 0;
        $scope.sortLga = 0;

        // $scope.sortAssets = function(){
        //     appService.fetchData('/sort-assets/'+$scope.sortUnit+'/'+$scope.sortType+'/'+$scope.sortStatus+'/'+$scope.sortLot+'/'+$scope.sortLga,
        //         function (resp) {
        //             $scope.model.assets = resp.data.assets;
        //         },
        //         function (resp) {
        //             appService.showMessage('error', resp.data.message);
        //         });
        // }

        $scope.status = [
            {
                id: 1,
                name: 'Good/Healthy'
            },
            {
                id: 2,
                name: 'Reported'
            },
            {
                id: 3,
                name: 'Bad'
            }
        ];
        $scope.getData = function() {

            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-organization',
                function (resp) {
                    $scope.model.organizations = resp.data.organizations;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-asset-types',
                function (resp) {
                    $scope.model.tempAssetTypes = resp.data.assetTypes;
                    $scope.model.assetUnits = resp.data.assetUnits;
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

            appService.fetchData('/get-all-lgas',
                function (resp) {
                    $scope.model.tempLgas = resp.data.lgas;
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

        // save asset
        $scope.saveAsset = function () {
            $scope.payload = {
                'asset_id': $scope.newAsset.asset_id,
                'description': $scope.newAsset.description,
                'asset_type': $scope.newAsset.asset_type,
                'asset_unit': $scope.newAsset.asset_unit,
                'lat': $scope.newAsset.lat,
                'long': $scope.newAsset.long,
                'yoi': $('#kt_datetimepicker_6').val(),
                'local_government_area': $scope.newAsset.lga,
                'lot': $scope.newAsset.lot,
            }
            appService.sendNormalData('/add-new-asset', $scope.payload,
                function (resp) {
                    $scope.newAsset = {};
                    $('#kt_modal_4').modal('hide');
                    $scope.getAssets();
                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };

        //Start Edit Asset
        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        };

        // Update Asset
        $scope.updateAsset = function () {
            $scope.payload = {
                'id': $scope.myAction.id,
                'asset_id': $scope.myAction.asset_id,
                'description': $scope.myAction.description,
                'asset_type': $scope.myAction.asset_types_id,
                'asset_unit': $scope.myAction.asset_unit_id,
                'lat': $scope.myAction.lat,
                'long': $scope.myAction.long,
                'yoi': $('#kt_datetimepicker_6b').val(),
                'local_government_area': $scope.myAction.lga_id,
                'lot': $scope.myAction.lot_id,
                'status': $scope.myAction.status,
            }
            // console.log($scope.payload)
            appService.sendNormalData('/update-asset',$scope.payload,
                function (resp) {
                    $scope.myAction = {};
                    $scope.getAssets();

                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                    
                    $('#kt_modal_4edit').modal('hide');
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };
        // Stop Edit Asset


        // Start Removing Asset
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

            if(action == "remove"){
                $scope.payload = {
                    'id': $scope.myAction.id,
                };
                appService.sendNormalData('/delete-asset', $scope.payload,
                    function (resp) {
                        $scope.getAssets();
                        $scope.myAction = {}
                        $scope.dbRespond = resp.data;
                        appService.showMessage('success', resp.data.message);
                    },
                    function (resp) {
                        $scope.getAssets();
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
        // End Remove Asset

        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.model.assets = resp.data.assets;
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
                        $scope.model.assets = resp.data.assets;
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
                        $scope.model.assets = resp.data.assets;
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
                        $scope.model.assets = resp.data.assets;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort Assets by search
        $scope.assetSearch = function() {
            if($scope.model.searchAsset){
                appService.fetchData('/search-assets/'+$scope.sortUnit+'/'+$scope.sortType+'/'+$scope.sortStatus+'/'+$scope.sortLot+'/'+$scope.sortLga+'/'+$scope.model.searchAsset,
                    function (resp) {
                        $scope.model.assets = resp.data.assets;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getAssets();
            }

        };

        $scope.cancelUpdate = function(){
            $scope.myAction = {};
            $scope.model.newAsset = {};
            $scope.dbRespond = {};
            $scope.getData();
        }



        // Sort Lots by search
        $scope.sortByUnit = function(data) {
            $scope.sortUnit = data;
            $scope.getAssets();
        };
        $scope.sortByType = function(data) {
            $scope.sortType = data;
            $scope.getAssets();
        };
        $scope.sortByStatus = function(data) {
            $scope.sortStatus = data;
            $scope.getAssets();
        };
        $scope.sortByLot = function(data){
            $scope.sortLot = data;
            $scope.getAssets();
        }
        $scope.sortLGA = function(data){
            $scope.sortLga = data;
            $scope.getAssets();
        }

        $scope.getAssets = function(sortUnit){
            appService.fetchData('/sort-assets/'+$scope.sortUnit+'/'+$scope.sortType+'/'+$scope.sortStatus+'/'+$scope.sortLot+'/'+$scope.sortLga,
                function (resp) {
                    $scope.model.assets = resp.data.assets;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
                $scope.assetUnit = true;
        }


    }]);