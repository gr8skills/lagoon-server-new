mainApp.controller('workOrderTypeController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.Mydata = {};
        $scope.confirmationDialogConfig = {};

        $scope.getData = function() {
            appService.fetchData('https://keenthemes.com/metronic/tools/preview/api/datatables/demos/default.php',
                function (resp) {
                    $scope.Mydata = resp.data.data;
                    console.log($scope.Mydata)
                },
                function (resp) {
                    $scope.Mydata = resp.data.data;
                    console.log($scope.Mydata)
                });
        };
        $scope.getData();

        $scope.showData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4view').modal('show');
        }

        $scope.editData = function(record){
            $scope.myAction = record;
            $('#kt_modal_4edit').modal('show');
        }

        $scope.deleteData = function(record){
            $scope.myAction = record;
            $scope.myAction.on = record;
            $scope.confirmationDialogConfig = {
                title: "Delete Data",
                message: "Do you want to remove this data?",
                buttons: [{
                    label: "Remove",
                    action: "remove"
                }]
            };
            $('#confirmationDialog').modal('show');
        }


    }]);