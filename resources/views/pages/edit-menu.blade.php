@extends('layouts.master')

@section('page-title')
    {{ ucwords($page->title ?? '') }}
@stop

@section('plugin-styles')
@stop

@section('page-styles')
    <style>
        .banner-placeholder {
            width: 200px;
            height: auto;
        }
    </style>
@stop

@section('content-header')
    Edit {{ ucwords($page->title) }} menu
@stop
<style>
    textarea {
        width: 100%
    }
</style>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords($page->title ?? '') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu-edit', $page->slug) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Last Updated</label>
                                    <input type="text" class="form-control" id="title" readonly
                                           value="{{ $page->updated_at ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Menu caption</label>
                                <input type="text" class="form-control" id="caption" name="caption"
                                       value="{{ $page->caption ?? '' }}">
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="banner">Menu Image</label>
                            <input type="file" accept="image/*" class="form-control" id="banner"
                                   name="image">
                            <span class="text-info ml-3">Max size: 1MB</span>
                        </div>
                        <div class="banner-placeholder py-3" id="banner-placeholder">
                            <img
                                src="@if(!!$page->image) /images/{{ $page->image }} @endif"
                                alt="Menu Image"
                                style="width: 400px"
                                class="@if(!$page->image) d-none @endif"
                            >
                        </div>
                        <hr>
                        <div class="mt-2 mb-5">
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        var content = "{!! addcslashes($page->content ?? '', '"') !!}";
        var content_a = "{!! addcslashes($page->other_contents_1 ?? '', '"') !!}";
        $('#summernote_a').summernote('pasteHTML', content_a).addClass('editor-height');
        $('#bannerFileButton').on('click', function (evt) {
            $('#banner').click();
        })

        $('#bannerSelect').on('click', function () {
            $('#bannerImage').click()
        });
        $('#banner').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#banner-placeholder').find('img').removeClass('d-none').attr('src', imgSrc);
            }
        });

        $('#footerFileButton').on('click', function (evt) {
            $('#footerImage').click();
        });
    </script>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
