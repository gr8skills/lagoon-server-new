mainApp.controller('createController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.roles = {};
        $scope.model.users = {};
        $scope.model.organizations = {};
        $scope.newUser = {};
        $scope.dbRespond = {}

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

        $scope.getData = function() {
            
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });

            appService.fetchData('/get-all-roles',
                function (resp) {
                    $scope.model.roles = resp.data.roles;
                },
                function (resp) {
                });
            appService.fetchData('/get-all-users',
                function (resp) {
                    $scope.model.users = resp.data.users;
                    // console.log($scope.model.users);
                },
                function (resp) {});
            appService.fetchData('/get-all-organization',
                function (resp) {
                    $scope.model.organizations = resp.data.organizations;
                },
                function (resp) {});
        };

        $scope.getData();

        $scope.saveUser = function () {
            $scope.payload = {
                'fname': $scope.newUser.fname,
                'lname': $scope.newUser.lname,
                'email': $scope.newUser.email,
                'phone': $scope.newUser.phone,
                'role_id': $scope.newUser.role_id,
                'organization_id': $scope.newUser.organization_id,
                'dob': $scope.newUser.dob,
                'gender': $scope.newUser.gender,
                'address': $scope.newUser.address,
                'state': $scope.newUser.state,
                'lga': $scope.newUser.lga,
                'password': $scope.newUser.password,
                'password_confirmation': $scope.newUser.password_confirmation,
            }
            appService.sendNormalData('/add-new-user', $scope.payload,
                function (resp) {
                    
                    $scope.newUser = {};
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

    }
]);