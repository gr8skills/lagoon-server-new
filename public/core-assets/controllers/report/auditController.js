mainApp.controller('auditController', ['$rootScope','$scope','$location','$window','$timeout','appService',
function ($rootScope, $scope, $location, $window, $timeout, appService) {

    $scope.model = {};
    $scope.model.user = {};
    $scope.model.activities = {};
    $scope.model.searchActivity = null;
    $scope.searchFilter = null;


    $scope.getData = function() {
        appService.fetchData('/get-user-data/'+$scope.username,
            function (resp) {
                $scope.model.user = resp.data.user;
            },
            function (resp) {
                // console.log(resp.data);
            });
        appService.fetchData('/get-activities',
            function (resp) {
                $scope.model.activities = resp.data.activities;
            },
            function (resp) {
                // console.log(resp.data);
            });
    };

    $scope.getData();

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
            appService.fetchData('/search-activities/'+$scope.model.searchActivity,
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
}
]);