<div class="modal fade" id="uploadModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Upload <span id="modalTitle"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('upload-calendar')}}" method="post" enctype="multipart/form-data" class="upl">
                                @csrf

                                <div class="form-group col-md-12">
                                    <label for="">See a sample</label>
                                    <a class="btn btn-sm btn-warning mr-2" href="/calendar_sample.csv"><i
                                            class="fa fa-list"></i>
                                        <img src="/simple_calendar.png" width="100%" alt="Calendar upload sample"></a></div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <input type="file" accept=".csv" class="form-control"
                                               id="image" name="calendar">
{{--                                        <button type="button" id="openFile" class="btn btn-primary">Choose file</button>--}}
                                        <i class="text-muted ml-3">File size should be less than 1MB</i>
                                    </div>
                                </div>

                        <div class="float-right">
                            <button class="btn btn-sm btn-success" type="submit" id="upload">Upload Now</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
