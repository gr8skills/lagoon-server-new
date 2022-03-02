mainApp.controller('workOrderController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.details ={};
        $scope.currentUser = {};
        $scope.sortAsset = 0;
        $scope.sortReport_by =0;
        $scope.location = 0;
        $scope.sortRange = 0;
        $scope.sortLga = 0;
        $scope.status = '';
        $scope.type= 0;
        $scope.lot = 0;
        $scope.status = 0;

        console.log('Welcome');

        $scope.getData = function (){
            appService.fetchData('/get-workordr-report',
            function(resp) {
                // console.log(resp);
                $scope.details.workorder = resp.data.workorder;
                $scope.currentUser = resp.data.currentUser;
                // console.log($scope.currentUser) ;
            },
            function(resp){
                console.log(resp);
            });
            appService.fetchData('get-all-assets',
            function (resp) {
                console.log(resp);
            }, function(error){
                console.log(error);
            });
        };
        $scope.getData();

          // start navigation
          $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.details.workorder = resp.data.workorder;
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
                        $scope.details.workorder = resp.data.workorder;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };

        $scope.nextPage = function(record){
            console.log(record);
            if(record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        $scope.details.workorder = resp.data.workorder;
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
                        $scope.details.workorder = resp.data.workorder;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };
        // End navigation


        $scope.getDatareport = function () {

            appService.fetchData('/get-all-assets',
                function(resp){
                    $scope.details.assets = resp.data.assets;
                    // console.log($scope.details.assets);
                }, function(error) {
                    console.log(error);
                });

            appService.fetchData('/get-all-locations',
                function (resp) {
                    $scope.details.locations = resp.data.locations;
                }, function(error){
                    console.log(error);
                });

            appService.fetchData('/get-all-lots', 
                function(resp){
                    $scope.details.lots = resp.data.lots;
                },
                function(error){
                    console.log(error);
                });
            appService.fetchData('/get-details',
            function(resp) {
                $scope.details.workordertype = resp.data.details.worktype;
                // console.log(resp.data.details.worktype);
            }, function(error){
                console.log(error);
            });
        };

        $scope.getDatareport();

        // /{report_by}/{range}/{lga}/{location}/{asset}/{status}{range_to}/{range_from}/

         // Sort report by search
         $scope.sortWorkorderReport = function() {
            $date = $('#dateRange').val();
            if($date) {
                $date = $date.split('/');
            } else {
                $date = [];
                $date[1] = 0;
                $date[0] =0;
                console.log('nn');
            }
          if(!$scope.sortAsset || !$scope.sortReport_by || !$scope.sortRange  || !$scope.sortLga || !$scope.status || !$scope.lot || $scope.type){
              appService.fetchData('/search-workorder-report/'+$scope.sortReport_by+'/'+$date[1] + '/'+
                $date[0] +'/'+$scope.sortLga+'/'+$scope.sortAsset+ '/' + $scope.lot + '/' + $scope.type ,
                    // '/'+$scope.status,+$scope.location+'/'
                  function (resp) {
                    $scope.details.workorder = resp.data.workorder;
                    $scope.currentUser = resp.data.currentUser;
                    console.log(resp);
                  },
                  function (resp) {
                      console.log(resp);
                  });
          }else{
              $scope.getDatareport();
              console.log('nothing');
          }

      };
    }
]);