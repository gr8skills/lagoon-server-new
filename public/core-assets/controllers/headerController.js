mainApp.controller('headerController', ['$rootScope', '$scope', '$location', '$window', '$timeout', 'appService', '$interval',
    function ($rootScope, $scope, $location, $window, $timeout, appService, $interval) {

        $scope.model = {};
        $scope.model.notifications = {};
        $scope.model.notifications.current_page = 1;

        $scope.getData = function () {

            appService.fetchData('/get-notifications',
            function (resp) {
                if($scope.model.notifications.current_page == 1){
                    $scope.model.notifications = resp.data.notifications;
                }
                $scope.model.unreadNotification = resp.data.unreadNotification;
            },
            function (resp) {
                appService.showMessage('error', resp.data.message);
            });
        };
        $scope.getData();

        $scope.openLink = function ($id) {
            console.log($id);
            appService.fetchData('send-open-notification/'+ $id,
            function (resp){
                $scope.model.notification = resp.data.notification;
            },
            function (error){
                console.log(error);
            });
        };


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


        $scope.loadNext = function (record) {
            if (record.next_page_url) {
                appService.fetchData(record.next_page_url,
                    function (resp) {
                        $scope.model.notifications = resp.data.notifications;
                        $scope.model.unreadNotification = resp.data.unreadNotification;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };

        $scope.loadPrev = function (record) {
            if (record.prev_page_url) {
                appService.fetchData(record.prev_page_url,
                    function (resp) {
                        $scope.model.notifications = resp.data.notifications;
                        $scope.model.unreadNotification = resp.data.unreadNotification;
                    },
                    function (resp) {
                        appService.showMessage('error', resp.data.message);
                    });
            }
        };


        $interval( function(){
            $scope.getData();
        }, 5000);
        
    }
]);