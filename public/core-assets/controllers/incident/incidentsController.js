mainApp.controller('incidentsController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.resolved = 0;$scope.unresolved = 0;
        $scope.model.incidentSearch = '';
        $scope.incidents = {};
        $scope.incidentDetail = {};
        $scope.user = {};
        $scope.other_user ={};
        $scope.users = {};
        $scope.userSearch = '';
        $scope.comment = '';
        $scope.record = {};
        $scope.softdelete = 0;

        $scope.getData = function() {
            appService.fetchData('/view-incident', 
            function(resp){
                console.log(resp);
                $scope.incidents = resp.data.incident;
                $scope.user = resp.data.user_role;
                $scope.other_user = resp.data.other_user.data;
                // $scope.stress = resp.data.other_user;
                // $scope.model.users = resp.data.other_user.data;
                // console.log($scope.stress);
                


                for (const key in resp.data.soft_delete) {//soft-delete count
                    $scope.soft_delete += 1;
                }
                // console.log($scope.incidents);
                $scope.resolved = 0; 
                $scope.unresolved = 0;
                $scope.incidents.data.forEach(element => {
                    if(element.status == 5) {
                        $scope.resolved += 1;
                    } else {
                        $scope.unresolved += 1;
                        // console.log('yes');
                    }
                });
            }, function (error) {
                console.log(error);
            });
        };
        $scope.getdetails = function(){
            $scope.resolved =0; $scope.unresolved = 0;
            for(var i = 0; i < $scope.incidents.data; i++) {
                if ($scope.incidents.data[i].status == 1) {
                    $scope.resolved += 1;
                } else if($scope.incidents.data[i].status == 2 || $scope.incidents.data[i].status == 4){
                    $scope.unresolved +=1;
                }
            }
        };

        //Oninit()-->function
        $scope.getData();
        $scope.getdetails();



        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.incidents = resp.data.incident;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };

        $scope.prevPage = function(record){
            if(record.prev_page_url) {
                appService.fetchData(record.prev_page_url,
                    function (resp) {
                        $scope.incidents = resp.data.incident;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };

        $scope.nextPage = function(record){
            if(record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        $scope.incidents = resp.data.incident;
                        console.log($scope.incidents);
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };

        $scope.lastPage = function(record){
            if(record.current_page != record.last_page) {
                appService.fetchData(record.last_page_url,
                    function (resp) {
                        $scope.incidents = resp.data.incident;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };
        // End navigation

        // Sort roles by search
        $scope.incidentSearch = function() {
            $search = $('#incidentSearch').val();
            $scope.model.incidentSearch = $search;
            if($scope.model.incidentSearch){
                appService.fetchData('search-incident/'+$scope.model.incidentSearch,
                    function (resp) {
                        $scope.resolved =0; $scope.unresolved = 0;
                        $scope.incidents = resp.data.incident;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                // $scope.getdetails();
                $scope.getData();
            }
        };

        //searching
        $('#incidentSearch').keypress(function(event){
            $search = $('#incidentSearch').val();
            $scope.model.incidentSearch = $search;
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                if ($search == '') {
                    showerrorMessage('Search term is empty');
                } 
                else {
                    $scope.incidentSearch();
                }
            }
        });

        //Error Message
        showerrorMessage = function (message) {
            type ='danger';
            $.notify({
                icon: "<i class=\"fas fa-exclamation-circle\" style=\"font-size:30px\"></i>",
                message: message
            }, {
                type: type,
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });
        };

        //sorting the users
         $scope.sort_assignOther = function() {
            $scope.userSearch = $('#assign_id').val();
            console.log($scope.userSearch);
            if($scope.userSearch){
                appService.fetchData('search-user/'+$scope.userSearch,
                    function (resp) {
                        $scope.other_user = resp.data.other_user.data;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };

        //selecting the user
        $scope.selectUser = (user) => {
            $('#assign_id').val(user.name);
            $scope.userSearch = $('#assign_id').val();
            $scope.selectUser_id = user.id;
        };
        $scope.modal = function(record) {
            $scope.record = record;
            $('#assignDialog').modal('show');

        };
        //submitting the incident to a user to create a workOrder
        $scope.sendAssignment = function(user){
            if ($scope.comment == '' || $scope.userSearch  == ''){
                $('#error_').append('');
                $('#error_').show();
                $('#error_').append('Comment is required');

            } else {
                $('#sendAssign').text('')
                    .append('Assigning...')
                    .addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',true);
                
                var obj ={
                    'user_id': $scope.selectUser_id,
                    'incident_id': $scope.record.id,
                    'comment': $scope.comment
                };
                console.log(obj);
                appService.sendNormalData('/add-task',
                    obj,
                    function(resp) {
                        console.log(resp);
                        $scope.comment ='';
                        $('#assign_id').val('');
                        $('#sendAssign').text('')
                            .append('Okay')
                            .removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',false);
                        $('#assignDialog').modal('hide');
                            showSuccessMessage(resp.data.message);
                            // $window.location.reload();
                            window.location.reload(false); 


                    },
                    function(resp){
                        console.log(resp);
                    }    
                );
            }
        };
            //alertMessage
            showSuccessMessage = function (message){
                type ='success';
                $.notify({
                    icon: "<i class=\"fas fa-check-circle\" style=\"font-size:30px\"></i>",
                    message: message
                }, {
                    type: type,
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            };

}]);