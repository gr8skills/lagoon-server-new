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

@section('content-header', 'New Testimonial')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="upl">
                        @csrf
                        <div class="col-md-12 row">
                            <div class="form-group col-md-4">
                                <label for="Heading">Label</label>
                                <input
                                    id="label"
                                    class="form-control"
                                    type="text"
                                    name="label"
                                    value="{{$message->label ?? ''}}"
                                    placeholder="{{$message->label ?? 'Heading'}}"
                                >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Heading">Commentor</label>
                                <input
                                    id="commentor"
                                    class="form-control"
                                    type="text"
                                    name="commentor"
                                    value="{{$message->commentor ?? ''}}"
                                    placeholder="{{$message->commentor ?? 'Commentor\'s name'}}"
                                >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="summernote">Paragraph</label>
                                <textarea style="width: 100%;" id="summernote" name="paragraph" class="editor-height" placeholder="{{$message->paragraph ?? 'Paragraph'}}"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    {{-- <label for="banner">Image</label> --}}
                                    <input type="file" accept="image/*" class="form-control d-none" id="image" name="image">
                                    <button type="button" id="openFile" class="btn btn-primary">Choose image</button>
                                    <i class="text-muted ml-3">File size should be less than 1MB</i>
                                </div>

                                <div class="d-none preview">
                                    <img alt="" src="" id="previewImg" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-success" type="submit" id="upload">Save</button>
                        </div>
                    </form>
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
        {{--var content = "{!! addcslashes($message->paragraph ?? '', '"') !!}";--}}
        {{--try{$('#summernote').summernote('pasteHTML', content).addClass('editor-height');}--}}
        {{--catch(Exception){--}}
        {{--}--}}
        var request;
        var file = undefined;

        $('#openFile').on('click', function() {
            $('#image').click();
        });

        $('#image').on('change', function() {
            file = this.files[0];

            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview').removeClass('d-none').addClass('d-block');
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
            console.log("Uploaded image")
        });

        $('#upload').on('click', function(evt) {
            evt.preventDefault();

            if (!file) return;

            var formData = new FormData();
            // var formData = $("form.upl").serializeArray();

            var labelInputValue = $('#label').val();
            var commentorInputValue = $('#commentor').val();
            var paragraphValue = $('#summernote').val();

            formData.append('label', labelInputValue);
            formData.append('commentor', commentorInputValue);
            formData.append('paragraph', paragraphValue);
            formData.append('image', file);
            // formData.push({name:'image', value:file});
            // return console.log(formData)


            if (request) request.abort();
            blockPage();

            request = $.ajax({
                url: '/store-testimonial',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false
            });

            request.done(function(resp) {
                unBlockPage();
                toastAlert('Testimonial has been uploaded', 'Success', 'success');
                redirect('/pages/testimonials');
            });

            request.fail(function(_, __, errMsg) {
                console.log('Error: ', errMsg);
                unBlockPage();
                toastAlert('Something went wrong.', 'Error', 'error');
            });
        });
        // $('#deleteModal').on('show.bs.modal', function(evt) {
        //     var button = $(evt.relatedTarget);
        //     var slideId = button.data('slide');
        //     var modal = $(this);
        //     modal.find('#modalTitle').text('slide image');
        //     modal.find('#modalPrompt').text('slide image');
        //
        //     modal.find('#modalDeleteBtn').on('click', function(e) {
        //         e.preventDefault();
        //
        //         if (request) request.abort();
        //
        //         blockPage();
        //
        //         request = $.ajax({
        //             url: '/delete-slide/' + slideId,
        //             type: 'DELETE',
        //         });
        //
        //         request.done(function(resp, textStatus) {
        //             unBlockPage();
        //             // console.log(textStatus);
        //             // return;
        //
        //             if (textStatus == 'success') {
        //                 button.closest('.slide-card').remove();
        //                 modal.modal('hide');
        //                 toastAlert('Slide image deleted successfully.', 'Success', 'success');
        //             } else {
        //                 toastAlert('Something went wrong.', 'Error', 'error');
        //             }
        //
        //             setTimeout(function(){
        //                 window.location.reload();
        //             }, 2000);
        //         });
        //
        //         request.fail(function(jqXHR, textStatus, errorMessage) {
        //             unBlockPage();
        //             toastAlert('Something went wrong.', 'Error', 'error');
        //         });
        //     });
        // });
        console.log("loaded here")

    </script>
@endsection
