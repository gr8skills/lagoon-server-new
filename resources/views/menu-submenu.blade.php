@extends('layouts.master')

@section('page-title', 'Menu & Submenu')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'Site Menu')

@section('content')
    <div class="row" id="academicsPageList">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Path/Link</th>
                            <th class="text-center" style="width: 4%">Position</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($menus->count() > 0)
                            @foreach($menus as $menu)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ ucwords($menu->title) }}</td>
                                    <td>
                                        @if(str_contains($menu->link,"http"))
                                            <a href="{{ $menu->link }}"
                                               target="_blank">{{ $menu->link }}</a>
                                        @else
                                            <a href="{{ config('app.front_url') }}{{ $menu->link }}"
                                               target="_blank">{{ config('app.front_url') }}{{ $menu->link }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$menu->position}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('page-edit', $menu->slug) }}" class="btn btn-sm btn-info @if($menu->completed === 1) disabled @endif">
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

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sub-Menu</h3>
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Menu</th>
                            <th>Path/Link</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($submenus->count() > 0)
                            @foreach($submenus as $menu)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ ucwords($menu->title) }}</td>
                                    <td>{{$menu->label}}</td>
                                    <td>
                                        <a href="{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $menu->path }}"
                                           target="_blank">{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $menu->path }}</a>
                                    </td>
                                    <td class="text-center">{{$menu->label}} - {{$menu->position}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('page-edit', $menu->slug) }}" class="btn btn-sm btn-info @if($menu->completed === 1) disabled @endif">
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

        $("#example2").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    </script>
@endsection
