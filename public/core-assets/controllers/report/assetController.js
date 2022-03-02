mainApp.controller('assetController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};

        $scope.from = null;
        $scope.to = null;
        $scope.model.searchAsset = null;

        $scope.getData = function(){
            
            appService.fetchData('/get-current-user',
                function (resp) {
                    $scope.currentUser = resp.data.currentUser;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
                
            appService.fetchData('/get-asset-reports',
            function (resp) {
                $scope.model.reports = resp.data.reports;
                $scope.model.reportData = resp.data.reportData;

                $scope.makeGraph($scope.model.reports.data);
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        }

        $scope.getData();

        $scope.makeGraph = function(data){

            new Morris.Line({
                // ID of the element in which to draw the chart.
                element: angular.element(document.querySelector('#kt_morris_1')),
                // element: 'kt_morris_1',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: data,

                // The name of the data record attribute that contains x-values.
                xkey: 'report_date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['reported', 'fixed', 'bad', 'new', 'removed', 'total'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Reported Assets', 'Fixed Assets', 'Bad Assets','New Assets','Removed Assets','Total Assets'],
                lineColors: ['#ffb822', '#5578eb','#fd397a','#0abb87','#6c757d','#000']
            });

        }

        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.model.reports = resp.data.reports;
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
                        $scope.model.reports = resp.data.reports;
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
                        $scope.model.reports = resp.data.reports;
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
                        $scope.model.reports = resp.data.reports;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };
        // End navigation

        // Sort Lots by search
        // $scope.sortFrom = function() {
        //     $scope.sortReport();
        // };
        // $scope.sortTo = function() {
        //     $scope.sortReport();
        // };


        $scope.sortReport = function(){
            $scope.from = $('#kt_datetimepicker_6').val();
            $scope.to = $('#kt_datetimepicker_6b').val();
            if(!$scope.from){
                $scope.from = 0;
            }
            if(!$scope.to){
                $scope.to = 0;
            }
            appService.fetchData('/sort-asset-report/'+$scope.from+'/'+$scope.to,
                function (resp) {
                    $scope.model.reports = resp.data.reports;
                },
                function (resp) {
                    appService.showMessage('error', resp.data.message);
                });
        }

        $scope.searchReport = function() {
            if($scope.model.searchAsset){
                appService.fetchData('/search-assets-report/'+$scope.model.searchAsset,
                    function (resp) {
                        $scope.model.reports = resp.data.reports;
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