mainApp.controller('viewController', ['$rootScope','$scope','$location','$window','$timeout','appService',
    function ($rootScope, $scope, $location, $window, $timeout, appService) {

        $scope.model = {};
        $scope.model.worktypeID = '';
        $scope.model.work_id = '';
        $scope.details = {};
        $scope.allContent = {};
        $scope.currentUser = {};
        $scope.files = [];
        $scope.temp_files = [];
        $scope.deleteRecord = {};
        $scope.model.workordersearch = '';
        $scope.model.sortworktype = '';
        $scope.model.sortworktypeStatus = '';

        $scope.getData = function (){
            appService.fetchData('/get-workorder',
            function(resp) {
                // console.log(resp);
                $scope.details = resp.data.workorder;
                console.log($scope.details);
                $scope.currentUser = resp.data.currentUser;
                console.log($scope.currentUser);
            },
            function(resp){
                console.log(resp);
            });
        };
        //searching the workOrder details
        $scope.OrderSearch = function() {
            $query = $('#workordersearch').val();
            if($query) {
                appService.fetchData('/search-work-order/' + $query,
                function(resp){
                    console.log(resp.data.workorders);
                    $scope.details = resp.data.workorders;
                },
                function(error){
                    console.log(error);
                });

            } else {
                $scope.getData();
            }
        };
        $scope.getData();
            
        $scope.get_Data = function (){
            appService.fetchData('/get-details',
            function(resp) {
                $scope.allContent = resp.data.details;
                // console.log($scope.allContent);
            },
            function(resp){
                console.log(resp);
            });
        };
        $scope.get_Data();

        //sort
        $scope.sortworktype_status = function() {
            // console.log('hellowww');
            $type = $scope.model.sortworktype; $status = $scope.model.sortworktypeStatus;
            if ($type == '') {
                $type = 0;
            }
            if($status == '') {
                $status = 0;
            }
            appService.fetchData('/sort-workorderType/' + $type +'/'+$status, 
            function(resp){
                // console.log(resp);
                $scope.details = resp.data.workorder;
            },
            function(error){
                console.log(error);
            });
        };
        //end sort

         // start navigation
         $scope.firstPage = function(record){
            if(record.current_page != 1){
                appService.fetchData(record.first_page_url,
                    function (resp) {
                        $scope.details = resp.data.workorder;
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
                        $scope.details = resp.data.workorder;
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
                        $scope.details = resp.data.workorder;
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
                        $scope.details = resp.data.workorder;
                    },
                    function (resp) {
                        // console.log(resp.data);
                    });
            }
        };
        // End navigation
        //begin::selecting of item
        $scope.selectAsset = function (data) {
            $('#assetsearch').val(data.asset_id);
        };
        $scope.selectLocation = function (data) {
            $('#locationsearch').val(data.name);
        };
        $scope.selectLga = function (data) {
            $('#lgaSearch').val(data.name);
        };
        $scope.selectLot = function (data) {
            $('#lotSearch').val(data.name);
        };
        $scope.selectIpp = function (data) {
            $('#ipp_id').val(data.name);
        };
        //End::selecting of item

         //searching Assets
         $scope.assetSearch = function() {
            $search_text = $('#assetsearch').val();
            $scope.model.asset_id = $search_text;
            if($scope.model.asset_id){
                appService.fetchData('search-asset/'+$search_text,
                    function (resp) {
                        console.log(resp);
                        $scope.allContent.asset = resp.data.asset;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.get_Data();
            }
        };
        //searching Lga
        $scope.lgaSearch = function() {
            $search = $('#lgaSearch').val();
            $scope.model.lga_id = $search;
            if($scope.model.lga_id){
                appService.fetchData('search-lga-d/'+$scope.model.lga_id,
                    function (resp) {
                        $scope.allContent.ipp = resp.data.ipp;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.get_Data();
            }
        };

        //searching location
        $scope.locationSearch = function() {
            $search = $('#locationsearch').val();
            $scope.model.location_id = $search;
            if($scope.model.location_id){
                appService.fetchData('search-location-default/'+$scope.model.location_id,
                    function (resp) {
                        $scope.allContent.location = resp.data.locations;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.get_Data();
            }
        };
        //searching Lot
        $scope.lotSearch = function() {
            $search = $('#lotSearch').val();
            $scope.model.lot_id = $search;
            if($scope.model.lot_id){
                appService.fetchData('search-lots-d/'+$scope.model.lot_id,
                    function (resp) {
                        $scope.allContent.lot = resp.data.lots;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.get_Data();
            }
        };
        //searching Ipp
        $scope.ippSearch = function() {
            $search = $('#ipp_id').val();
            $scope.model.ipp_id = $search;
            if($scope.model.ipp_id){
                appService.fetchData('search-ipp/'+$scope.model.ipp_id,
                    function (resp) {
                        $scope.allContent.ipp = resp.data.ipp;
                    },
                    function (resp) {
                        console.log(resp);
                    });
            }else{
                $scope.get_Data();
            }
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



        //Begin Editing workorder
        $scope.editModal = function(record) {
            console.log(record);
            $('#editModal_workorder').modal('show');
            $('#workOrderName').val(record.name);
            $('#kt_datetimepicker_6').val(record.date);
            $('#description').val(record.description);
            $('#cost').val(record.cost);
            $scope.temp_files = record.attachments;
            $scope.model.work_id = record.workOrderId.trim();
            $scope.model.worktypeID = record.worktype.name.trim();
            if($scope.model.worktypeID == 'Public Lighting') {
                $('#commondiv').show();
                $('#lot').show();
                $('#lot1').show();
                $('#ipp_div').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#assetsearch').val(record.asset.asset_id);
                $('#locationsearch').val(record.location.name);
                $('#lotSearch').val(record.lot.name);

            }else  if ($scope.model.worktypeID== 'Ipp') {
                $('#ipp_div').show();
                $('#commondiv').show();
                $('#lga_div').show();
                $('#lga_div1').show();
                $('#lga_div2').show();
                $('#lot').hide();
                $('#lot1').hide();
                $('#assetsearch').val(record.asset.asset_id);
                $('#locationsearch').val(record.location.name);
                $('#lgaSearch').val(record.lga.name);
                $('#ipp_id').val(record.ipp.name);
            } else if($scope.model.worktypeID == 'Renewables'){
                $('#commondiv').show();
                $('#ipp_div').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#lot1').hide();
                $('#assetsearch').val(record.asset.asset_id);
                $('#locationsearch').val(record.location.name);
            } else {
                $('#ipp_div').hide();
                $('#commondiv').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#lot1').hide();
            }
        };
           //Changing the view of WorkOrder Type
           $('#workType').on('change', function() {
            $scope.model.worktypeID= this.value.trim();
            if($scope.model.worktypeID == 'Public Lighting') {
                $('#commondiv').show();
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
            } else if($scope.model.worktypeID == 'Renewables'){
                $('#commondiv').show();
                $('#ipp_div').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#lot1').hide();
            } else {
                $('#ipp_div').hide();
                $('#commondiv').hide();
                $('#lga_div').hide();
                $('#lga_div1').hide();
                $('#lga_div2').hide();
                $('#lot').hide();
                $('#lot1').hide();
            }
        });

        $scope.editWorkorder =  function() {
            console.log($scope.model);
            $scope.model.workOrderName = $('#workOrderName').val();
            $scope.model.date = $('#kt_datetimepicker_6').val();
            // $scope.model.worktypeID = $('#worktype').val();
            $scope.model.cost = $('#cost').val();
            $scope.model.asset_id = $('#assetsearch').val();
            $scope.model.location_id = $('#locationsearch').val();
            $scope.model.lga_id = $('#lgaSearch').val();
            $scope.model.lot_id = $('#lotSearch').val();
            $scope.model.ipp_id = $('#ipp_id').val();
            $scope.model.description =$('#description').val();
            $scope.valid = true;
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
                    KTApp.block('#editModal_workorder', {
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'success',
                        message: 'Processing...'
                    });
                    var fd_workorder = new FormData();
                    fd_workorder.append('workorder_name', $scope.model.workOrderName);
                    fd_workorder.append('workorderID',$scope.model.work_id);
                    fd_workorder.append('date', $scope.model.date);
                    fd_workorder.append('worktype', $scope.model.worktypeID);
                    fd_workorder.append('description',$scope.model.description);
                    fd_workorder.append('asset_id',$scope.model.asset_id);
                    fd_workorder.append('location_id',$scope.model.location_id);
                    fd_workorder.append('lot_id',$scope.model.lot_id);
                    fd_workorder.append('ipp_id', $scope.model.ipp_id);
                    fd_workorder.append('lga_id',$scope.model.lga_id);
                    fd_workorder.append('cost',$scope.model.cost);
                    for (var i = 0; i < $scope.files.length; i++) {
                        fd_workorder.append('file[]', $scope.files[i]);
                    }
                    appService.uploadFormWithFile('/edit-work-order',
                        fd_workorder,
                        function success(resp){
                            console.log(resp);
                            KTApp.unblock('#editModal_workorder');
                            showSuccessMessage(resp.data.status);
                            $scope.getData();
                            $('#editModal_workorder').modal('hide');
                        },
                        function error(error){
                            console.log(error);
                            KTApp.unblock('#editModal_workorder');
                        });
                    }
            }
        };

        $scope.deleteModal = function(record) {
            $('#delete_workorderModal').modal('show');
            $scope.deleteRecord = record;
        };
        $scope.deleteworkorder = function () {
            $('#deleteworkOrder').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',true);
            $obj = {
                'id': $scope.deleteRecord.id,
                'key': $scope.deleteRecord.workOrderId
            };
            console.log($obj);
            appService.sendNormalData('/delete-workorder',$obj,
                function(resp){
                    showSuccessMessage(resp.data.status);
                    $('#deleteworkOrder').removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled',false);
                    $('#delete_workorderModal').modal('hide');
                    $scope.getData();
                    $scope.get_Data();
                }, function(error){
                    console.log(error);
                });
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

    }]);