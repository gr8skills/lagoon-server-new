mainApp.controller('profileController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.user = {};
        $scope.currentUser = {};
        $scope.model.activities = {};
        $scope.dbRespond = {};
        $scope.newPassword = {};
        $scope.username = angular.element(document.querySelector('#user')).val();
        $scope.model.searchActivity = null;
        $scope.searchFilter = null;
        $scope.profile_avatar = null;


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

            appService.fetchData('/get-user-data/'+$scope.username,
                function (resp) {
                    $scope.model.user = resp.data.user;
                    $scope.workOrders = resp.data.workOrders;
                    $scope.incidents = resp.data.incidents;
                    $scope.activities = resp.data.activities;
                    $scope.tasks = resp.data.tasks;
                    $scope.notifications = resp.data.notifications;
                },
                function (resp) {
                    // console.log(resp.data); 
                });
            appService.fetchData('/get-user-activities/'+$scope.username,
                function (resp) {
                    $scope.model.activities = resp.data.activities;
                },
                function (resp) {
                    // console.log(resp.data);
                });

            appService.fetchData('/get-all-roles',
                function (resp) {
                    $scope.model.roles = resp.data.roles;
                },
                function (resp) {
                });
            appService.fetchData('/get-all-organization',
                function (resp) {
                    $scope.model.organizations = resp.data.organizations;
                },
                function (resp) {});
        };

        $scope.getData();


        // Update User
        $scope.updateUser = function () {
            $scope.payload = {
                'id': $scope.model.user.id,
                'fname': $scope.model.user.fname,
                'lname': $scope.model.user.lname,
                'fname': $scope.model.user.fname,
                'email': $scope.model.user.email,
                'phone': $scope.model.user.phone,
                'role_id': $scope.model.user.role_id,
                'organization_id': $scope.model.user.organization_id, 
                'dob': $('#kt_datetimepicker_6b').val(),
                'gender': $scope.model.user.profile.gender,
                'state': $scope.model.user.profile.state,
                'address': $scope.model.user.profile.address,
                'lga': $scope.model.user.profile.lga,
            }
            appService.sendNormalData('/update-user',$scope.payload,
                function (resp) {
                    $scope.myAction = {};
                    $scope.getData();
                    appService.showMessage('success', resp.data.message);
                    $scope.dbRespond = resp.data;
                    
                    $('#kt_modal_4edit').modal('hide');
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                    $scope.dbRespond = resp.data;
                });
        };
        // Stop Edit User

        $scope.updatePassword = function(){
            console.log($scope.newPassword);
            appService.sendNormalData('/change-password',$scope.newPassword,
                function (resp) {
                    $scope.newPassword = {};
                    $scope.getData();
                    appService.showMessage(resp.data.status, resp.data.message);
                    $scope.dbRespond = resp.data;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                    $scope.dbRespond = resp.data;
                });
        }

        $scope.loadMore = function(record){
            if(record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        total = parseInt(resp.data.activities.to - resp.data.activities.from + 1 );

                        for (var i=0; i<total; i++) {
		                    $scope.model.activities.data.push(resp.data.activities.data[i]);
                        }
                        
                        // $scope.model.activities.data.push(resp.data.activities.data);
                        $scope.model.activities.next_page_url = resp.data.activities.next_page_url;
                        // $scope.model.activities = resp.data.activities;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };


        // Sort Users by search
        $scope.activitySearch = function() {
            if($scope.model.searchActivity && !$scope.searchFilter){
                appService.fetchData('/search-activity/'+$scope.username+'/'+$scope.model.searchActivity,
                    function (resp) {
                        $scope.model.activities = resp.data.activities;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }else{
                $scope.getData();
            }

        };

        //Upload Profile Image

        $('#avatar_upload').on('change', function () {

            //upload to server
            var file = $(this).prop("files");
            var formData = new FormData();
            formData.append('avatar', file[0]);

            appService.uploadFormWithFile('/update-avatar/'+$scope.username, formData,
            function (resp) {
                appService.showMessage('success', resp.data.message);
                $scope.getData();
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        });



        $scope.readData = function(record){
            $scope.myAction = record;
            appService.fetchData('/read-notification/'+record.id,
            function (resp) {
                $scope.getData();
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        };

        $scope.unreadData = function(record){
            $scope.myAction = record;
            appService.fetchData('/unread-notification/'+record.id,
            function (resp) {
                $scope.getData();
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        };
    }
]);