mainApp.controller('createController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {


        var _validFileExtensions = [".jpg", ".jpeg", ".png","pdf","xlx","csv","docx","doc","xlsx","zip"];
        $scope.model = {};
        $scope.details = {};
        $scope.files = [];
        $scope.model.worktypeID = '';

          //Changing the view of WorkOrder Type
          $('#workType').on('change', function() {
            $scope.model.worktypeID = this.value.trim();
            console.log($scope.model.worktypeID);
            if($scope.model.worktypeID == 'Public Lighting') {
                $('#commondiv').show();
                $('#commondivPL').show();
                $('#lot').show();
                $('#lot1').show();
                $('#ipp_div').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();

            }else  if ($scope.model.worktypeID== 'Ipp') {
                $('#ipp_div').show();
                $('#commondiv').show();
                $('#lga_div').show();
                $('#lga_div1').show();
                $('#lga_div2').show();
                $('#lot').hide();
                $('#lot1').hide();
                $('#commondivPL').hide();
            } else if($scope.model.worktypeID == 'Renewables'){
                $('#commondiv').show();
                $('#ipp_div').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#lot1').hide();
                $('#commondivPL').hide();
            } else {
                $('#ipp_div').hide();
                $('#commondiv').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#commondivPL').hide();
                $('#lot1').hide();
            }
        });
        
        $scope.getData = function (){
            appService.fetchData('/get-details',
            function(resp) {
                $scope.details = resp.data.details;
                $scope.approve_incident = resp.data.details.approve_incident;
                console.log($scope.approve_incident);  
                console.log($scope.details); 
            },
            function(resp){
                console.log(resp);
            });
        };
        $scope.getData();

        //begin::selecting of item
        $scope.selectAsset = function (data) {
            $('#assetsearch').val(data.asset_id);
        };
        $scope.selectLocation = function (data) {
            $('#locationsearch').val(data.name);
            $scope.model.location = data.name;
            
        };
        $scope.selectLga = function (data) {
            $('#lgaSearch').val(data.name);
        };
        $scope.selectLot = function (data) {
            $('#lotSearch').val(data.name);
            $scope.model.lot  = data.id;
        };
        $scope.selectIpp = function (data) {
            $('#ipp_id').val(data.name);
        };
        $scope.selectPowersource = function(data) {
            $('#powerSource').val(data.name);
            $scope.power_id = data.id;
        };
        $scope.selectAssetType = function(data) {
            $('#assetTypesearchs').val(data.name);
            $scope.asset_type_id = data.id;
            appService.fetchData('/selectAssetType/' + $scope.model.location,
            function(resp){
                console.log(resp);
                $scope.power_source = resp.data.powersource;
                // console.log($scope.power_source);
            }, function(error){
                console.log(error);
            });
        };

        $scope.assetTypeSearch = function() {

        };
        //End::selecting of item

        //creating a workorder
        $scope.createWorkType = function() {
            console.log($scope.model);
            $scope.model.workOrderName = $('#workOrderName').val();
            $scope.model.date = $('#kt_datetimepicker_6').val();
            // $scope.model.worktypeID = $('#worktype').val();
            // console.log($scope.model.worktypeID);
            $scope.model.cost = $('#cost').val();
            $scope.model.asset_id = $('#assetsearch').val();
            $scope.model.location_id = $('#locationsearch').val();
            $scope.model.lga_id = $('#lgaSearch').val();
            $scope.model.lot_id = $('#lotSearch').val();
            $scope.model.ipp_id = $('#ipp_id').val();
            $scope.model.description =$('#description').val();
            $scope.incident_id = $('#incident_id').val();
            $scope.valid = true;
            // if(!$scope.incident_id) {
            //     showerrorMessage('Workorder is created on incident reference \n incident MUST be selected');
            // } else
             if($scope.model.workOrderName == ''|| $scope.model.date =='' || $scope.model.worktypeID == '' || $scope.model.worktypeID == undefined || $scope.model.description == '') {
                showerrorMessage('Some fields are empty');
                $scope.valid =false;
            } else {
                if($scope.model.worktypeID == 'Public Lighting') {
                    if($scope.model.asset_id == '' || $scope.model.location_id == '' || $scope.model.lot_id == ''){
                        showerrorMessage('Public lighting details not completed');
                        $scope.valid =false;
                    }
                } else if($scope.model.worktypeID == 'Ipp') {
                    if($scope.model.asset_id == '' || $scope.model.location_id == ''|| $scope.model.ipp_id == '' || $scope.model.lga_id == ''){// $scope.model.ipp_id == '' ||
                        showerrorMessage('Ipp details not complete');
                        $scope.valid =false;
                    }
                }
                else if ($scope.model.worktypeID == 'Renewables') {
                    if($scope.model.asset_id == '' || $scope.model.location_id =='') {
                        showerrorMessage('Renewables details not complete');
                        $scope.valid =false;    
                    }
                }
                if ($scope.valid == true) {
                    //loader
                    KTApp.block('#kt_blockui_card', {
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'success',
                        message: 'Processing...'
                    });
                    var fd_workorder = new FormData();
                    fd_workorder.append('workorder_name', $scope.model.workOrderName);
                    fd_workorder.append('incident_id',$scope.incident_id);
                    fd_workorder.append('date', $scope.model.date);
                    fd_workorder.append('worktype', $scope.model.worktypeID);
                    fd_workorder.append('description',$scope.model.description);
                    fd_workorder.append('asset_id',$scope.model.asset_id);
                    fd_workorder.append('location_id',$scope.model.location_id);
                    fd_workorder.append('lot_id',$scope.model.lot_id);
                    fd_workorder.append('ipp_id', $scope.model.ipp_id);
                    fd_workorder.append('lga_id',$scope.model.lga_id);
                    fd_workorder.append('cost',$scope.model.cost);
                    fd_workorder.append('assetType', $scope.asset_type_id);
                    fd_workorder.append('powerSource',  $scope.power_id);
                    for (var i = 0; i < $scope.files.length; i++) {
                        fd_workorder.append('file[]', $scope.files[i]);
                    }
                    appService.uploadFormWithFile('/create-work-order',
                        fd_workorder,
                        function success(resp){
                            console.log(resp);
                            KTApp.unblock('#kt_blockui_card');
                            showSuccessMessage(resp.data.status);   
                            $scope.model = {};
                        },
                        function error(error){
                            console.log(error);
                            KTApp.unblock('#kt_blockui_card');
                        });
                    }
            }
        };

        //searching Assets
        $scope.assetSearch = function() {
            $search_text = $('#assetsearch').val();
            $scope.model.asset_id = $search_text;
            if($search_text){
                appService.fetchData('/search-asset/'+$search_text,
                    function (resp) {
                        console.log(resp);
                        $scope.details.asset = resp.data.asset;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };
        //searching Lga
        $scope.lgaSearch = function() {
            $search = $('#lgaSearch').val();
            $scope.model.lga_id = $search;
            if($scope.model.lga_id){
                appService.fetchData('search-lga-d/'+$scope.model.lga_id,
                    function (resp) {
                        $scope.details.ipp = resp.data.ipp;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };
        //searching location
        $scope.locationSearch = function() {
            $search = $('#locationsearch').val();
            $scope.model.location_id = $search;
            if($scope.model.location_id){
                appService.fetchData('search-location-default/'+$scope.model.location_id,
                    function (resp) {
                        $scope.details.location = resp.data.locations;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };
        //searching Lot
        $scope.lotSearch = function() {
            $search = $('#lotSearch').val();
            $scope.model.lot_id = $search;
            if($scope.model.lot_id){
                appService.fetchData('search-lots-d/'+$scope.model.lot_id,
                    function (resp) {
                        $scope.details.lot = resp.data.lots;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
            }
        };
        //searching Ipp
        $scope.ippSearch = function() {
            $search = $('#ipp_id').val();
            $scope.model.ipp_id = $search;
            if($scope.model.ipp_id){
                appService.fetchData('search-ipp/'+$scope.model.ipp_id,
                    function (resp) {
                        $scope.details.ipp = resp.data.ipp;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.getData();
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
                timer: 5000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });
        };    
        //validating input files
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
                        $('#error_file').text('').append('Invalid file extension');
                        $('#error_file').show();
                        // showerrorMessage("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                        oInput.value = "";
                        return false;
                    }
                }
            }
            return true;
        };
    }
]);