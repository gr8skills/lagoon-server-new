@extends('layouts.master')

@section('page-title', 'Academics')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'Academics')

@section('content')
    <div class="row" id="academicsPageList">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Academics pages</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($pages->count() > 0)
                            @foreach($pages as $page)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ ucwords($page->title) }}</td>
                                    <td>
                                        <a href="{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $page->path }}"
                                           target="_blank">{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $page->path }}</a>
                                    </td>
                                    <td class="text-right">
{{--                                        <a href="{{ route('page-edit', $page->slug) }}" class="btn btn-sm btn-info @if($page->completed === 1) disabled @endif">--}}
                                        <a href="{{ route('page-edit', $page->slug) }}" class="btn btn-sm btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
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
            "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
@endsection
