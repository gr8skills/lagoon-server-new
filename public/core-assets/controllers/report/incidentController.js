mainApp.controller('incidentController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.details = {};
        $scope.month = [];
        $scope.sortAsset = 0;
        $scope.sortReport_by = 0;
        $scope.sortLocation  = 0;
        $scope.sortRange = 0;
        $scope.sortLga = 0;
        $scope.status = 0;
        var ctx = document.getElementById("canvas");

        $scope.getData = function () {
            appService.fetchData('/getMonthlyincidentData', 
            function (resp) {
                $scope.model.months = resp.data.report.months;
                $scope.model.incident_count = resp.data.report.incident_count;
                $scope.model.max = resp.data.report.max;
                $scope.fetchGraphDetails();
            },
            function (error) {
                console.log(error);
            });
        };
        $scope.getDatareport = function () {
            appService.fetchData('/get-all-lgas',  
                function(resp){
                    $scope.details.lgas = resp.data.lgas;
                }, function (error) {
                    console.log(error);
                });

            appService.fetchData('/get-all-assets',
                function(resp){
                    $scope.details.assets = resp.data.assets;
                    console.log($scope.details.assets);
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
            appService.fetchData('/get-all-incident',
            function (resp) {
                $scope.details.incident_report = resp.data.report;
                console.log($scope.details.incident_report);
            }, function(error) {

            });
        };

        $scope.getData();
        $scope.getDatareport();

        // start navigation
        $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.details.incident_report = resp.data.report;
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
                        $scope.details.incident_report = resp.data.report;
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
                        $scope.details.incident_report = resp.data.report;
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
                        $scope.details.incident_report = resp.data.report;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };
        // End navigation

          // Sort report by search
          $scope.sortIncidentReport = function() {
              console.log($('#kt_daterangepicker_6'));
            if(!$scope.sortAsset || !$scope.sortReport_by || !$scope.$location || !$scope.sortRange || !$scope.sortLga || !$scope.status){
                appService.fetchData('/search-report/'+$scope.sortReport_by+'/'+$scope.sortRange+'/'+$scope.sortLga+'/'+$scope.sortLocation+'/'+$scope.sortAsset+'/'+$scope.status,
                    function (resp) {
                        // $scope.model.assets = resp.data.assets;
                        $scope.details.incident_report = resp.data.report;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getDatareport();
            }

        };

        $scope.fetchGraphDetails = function () {
			var ctx = document.getElementById('canvas').getContext('2d');
			new Chart(ctx, {
				type: 'bar',
                data: {
                    labels: $scope.model.months,
                    datasets: [{
                        label: 'incidents',
                        backgroundColor: 'rgba(2,117,216,0.2)',
                        borderColor: 'rgba(2,117,216,1)',
                        borderWidth: 1,
                        data: $scope.model.incident_count
                    }]
                },
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Incident report'
                    },
                    scales: {
                        xAxes: [{
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: $scope.model.max, // The response got from the ajax request containing max limit for y axis
                                // maxTicksLimit: 1
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    }
				}
			});

        };
	
    }
]);