@extends('layouts.master')

@section('page-title', 'Uploads')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'Uploads')


@section('content')
    <div class="row" id="aboutPageList">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-capitalize">News and updates list</h3>
                        <input type="file" name="file" id="file" class="d-none">
                        <button type="button" class="btn btn-info btn-sm" id="newUploadButton">
                            <i class="fas fa-plus mr-1"></i>Upload file
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Added on</th>
                            <th>Added by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($uploads->count() > 0)
                            @foreach($uploads as $upload)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td style="width: 500px">
                                        <div class="upload-link-text">
                                            <input type="text" readonly value="{{ ucwords($upload->name) }}">
                                            <button id="btn-copy-{{$upload->id}}"
                                                    class="btn-copy"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Copy link"
                                                    data-clipboard-text="{{config('app.url')}}/uploads/{{$upload->path}}">
                                                <i class="far fa-clipboard"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{$upload->created_at->toFormattedDateString()}}</td>
                                    <td>School Admin</td>
                                    <td class="text-right">
                                        <a href="{{config('app.url')}}/uploads/{{$upload->path}}"
                                           class="btn btn-info btn-sm"
                                           target="_blank">
                                            Preview
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-danger deleteButton"
                                                data-upload="{{$upload->id}}">
                                            <i class="far fa-trash-alt mr-1"></i>Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="alert-container" id="alert">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Failed!</h5>
            Uploading file failed. Please try again later. Make sure you file is not larger than 5MB
        </div>
    </div>

    <div class="alert-container" id="alertDelete">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Failed!</h5>
            File could not be deleted. Please try again later.
        </div>
    </div>

    <div class="alert-container" id="alertTextCopied">
        <div class="alert alert-success text-center">
            Link copied!!
        </div>
    </div>

    @include('includes.modals.delete-modal')
@stop

@section('page-plugin')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
@stop

@section('page-scripts')
    <script>
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#newUploadButton').on('click', function (e) {
            e.preventDefault();
            $('#file').click();
        });

        $('#file').on('change', function (e) {
            var formData = new FormData();
            formData.append('file', e.target.files[0]);

            var request = $.ajax({
                url: `/upload`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false
            });

            request.done(function (res) {
                setTimeout(() => {
                    location.reload();
                }, 1500);
            });

            request.fail(function (_, __, msg) {
                $('#alert').addClass('shown');
            });
        });

        $('.deleteButton').each(function () {
            var btn = $(this);
            btn.on('click', function (e) {
                e.preventDefault();
                var uploadId = +btn.data('upload');

                var req = $.ajax({
                    url: `/upload/${uploadId}`,
                });

                req.done(function (res) {
                    var modal = $('#deleteModal');
                    modal.find('#modalTitle').text('File');
                    modal.find('#modalPrompt').text('file');
                    var delBtn = modal.find('#modalDeleteBtn');
                    delBtn.attr('href', `/upload/delete/${uploadId}`);

                    modal.modal('show');
                });


                req.fail(function (_, __, msg) {
                    $('#alertDelete').addClass('shown');
                });
            });
        });

        var clipboard = new ClipboardJS('.btn-copy');

        clipboard.on('success', function (e) {
            console.log('Evt + success ', e);
            var trigger = e.trigger;
            trigger.classList.add('selected');
            $('#alertTextCopied').addClass('shown')
            setTimeout(() => {
                trigger.classList.remove('selected');
                $('#alertTextCopied').removeClass('shown');
            }, 3000);
        });

        clipboard.on('error', function (e) {
            console.log('Evt + error ', e);
        });
    </script>
@endsection
