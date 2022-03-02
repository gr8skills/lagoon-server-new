mainApp.controller('lgaController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.lgas = {};
        $scope.newLga = {};
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

            appService.fetchData('/get-lgas',
                function (resp) {
                    $scope.lgas = resp.data.lgas; 
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-all-lgas',
                function (resp) {
                    $scope.allLgas = resp.data.lgas;
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
            appService.sendNormalData('/add-new-lga', $scope.payload,
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
            $('#kt_modal_4view').modal('show');
        }

        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        }

        // Update Lot
        $scope.updateLot = function () {
            $scope.payload = {
                'name': $scope.myAction.name,
                'id': $scope.myAction.id,
                'description': $scope.myAction.description,
            }
            appService.sendNormalData('/update-lga',$scope.payload,
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
                message: "Do you want to remove this lga?",
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
                appService.sendNormalData('/delete-lga', $scope.payload,
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
                        $scope.lgas = resp.data.lgas;
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
                        $scope.lgas = resp.data.lgas;
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
                        $scope.lgas = resp.data.lgas;
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
                        $scope.lgas = resp.data.lgas;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation 

        // Sort Lots by search
        $scope.lgaSearch = function() {
            if($scope.model.searchLga){
                appService.fetchData('/search-lgas/'+$scope.model.searchLga,
                    function (resp) {
                        $scope.lgas = resp.data.lgas;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };


    }]);