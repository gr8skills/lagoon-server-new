@extends('layouts.master')

@section('page-title', 'Home')

@section('plugin-styles')

@stop

@section('page-styles')
    <style>
        .slide-card {
            width: 320px;
            height: 123px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0;
            margin-bottom: 10px;
            overflow: hidden;
            transform: translateY(5px);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            display: flex;
            justify-content: center;
            align: center;
        }

        .slide-card:hover {
            transform: translateY(0px);
        }

        #btn-delete {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        #btn-delete:hover {
            opacity: 0.8;
        }

    </style>
@stop

@section('content-header', 'Home Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-uppercase">Slider images</h3>
                        <a href="{{ route('slide-create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row flex-md-wrap ">
                        @if ($slideImages->count() > 0)
                            @foreach ($slideImages as $slide)
                                <div class="slide-card mr-sm-3"
                                    style="background: url({{ asset('/images/' . $slide->image_path) }}) center/cover no-repeat padding-box">
                                    <button type="button" class="btn btn-danger" id="btn-delete" data-toggle="modal"
                                        data-target="#deleteModal" data-slide="{{ $slide->id }}">
                                        Delete
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex justify-content-center w-100">
                                <div class="alert alert-warning">
                                    <p class="text-center p-0 m-0">No slide images found.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.modals.delete-modal')
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        var request = undefined;

        $('#deleteModal').on('show.bs.modal', function(evt) {
            var button = $(evt.relatedTarget);
            var slideId = button.data('slide');
            var modal = $(this);
            modal.find('#modalTitle').text('slide image');
            modal.find('#modalPrompt').text('slide image');

            modal.find('#modalDeleteBtn').on('click', function(e) {
                e.preventDefault();

                if (request) request.abort();

                blockPage();

                request = $.ajax({
                    url: '/delete-slide/' + slideId,
                    type: 'DELETE',
                });

                request.done(function(resp, textStatus) {
                    unBlockPage();
                    console.log(textStatus);
                    return;

                    if (textStatus == 'success') {
                        button.closest('.slide-card').remove();
                        modal.modal('hide');
                        toastAlert('Slide image deleted successfully.', 'Success', 'success');
                    } else {
                        toastAlert('Something went wrong.', 'Error', 'error');
                    }
                });

                request.fail(function(jqXHR, textStatus, errorMessage) {
                    unBlockPage();
                    toastAlert('Something went wrong.', 'Error', 'error');
                });
            });
        });
    </script>
@endsection
