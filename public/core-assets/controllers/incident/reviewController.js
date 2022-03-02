mainApp.controller('reviewController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.userSearch = '';
        $scope.other_user = {};
        $scope.approved = false;
        $term = $('#assigned_text').val();
        if ($term == 5) {
            $scope.approved = true;
        } 
        // else if($term == 5) {
        //     $scope.done = true;
        // }

        //Reviewing the incident details
        // $scope.reviewModal = function(id) {
        //     console.log(id);
        //     appService.fetchData('incidents-detail/'+id,
        //             function (resp) {
        //                 $scope.incidentDetail = resp.data.review[0];
        //                 console.log($scope.incidentDetail);
        //             },
        //             function (resp) {
        //                 console.log(resp);
        //             });
        // };



        appService.fetchData('/other_user', 
        function(resp){
            $scope.other_user = resp.data.other_user.data;
            // console.log($scope.other_user);
        }, function (error) {
            console.log(error);
        });
        //sorting the usersotherUser()
        $scope.sort_assignOther = function() {
            $scope.userSearch = $('#assign_id').val();
            console.log($scope.userSearch);
            if($scope.userSearch){
                appService.fetchData('/search-user/'+$scope.userSearch,
                    function (resp) {
                        $scope.other_user = resp.data.other_user.data;
                        console.log($scope.other_user);
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };

      //Approving the incident
      $scope.approveIncident = function($id){
        $incident_id = $('#incident_id').val();
        var obj ={
            'incident_id': $incident_id
        };
        appService.sendNormalData('/approve-incident',
            obj,
            function(resp) {
                console.log(resp);
                $scope.approved = true;
                showSuccessMessage(resp.data.message);
                $('#approve').hide();
            },
            function(resp) {
            });
        };

        //selecting the user
        $scope.selectUser = (user) => {
            $('#assign_id').val(user.name);
            $scope.userSearch = $('#assign_id').val();
            $scope.selectUser_id = user.id;
        };
        //submitting the incident to a user to create a workOrder
        $scope.sendAssignment = function(user){
            if ($scope.comment == '' || $scope.userSearch  == ''){
                $('#error_').append('');
                $('#error_').show();
                $('#error_').append('All field are   required');

            } else {
                $('#sendAssign').text('')
                    .append('Assigning...')
                    .addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',true);
                $incident_id = $('#incident_id').val();
                var obj ={
                    'user_id': $scope.selectUser_id,
                    'incident_id': $incident_id,
                    'comment': $scope.comment
                };
                // console.log(obj);
                appService.sendNormalData('/add-task',
                    obj,
                    function(resp) {
                        $scope.comment ='';
                        //changing the text of the incident after assigning to user
                        $('assigned').text('').append('Assigned');
                        $('#assign_id').val('');
                        $('#sendAssign').text('')
                            .append('Assign')
                            .removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',false);
                            showSuccessMessage(resp.data.message);


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

    }
]);