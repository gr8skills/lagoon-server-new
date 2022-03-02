mainApp.controller('viewController', ['$rootScope','$scope','$location','$window','$interval','$timeout','SweetAlert','appService',
    function ($rootScope, $scope, $location, $window, $interval, $timeout, SweetAlert, appService) {

        $scope.model = {};
        $scope.currentUser = {};
        $scope.model.roles = {};
        $scope.model.users = {};
        $scope.model.organizations = {};
        $scope.confirmationDialogConfig = {};
        $scope.newUser = {};
        $scope.dbAddRespond = {};
        $scope.dbRespond = {};
        $scope.model.searchUser = null;
        $scope.searchFilter = {};
        $scope.searchFilter.role = 0;
        $scope.searchFilter.organization = 0;

       $scope.sortKey =  'name';
       $scope.sortValue = 'asc';
        
        $scope.model.genders =[
            {
                'id': 1,
                'name': "Male",
            },
            {
                'id': 2,
                'name': "Female",
            }
        ];


        // $interval( function(){ 
        //     $scope.success = null;
        // }, 2000);

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

            appService.fetchData('/get-roles',
                function (resp) {
                    $scope.model.roles = resp.data.roles;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-users',
                function (resp) {
                    $scope.model.users = resp.data.users;
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

            appService.fetchData('/get-all-users',
                function (resp) {
                    $scope.model.tempUsers = resp.data.users;
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

        // save user
        $scope.saveUser = function () {
            KTApp.block('#kt_blockui_card', {
                overlayColor: '#000000',
                type: 'v2',
                state: 'success',
                message: 'Processing...'
            });
            $scope.payload = {
                'fname': $scope.newUser.fname,
                'lname': $scope.newUser.lname,
                'email': $scope.newUser.email,
                'phone': $scope.newUser.phone,
                'role_id': $scope.newUser.role_id,
                'organization_id': $scope.newUser.organization_id,
                'dob': $('#kt_datetimepicker_6b').val(), 
                'gender': $scope.newUser.gender,
                'address': $scope.newUser.address,
                'state': $scope.newUser.state,
                'lga': $scope.newUser.lga,
                'password': $scope.newUser.password,
                'password_confirmation': $scope.newUser.password_confirmation,
            }
            appService.sendNormalData('/add-new-user', $scope.payload,
                function (resp) {

                    KTApp.unblock('#kt_blockui_card');
                    $scope.newUser = {};
                    $('#kt_modal_4').modal('hide');
                    $scope.getData();
                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                },
                function (resp) {
                    KTApp.unblock('#kt_blockui_card');
                    $scope.dbRespond = resp.data;
                    appService.showMessage('error', resp.data.message);
                });
        };

        //Start Edit User
        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        };

        // Update User
        $scope.updateUser = function () {
            KTApp.block('#kt_blockui_card2', {
                overlayColor: '#000000',
                type: 'v2',
                state: 'success',
                message: 'Processing...'
            });
            $scope.payload = {
                'id': $scope.myAction.id,
                'fname': $scope.myAction.fname,
                'lname': $scope.myAction.lname,
                'fname': $scope.myAction.fname,
                'email': $scope.myAction.email,
                'phone': $scope.myAction.phone,
                'address': $scope.myAction.profile.address,
                'role_id': $scope.myAction.role_id,
                'organization_id': $scope.myAction.organization_id,
                'dob': $('#kt_datetimepicker_6').val(),
                'gender': $scope.myAction.profile.gender,
                'state': $scope.myAction.profile.state,
                'lga': $scope.myAction.profile.lga,
                'status': $scope.myAction.status,
            }
            appService.sendNormalData('/update-user',$scope.payload,
                function (resp) {
                    $scope.myAction = {};
                    $scope.getData();

                    $scope.dbRespond = resp.data;
                    appService.showMessage('success', resp.data.message);
                    KTApp.unblock('#kt_blockui_card2');
                    
                    $('#kt_modal_4edit').modal('hide');
                },
                function (resp) {
                    $scope.dbRespond = resp.data;
                    KTApp.unblock('#kt_blockui_card2');
                    appService.showMessage('error', resp.data.message);
                });
        };
        // Stop Edit User


        // Start Remove User
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
                appService.sendNormalData('/delete-user', $scope.payload,
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
        // End Remove User

        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.model.users = resp.data.users;
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
                        $scope.model.users = resp.data.users;
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
                        $scope.model.users = resp.data.users;
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
                        $scope.model.users = resp.data.users;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort Users by search
        $scope.userSearch = function() {
            if($scope.model.searchUser){
                appService.fetchData('/search-users/'+$scope.searchFilter.role+'/'+$scope.searchFilter.organization+'/'+$scope.model.searchUser+'/'+$scope.sortKey+'/'+$scope.sortValue,
                    function (resp) {
                        $scope.model.users = resp.data.users;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                appService.fetchData('/filter-users/'+$scope.searchFilter.role+'/'+$scope.searchFilter.organization+'/'+$scope.sortKey+'/'+$scope.sortValue,
                    function (resp) {
                        $scope.model.users = resp.data.users;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }

        };

        $scope.cancelUpdate = function(){
            $scope.myAction = {};
            $scope.model.newUser = {};
            $scope.dbRespond = {};
            $scope.getData();
        }

        $scope.sortById = function(){
            $scope.sortKey =  'id';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }

        $scope.sortByName = function(){
            $scope.sortKey =  'name';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }
        $scope.sortByEmail = function(){
            $scope.sortKey =  'email';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }
        $scope.sortByStatus = function(){
            $scope.sortKey =  'status';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }
        $scope.sortByLevel = function(){
            $scope.sortKey =  'role_id';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }
        $scope.sortByOrg = function(){
            $scope.sortKey =  'organization_id';
            if($scope.sortValue == 'asc'){
                $scope.sortValue = 'desc';
            }else{
                $scope.sortValue = 'asc';
            }
            

            $scope.userSearch();
        }



        //Upload Profile Image

        $('#avatar_upload').on('change', function () {

            //upload to server
            var file = $(this).prop("files");
            var formData = new FormData();
            formData.append('avatar', file[0]);

            appService.uploadFormWithFile('/update-avatar/'+$scope.myAction.user_id, formData,
            function (resp) {
                appService.showMessage('success', resp.data.message);
                $scope.getData();
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        });

    }
]);