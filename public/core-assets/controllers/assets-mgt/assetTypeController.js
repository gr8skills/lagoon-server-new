mainApp.controller('assetTypeController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.newAssetType = {};
        $scope.confirmationDialogConfig = {};
        $scope.model.searchAssetType = null;
        $scope.dbRespond = {}
        $scope.newAssetType = {}
        $scope.currentUser = {};
        $scope.model.tempAssetTypes = {};


        $scope.getData = function() {
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-asset-types',
                function (resp) {
                    $scope.model.assetTypes = resp.data.assetTypes;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-all-asset-types',
                function (resp) {
                    $scope.model.tempAssetTypes = resp.data.assetTypes;
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


        $scope.saveAssetType = function () {
            $scope.payload = {
                'name': $scope.newAssetType.name,
                'description': $scope.newAssetType.description,
            };
            appService.sendNormalData('/add-new-asset-type', $scope.payload,
                function (resp) {
                    $scope.newAssetType = {};
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

        $scope.updateAssetType = function () {
            appService.sendNormalData('/update-asset-type',$scope.myAction,
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
            $scope.newAssetType = {};
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
                appService.sendNormalData('/delete-asset-type', $scope.payload,
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
                        $scope.model.assetTypes = resp.data.assetTypes;
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
                        $scope.model.assetTypes = resp.data.assetTypes;
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
                        $scope.model.assetTypes = resp.data.assetTypes;
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
                        $scope.model.assetTypes = resp.data.assetTypes;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort asset-type by search
        $scope.roleSearch = function() {
            if($scope.model.searchAssetType){

                appService.fetchData('/search-asset-type/'+$scope.model.searchAssetType,
                    function (resp) {
                        $scope.model.assetTypes = resp.data.assetTypes;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };


    }]);