mainApp.controller('createController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {


        var _validFileExtensions = [".jpg", ".jpeg", ".png","pdf","xlx","csv","docx","doc","xlsx","zip"];
        $scope.model = {};
        $scope.incident = {};
        $scope.approve_incident = {};
        $scope.details = {};
        $scope.files = [];
        $scope.is_lot = false;
        $scope.is_asset = false;
        $scope.is_location = false;
        $scope.lga_id = '';$scope.lot_id = ''; $scope.asset_id = '';$scope.location_id = '';
        $scope.getData = function () {
            appService.fetchData('/get-lgas',  
                function(resp){
                    // console.log(resp);
                    // console.log(resp);
                    $scope.details.lga = resp.data.lgas.data;
                    console.log($scope.details.lga);
                }, function (error) {
                    console.log(error);
                });
        };
        $scope.getData();

        $scope.CreateIncident = function () {
            $subject = $('#subject').val();
            $description = $('#description').val();
            $severity = $('#severity').val();
            $scope.incident.date = $('#kt_datetimepicker_6').val();
            if ($subject == '') {
                showerrorMessage('Incident Subject is required!');
            } else if ($description == '') {
                showerrorMessage('Incident Description is required!');
            } else if ($severity == 'select') {
                showerrorMessage('Incident severity should be added!');
            } 
            else {
                // console.log($scope.incident.date);
                // if()
            $scope.asset_id = $('#asset_id').val(); 
            $scope.location_id = $('#location_id').val();
            var fd = new FormData();
            fd.append('lga_id', $scope.lga_id);
            fd.append('lot_id', $scope.lot_id);
            fd.append('asset_id', $scope.asset_id);
            fd.append('location_id', $scope.location_id);
            fd.append('subject', $scope.incident.subject);
            fd.append('description', $scope.incident.description);
            fd.append('severity',$scope.incident.severity);
            // alert($scope.incident.date);
            for (var i = 0; i < $scope.files.length; i++) {
                    fd.append('file[]', $scope.files[i]);
            }
            $('#create_btn').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',true);
                $scope.insertIncident(fd);
            }
    };

        //Sending to Db for staorage
        $scope.insertIncident = function (form_data) {
            appService.uploadFormWithFile(
                '/add-incident',
                form_data,
                function(resp) {
                    $('#create_btn').removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',false);
                    // console.log(resp);
                    showSuccessMessage(resp.data.status);
                    $scope.lga_id = null;
                    $scope.lot_id = null;
                    $scope.asset_id = null;
                    $scope.location_id = null;
                    $scope.incident = {};
                    $('#severity').val('select');
                    $('.custom-file-input').val('');
                    // window.location.href="/incidents";

                }, function (error) {
                    console.log(error);
                    showerrorMessage(error.responseText);
                }
            );
        };

        //selecting the item in Lga
        $scope.selectLga = function(data) {
            $scope.details.location = data.locations;
            $scope.details.lots_temp = $scope.details.lots;
            $scope.is_lot = true;
        };
        
        //selecting the item in Lot
        $scope.selectLocation = function (data) {
            $scope.details.assets = data.assets;
            $scope.details.assets_temp = $scope.details.assets;
            $scope.is_asset = true;
        };
        //selecting the item in asset
        $scope.selectAsset = function (data){
            $scope.details.location = data.location;
            $scope.details.locations_temp = $scope.details.location;
            $scope.is_location = true;
        };

        //setting the value of the asset dropdown
        $('.asset_dropdown').on('click', '.asset', function(){
           $val_asset =  $(this).attr('data-value');
           $scope.asset_id= $(this).attr('data-id');
            $('#asset_id').val($val_asset);
            $scope.is_location = true;
        });
        //setting the value of the lot dropdown
        $('.lot_dropdown').on('click', '.lot', function(){
            $val_lot =  $(this).attr('data-value');
            $scope.lot_id = $(this).attr('data-id');
             $('#lot_id').val($val_lot);
             $scope.is_asset = true;
         });
          //setting the value of the lga dropdown
        $('.lga_dropdown').on('click', '.lga', function(){
            $val_lga =  $(this).attr('data-value');
            $scope.lga_id = $(this).attr('data-id');
             $('#lga').val($val_lga);
             $scope.is_lot = true;
         });
         //setting the value of the location dropdown
         $('.location_dropdown').on('click', '.location', function(){
             $val_location = $(this).attr('data-value');
             $scope.location_id = $(this).attr('data-id');
             $('#location_id').val($val_location);
         });

          //implementing the search on lot-input
          $scope.sort_Lga = function() {
            if ($scope.incident.lga_id) {
                appService.fetchData('/search-lga/'+$scope.incident.lga_id,
                    function (resp) {
                        $scope.details.lga = resp.data.lgas.data;
                    },
                    function (resp) {
                    });
            }else{
                $scope.getData();
            }
        };

         //implementing the search on lot-input
        $scope.sort_Lot = function() {
            if ($scope.incident.lot_id) {
                $scope.details.lots = $scope.details.lots_temp.filter(item => item.name.toLocaleLowerCase().indexOf($scope.incident.lot_id.toLowerCase()) > -1);
            }else{
                $scope.details.lots = $scope.details.lots_temp;
            }
        };
        //implementing the search on Asset-input
        $scope.sort_Asset = function() {
            if ($scope.incident.asset_id) {
                $scope.details.assets = $scope.details.assets_temp.filter(item => item.name.toLocaleLowerCase().indexOf($scope.incident.asset_id.toLowerCase()) > -1);
            }else{
                $scope.details.assets = $scope.details.assets_temp;
            }
        };
        //implementing the search on location-input
        $scope.sort_Location = function() {
            if ($scope.incident.location_id) {
                $scope.details.locations = $scope.details.locations_temp.filter(item => item.name.toLocaleLowerCase().indexOf($scope.incident.location_id.toLowerCase()) > -1);
            }else{
                $scope.details.locations = $scope.details.locations_temp;
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
            ValidateInput = function(oInput) {
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, 
                                    sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }
                        if (!blnValid) {
                            showerrorMessage("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                            oInput.value = "";
                            return false;
                        }
                    }
                }
                return true;
            };
    }
]);