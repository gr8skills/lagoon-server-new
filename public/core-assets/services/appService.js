mainApp.factory('appService', ['$http','$location', '$window', function($http, $location, $window){

    function alert($message, $type) {
        return new SweetAlert({message : $message, type: $type});
    }

    function fetchData(url, onSuccess, onError) {
        $http.get(url
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function sendNormalData(url, data, onSuccess, onError) {
        $http.post(url, data
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function uploadFormWithFile(url, data, onSuccess, onError) {
        $http.post(
            url,
            data,
            {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
             }
        ).then(function (response){
            if(response.data && response.data.success){
                onSuccess(response);
            } else {
                onError(response);
            }
        }, function (response){
            onError(response);
        });
    }

    //alertMessage
    function showMessage(status, message){
        if(status == "success"){
            type = 'success';
            var icon = "<i class='fas fa-check-circle' style='font-size:30px'></i>";
        }
        else if(status == "error"){
            type = 'danger';
            var icon = "<i class='flaticon2-exclamation' style='font-size:30px'></i>";
        }
        else if(status == "warning"){
            type = 'warning';
            var icon = "<i class='flaticon2-warning' style='font-size:30px'></i>";
        }
        else if(status == "info"){
            type = 'info';
            var icon = "<i class='flaticon2-information' style='font-size:30px'></i>";
        }
        $.notify({
            icon: icon,
            message: message
        }, {
            type: type,
            timer: 1000,
            placement: {
                from: 'top',
                align: 'right',
            }
        });
    };

    return {
        alert : alert,
        showMessage : showMessage,
        fetchData : fetchData,
        sendNormalData : sendNormalData,
        uploadFormWithFile : uploadFormWithFile
    };
}]);