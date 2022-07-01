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
    Edit {{ ucwords($page->title) }} page
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords($page->title ?? '') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('page-edit', $page->slug) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" readonly value="{{ ucwords($page->category->name) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Last Updated</label>
                                    <input type="text" class="form-control" id="title" readonly name="title" value="{{ $page->updated_at ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Page Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $page->title ?? '' }}">
                            </div>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <label for="newnew">Page Content Starts Here</label>
                        </div>

                        @if($page->slug == 'welcome-to-the-lagoon-school' && $page->page_category_id == 1)
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="other_titles_1" value="{{ $page->other_titles_1 ?? '' }}" placeholder="WHY LAGOON?">
                            </div>
                            <textarea id="summernote" name="content" class="editor-height"></textarea>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="title" name="other_titles_2" value="{{ $page->other_titles_2 ?? '' }}" placeholder="MEET A LAGOON STUDENT">
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="other_images_1">Image</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_1" name="other_images_1">
                                <span class="text-info ml-3">Max size: 5MB</span>
                            </div>
                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                <img
                                    src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                    alt="Other Image"
                                    style="width: 400px"
                                    class="@if(!$page->other_images_1) d-none @endif"
                                >
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" id="other_titles_3" name="other_titles_3" value="{{ $page->other_titles_3 ?? '' }}" placeholder="WHAT PARENTS ARE SAYING">
                            </div>

{{--                            <textarea id="summernote_a" name="other_contents_1" class="editor-height"></textarea>--}}
                            <div class="col-md-12">
                                <input type="text" style="word-break: break-word !important;" class="form-control" id="other_contents_1" name="other_contents_1" value="{{ $page->other_contents_1 ?? '' }}" placeholder="Where Girls are Called to Greatness' isn’t just a tagline or a marketing tool, it is woven into the fabric of everything Montrose does. The girls are constantly encouraged to be the best version of themselves all the while with amazing support from teachers, mentors, coaches, administration and their peers.">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" id="other_titles_4" name="other_titles_4" value="{{ $page->other_titles_4 ?? '' }}" placeholder="A PORTRAIT OF LAGOON GIRLS">
                            </div>

                            <div class="form-group">
                                <label for="other_images_2">Image</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_2" name="other_images_2">
                                <span class="text-info ml-3">Max size: 5MB</span>
                            </div>
                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                <img
                                    src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                    alt="Other Image"
                                    style="width: 400px"
                                    class="@if(!$page->other_images_2) d-none @endif"
                                >
                            </div>

                            <div class="col-md-12">
                                <input type="text" style="word-break: break-word !important;" class="form-control" id="other_contents_2" name="other_contents_2" value="{{ $page->other_contents_2 ?? '' }}" placeholder="<ul><li>Intellectual curiosity</li><li>Ability to problem-solve</li>
            <li>
              Passion for learning, a breadth of interests and a clear sense of
              purpos
            </li>
            <li>Resilience and perseverance in the face of difficulty</li>
            <li>
              Practical wisdom and the competence to commit herself to what is
              noble and worthwhile
            </li>
          </ul>">
                            </div>

                            <div class="form-group">
                                <label for="other_images_3">Image</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_3" name="other_images_3">
                                <span class="text-info ml-3">Max size: 5MB</span>
                            </div>
                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                <img
                                    src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                    alt="Other Image"
                                    style="width: 400px"
                                    class="@if(!$page->other_images_3) d-none @endif"
                                >
                            </div>

                            <div class="col-md-12">
                                <input type="text" style="word-break: break-word !important;" class="form-control" id="other_contents_3" name="other_contents_3" value="{{ $page->other_contents_3 ?? '' }}" placeholder="<ul>
            <li>
              Understands the integral relationship between faith and reason
            </li>
            <li>
              Cultivates a philosophical mind and knows that all work can
              glorify God
            </li>
            <li>espects the uniqueness of others</li>
            <li>Is empathetic</li>
            <li>Seeks to build unity among diverse groups</li>
            <li>
              {' '}
                                Has a desire to discover her own unique purpose, vocation and
                                contribution to the world
                                </li>
                                <li>Understands the value of a personal relationship with God</li>
                                </ul>">

                                <div class="form-group">
                                    <label for="other_images_4">Image</label>
                                    <input type="file" accept="image/*" class="form-control" id="other_images_4" name="other_images_4">
                                    <span class="text-info ml-3">Max size: 5MB</span>
                                </div>
                                <div class="banner-placeholder py-3" id="banner-placeholder">
                                    <img
                                        src="@if(!!$page->other_images_4) /images/{{ $page->other_images_4 }} @endif"
                                        alt="Other Image"
                                        style="width: 400px"
                                        class="@if(!$page->other_images_4) d-none @endif"
                                    >
                                </div>

                                <input type="text" style="word-break: break-word !important;" class="form-control" id="other_contents_3" name="other_contents_3" value="{{ $page->other_contents_3 ?? '' }}" placeholder="<ul>
            <li>A strong self-knowledge</li>
            <li>
              An open and loving heart, actively participating in and serving
              her community
            </li>
            <li>Confidence, initiative and courage</li>
            <li>A sense of balance and a sense of humor</li>
            <li>The wisdom to use her freedom responsibly</li>
            <li>
              A principled, independent ability to challenge others articulately
              and respectfully
            </li>
          </ul>">



                        @endif

                        @if($page->slug == 'meet-the-head' && $page->page_category_id == 1)
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="other_titles_1" value="{{ $page->other_titles_1 ?? '' }}" placeholder="WELCOME FROM THE HEAD OF SCHOOL">
                            </div>
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1" name="other_images_1">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_1) d-none @endif"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_2">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2" name="other_images_2">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_2) d-none @endif"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_3">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3" name="other_images_3">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_3) d-none @endif"
                                        >
                                    </div>


                        @endif
                            @if($page->slug == 'educational-phylosophy-and-model' && $page->page_category_id == 1)
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1" name="other_images_1">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_1) d-none @endif"
                                        >
                                    </div>

                            @endif
                         @if($page->slug == 'faith' && $page->page_category_id == 1)
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1" name="other_images_1">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_1) d-none @endif"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_2">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2" name="other_images_2">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_2) d-none @endif"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_3">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3" name="other_images_3">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_3) d-none @endif"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="other_titles_1" value="{{ $page->other_titles_1 ?? '' }}" placeholder="Opus Dei">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="other_contents_1" value="{{ $page->other_contents_1 ?? '' }}" placeholder="Opus Dei is a personal prelature of the Catholic
                      Church founded in 1928 by St. Josemaría Escrivá.
                      At the core of Opus Dei’s mission is the teaching
                      that all men and women are called to holiness,
                      which can be pursued through our everyday lives
                      and work.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="other_contents_2" value="{{ $page->other_contents_2 ?? '' }}" placeholder="Our chaplains, priests of the Prelature, celebrate
                    Mass in our chapel daily, and our school community
                    approaches all work in a manner reflective of the
                    spirit of Opus Dei—with dedication and
                    cheerfulness, especially in the face of challenges.">
                                    </div>

                         @endif
                         @if($page->slug == 'virtual-tour' && $page->page_category_id == 1)
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                         @endif
                         @if($page->slug == 'partnership-with-parents' && $page->page_category_id == 1)
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="other_contents_1" value="{{ $page->other_contents_1 ?? '' }}" placeholder="Parent partnership is foundational to the mission and philosophy of Oakcrest School. We are committed to supporting parents as the primary educators of">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1" name="other_images_1">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_1) d-none @endif"
                                        >
                                    </div>

                                    <textarea id="summernote" name="content" class="editor-height"></textarea>

                                    <div class="form-group">
                                        <label for="other_images_2">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2" name="other_images_2">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_2) d-none @endif"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_3">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3" name="other_images_3">
                                        <span class="text-info ml-3">Max size: 5MB</span>
                                    </div>
                                    <div class="banner-placeholder py-3" id="banner-placeholder">
                                        <img
                                            src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                            alt="Other Image"
                                            style="width: 400px"
                                            class="@if(!$page->other_images_3) d-none @endif"
                                        >
                                    </div>
                         @endif

                        <br>

                        <div class="form-group">
                            <label for="banner">Banner</label>
                            <input type="file" accept="image/*" class="form-control" id="banner" name="banner">
                            <span class="text-info ml-3">Max size: 10MB</span>
                        </div>
                        <div class="banner-placeholder py-3" id="banner-placeholder">
                            <img
                                src="@if(!!$page->banner) /images/{{ $page->banner }} @endif"
                                alt="Banner Image"
                                style="width: 400px"
                                class="@if(!$page->banner) d-none @endif"
                            >
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="footerImage">Footer image</label><br>
                            <input type="file" accept="image/*" class="form-control" id="footerImage" name="footerImage">
                        </div>



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
        $('#summernote').summernote('pasteHTML', content).addClass('editor-height');
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
@endsection
