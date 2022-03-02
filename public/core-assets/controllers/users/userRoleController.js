mainApp.controller('userRoleController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.newRole = {};
        $scope.confirmationDialogConfig = {};
        $scope.model.searchRole = null;
        $scope.dbRespond = {}
        $scope.newRole = {}
        $scope.currentUser = {};


        $scope.getData = function() {
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-roles',
                function (resp) {
                    $scope.model.roles = resp.data.roles;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
            appService.fetchData('/get-all-roles',
                function (resp) {
                    $scope.model.tempRoles = resp.data.roles;
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


        $scope.saveRole = function () {
            $scope.payload = {
                'title': $scope.newRole.title,
                'label': $scope.newRole.label,
                'description': $scope.newRole.description,
            };
            appService.sendNormalData('/add-new-role', $scope.payload,
                function (resp) {
                    $scope.newRole = {};
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

        $scope.updateRole = function () {
            appService.sendNormalData('/update-role',$scope.myAction,
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
            $scope.newRole = {};
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
                appService.sendNormalData('/delete-role', $scope.payload,
                    function (resp) {
                        if(resp.data.success == true){
                            // var index = $scope.model.roles.data.indexOf($scope.myAction);
                            // $scope.model.roles.data.splice(index, 1);
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
                        $scope.model.roles = resp.data.roles;
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
                        $scope.model.roles = resp.data.roles;
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
                        $scope.model.roles = resp.data.roles;
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
                        $scope.model.roles = resp.data.roles;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort roles by search
        $scope.roleSearch = function() {
            if($scope.model.searchRole){

                appService.fetchData('/search-roles/'+$scope.model.searchRole,
                    function (resp) {
                        $scope.model.roles = resp.data.roles;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };


    }]);