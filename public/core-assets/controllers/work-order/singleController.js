mainApp.controller('singleController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.details = {};
        $scope.user_role = $('#user_role').val();
        $scope.currentUserID = $('#currentUser').val();
        $scope.id = $('#workorderId').val();
        $scope.model.comments = {};
        $scope.getData = function (){
            appService.fetchData('/get-workorder-detail/'+$scope.id,
            function(resp) {
                $scope.details = resp.data.workorder;
                $scope.currentUser = resp.data.currentUser;
                console.log($scope.details);
                console.log($scope.currentUser);
            },
            function(resp){
                console.log(resp);
            });
        };
        if($scope.id != '') {
            $scope.getData();
        }

        $scope.comment = function() {
            $comment = $('#comment_text').val();
            var tag = $("input[name='tag']:checked").val();
            var date = new Date().toLocaleString();
            var tag = $("input[name='tag']:checked").val();
            if(tag == undefined) {
                $('#error_').show();
            }else
            if($comment == '' && $comment == undefined) {
                $('#error_file').show();
            } else {

                $obj = {
                    'comment': $comment,
                    'date' : date,
                    'tag': tag,
                    'workorderid' : $scope.id
                };
                $('#commentbtn').text('')
                .append('Sending..')
                .addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',true);
                appService.sendNormalData('/workorder-feedback', $obj,
                function(resp){
                    console.log(resp);
                    $('#comment_text').val('');
                    $('#commentbtn').text('')
                    .append('Comment')
                    .removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',false);
                    if (resp.data.message != '') {
                        $('#error_file1').show();
                    } else {
                    $scope.details = resp.data.workorder;
                    $('#error_file').hide();
                    $('#error_file1').hide();
                    $('#error_').hide();
                    }
                },
                function (error){
                    console.log(error);
                });
            }
        };
        
    }
]);