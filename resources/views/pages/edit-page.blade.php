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
<style>
    textarea{
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
                    <form action="{{ route('page-edit', $page->slug) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" readonly
                                           value="{{ ucwords($page->category->name) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Last Updated</label>
                                    <input type="text" class="form-control" id="title" readonly name="title"
                                           value="{{ $page->updated_at ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Page Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $page->title ?? '' }}">
                            </div>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <label for="newnew">Page Content Starts Here</label>
                        </div>

                        @if($page->slug == 'welcome-to-the-lagoon-school' && $page->page_category_id == 1)
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="other_titles_1"
                                       value="{{ $page->other_titles_1 ?? '' }}" placeholder="WHY LAGOON?">
                                <span class="alert-info">You can change the "Why Lagoon" Title to anything you want, here</span>
                            </div>
                            <label for="summernote">A short story of 'Why Lagoon' Goes here</label>
                            <textarea id="summernote1" name="content" class="editor-height"
                                      placeholder="A Short Story of 'Why Lagoon' goes here">{{$page->content ?? '' }}</textarea>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="title" name="other_titles_2"
                                           value="{{ $page->other_titles_2 ?? '' }}"
                                           placeholder="MEET A LAGOON STUDENT">
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="other_titles_3" name="other_titles_3"
                                       value="{{ $page->other_titles_3 ?? '' }}" placeholder="WHAT PARENTS ARE SAYING">
                                <span class="alert-info">You can change the "What Parents are saying" Title to anything you want, here</span>

                            </div>

                            <hr>
                            <h4>Testimonial Highlight (Best Parents testimonial).</h4>
                            <div class="form-group">
                                <label for="other_images_1">Image for Testimonial</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_1"
                                       name="other_images_1">
                                <span class="text-info ml-3">Max size: 1MB</span>
                            </div>
                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                <img
                                    src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"
                                    alt="Other Image"
                                    style="width: 400px"
                                    class="@if(!$page->other_images_1) d-none @endif"
                                >
                            </div>


                            {{--                            <textarea id="summernote_a" name="other_contents_1" class="editor-height"></textarea>--}}
                            <div class="col-md-12">
                                <label>Content for Testimonial</label>
                                <input type="text" style="word-break: break-word !important;" class="form-control"
                                       id="other_contents_1" name="other_contents_1"
                                       value="{{ $page->other_contents_1 ?? '' }}"
                                       placeholder="Where Girls are Called to Greatness' isn’t just a tagline or a marketing tool, it is woven into the fabric of everything Montrose does. The girls are constantly encouraged to be the best version of themselves all the while with amazing support from teachers, mentors, coaches, administration and their peers.">
                            </div>
                            <hr>
                            <h4>3 PORTRAITS OF LAGOON GIRLS (with nice descriptions)</h4>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="other_titles_4" name="other_titles_4"
                                       value="{{ $page->other_titles_4 ?? '' }}"
                                       placeholder="A PORTRAIT OF LAGOON GIRLS">
                            </div>

                            <div class="form-group">
                                <label for="other_images_2">Image 1</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_2"
                                       name="other_images_2">
                                <span class="text-info ml-3">Max size: 1MB</span>
                                <textarea type="text" style="word-break: break-word !important;" class="form-control"
                                       id="other_contents_2" name="other_contents_2"
                                          placeholder="Nice Description of the image above">{{ $page->other_contents_2 ?? '' }}</textarea>

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
                                <label for="other_images_3">Image 2</label>
                                <input type="file" accept="image/*" class="form-control" id="other_images_3"
                                       name="other_images_3">
                                <span class="text-info ml-3">Max size: 1MB</span>
                                <textarea type="text" style="word-break: break-word !important;" class="form-control"
                                       id="other_contents_3" name="other_contents_3"
                                          placeholder="Nice description of second image">{{ $page->other_contents_3 ?? '' }}</textarea>
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

                                <div class="form-group">
                                    <label for="other_images_4">Image 3</label>
                                    <input type="file" accept="image/*" class="form-control" id="other_images_4"
                                           name="other_images_4">
                                    <span class="text-info ml-3">Max size: 5MB</span>
                                    <textarea type="text" style="word-break: break-word !important;" class="form-control"
                                           id="other_contents_4" name="other_contents_4"

                                              placeholder="Nice description of the third image">{{ $page->other_contents_4 ?? '' }}</textarea>
                                </div>
                                <div class="banner-placeholder py-3" id="banner-placeholder">
                                    <img
                                        src="@if(!!$page->other_images_4) /images/{{ $page->other_images_4 }} @endif"
                                        alt="Other Image"
                                        style="width: 400px"
                                        class="@if(!$page->other_images_4) d-none @endif"
                                    >
                                </div>

                                @elseif($page->slug == 'meet-the-head' && $page->page_category_id == 1)
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="other_titles_1"
                                               value="{{ $page->other_titles_1 ?? '' }}"
                                               placeholder="WELCOME FROM THE HEAD OF SCHOOL">
                                    </div>
                                    <textarea id="summernote1" name="content" class="editor-height"></textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1"
                                               name="other_images_1">
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
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2"
                                               name="other_images_2">
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
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3"
                                               name="other_images_3">
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



                                @elseif($page->slug == 'educational-phylosophy-and-model' && $page->page_category_id == 1)
                                    <div class="form-group col-md-12">

                                        <h2>PURSUE THE TRUTH</h2>
                                        <textarea id="summernote1" style="width: 100%" name="other_contents_2" class="editor-height">{{$page->other_contents_2 ?? ''}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h2>DISCOVER GREATNESS IN ORDINARY LIFE</h2>
                                        <textarea style="width: 100%" id="content3" id="summernote3" name="content"
                                                  class="editor-height summernote">{{$page->content ?? ''}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h2>FOSTER VIRTUES OF MIND, HEART AND CHARACTER</h2>
                                        <textarea style="width: 100%" id="summernote2" name="content2"
                                                  class="editor-height">{{$page->content2 ?? ''}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_1">Image</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1"
                                               name="other_images_1">
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
                                @elseif($page->slug == 'courses' && $page->page_category_id == 2)
                                    <div class="form-group col-md-12">

                                        <h2>JUNIOR PRIMARY COURSES <span class="text-info">(Description and course list)</span></h2>
                                        <textarea id="summernote1" style="width: 100%" name="other_contents_1" class="editor-height">{{$page->other_contents_1 ?? ''}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h2>SENIOR PRIMARY COURSES <span class="text-info">(Description and course list)</span></h2>
                                        <textarea style="width: 100%" id="content3" id="summernote3" name="other_contents_2"
                                                  class="editor-height summernote">{{$page->other_contents_2 ?? ''}}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">

                                        <h2>JUNIOR SECONDARY COURSES <span class="text-info">(Description and course list)</span></h2>
                                        <textarea id="summernote1" style="width: 100%" name="other_contents_3" class="editor-height">{{$page->other_contents_3 ?? ''}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h2>SENIOR SECONDARY COURSES <span class="text-info">(Description and course list)</span></h2>
                                        <textarea style="width: 100%" id="content3" id="summernote3" name="other_contents_4"
                                                  class="editor-height summernote">{{$page->other_contents_4 ?? ''}}</textarea>
                                    </div>

                                @elseif($page->slug == 'faith' && $page->page_category_id == 1)
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Image 1</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_1"
                                               name="other_images_1">
                                        <span class="text-info ml-3">Max size: 1MB</span>
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
                                        <label for="other_images_2">Image 2</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2"
                                               name="other_images_2">
                                        <span class="text-info ml-3">Max size: 1MB</span>
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
                                        <label for="other_images_3">Image 3</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3"
                                               name="other_images_3">
                                        <span class="text-info ml-3">Max size: 1MB</span>
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
                                        <input type="text" class="form-control" id="title" name="other_titles_1"
                                               value="{{ $page->other_titles_1 ?? '' }}" placeholder="Opus Dei">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="title" name="other_contents_1"
                                              placeholder="Opus Dei is a personal prelature of the Catholic
                      Church founded in 1928 by St. Josemaría Escrivá.
                      At the core of Opus Dei’s mission is the teaching
                      that all men and women are called to holiness,
                      which can be pursued through our everyday lives
                      and work.">{{ $page->other_contents_1 ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="title" name="other_contents_2"
                                                placeholder="Our chaplains, priests of the Prelature, celebrate
                    Mass in our chapel daily, and our school community
                    approaches all work in a manner reflective of the
                    spirit of Opus Dei—with dedication and
                    cheerfulness, especially in the face of challenges.">{{ $page->other_contents_2 ?? '' }}</textarea>
                                    </div>

                                @elseif($page->slug == 'virtual-tour' && $page->page_category_id == 1)
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                @elseif($page->slug == 'academic-facilities' && $page->page_category_id == 2)
                                    <label>Academic Facilities Note</label>
                                    <textarea id="summernote" name="content" class="editor-height"></textarea>
                                @elseif($page->slug == 'primary-school' && $page->page_category_id == 2)
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Primary Section" id="title"
                                               name="other_titles_1"
                                               value="{{ $page->other_titles_1 ?? '' }}">
                                    </div>
                                    <label>Primary School Intro Note</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Laying the Groundwork. Strengthening the Foundation" id="title"
                                               name="other_titles_2"
                                               value="{{ $page->other_titles_2 ?? '' }}">
                                    </div>
                                    <textarea id="summernote1" name="content" class="editor-height">{{$page->content??''}}</textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Video Link (please post the embed version of the video link)</label>
                                        <input type="text" class="form-control" id="content2"
                                               name="content2" value="{{$page->content2??''}}">
                                    </div>
{{--                                    <div class="banner-placeholder py-3" id="banner-placeholder">--}}
{{--                                        <img--}}
{{--                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"--}}
{{--                                            alt="Other Image"--}}
{{--                                            style="width: 400px"--}}
{{--                                            class="@if(!$page->other_images_1) d-none @endif"--}}
{{--                                        >--}}
{{--                                    </div>--}}

                                @elseif($page->slug == 'secondary-school' && $page->page_category_id == 2)
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Secondary Section"
                                               id="title" name="other_titles_1"
                                               value="{{ $page->other_titles_1 ?? '' }}">
                                    </div>
                                    <label>Primary School Intro Note</label>
                                    <textarea id="summernote1" name="content" class="editor-height">{{$page->content??''}}</textarea>
                                    <div class="form-group">
                                        <label for="other_images_1">Video Link (please post the embed version of the video link)</label>
                                        <input type="text" class="form-control" id="content2"
                                               name="content2" value="{{$page->content2??''}}">
                                    </div>
{{--                                    <div class="banner-placeholder py-3" id="banner-placeholder">--}}
{{--                                        <img--}}
{{--                                            src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"--}}
{{--                                            alt="Other Image"--}}
{{--                                            style="width: 400px"--}}
{{--                                            class="@if(!$page->other_images_1) d-none @endif"--}}
{{--                                        >--}}
{{--                                    </div>--}}

                                    <hr>
                                    <h4>3 PORTRAITS OF LAGOON GIRLS (with nice descriptions if need be)</h4>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="other_titles_4"
                                               name="other_titles_4"
                                               value="{{ $page->other_titles_4 ?? '' }}"
                                               placeholder="Hear what our Alumni has to say">
                                    </div>

                                    <div class="form-group">
                                        <label for="other_images_2">Image 1</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_2"
                                               name="other_images_2">
                                        <span class="text-info ml-3">Max size: 1MB</span>
                                        <input type="text" style="word-break: break-word !important;"
                                               class="form-control"
                                               id="other_contents_2" name="other_contents_2"
                                               value="{{ $page->other_contents_2 ?? '' }}"
                                               placeholder="Nice Description of the image above">

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
                                        <label for="other_images_3">Image 2</label>
                                        <input type="file" accept="image/*" class="form-control" id="other_images_3"
                                               name="other_images_3">
                                        <span class="text-info ml-3">Max size: 1MB</span>
                                        <input type="text" style="word-break: break-word !important;"
                                               class="form-control"
                                               id="other_contents_3" name="other_contents_3"
                                               value="{{ $page->other_contents_3 ?? '' }}"
                                               placeholder="Nice description of second image">
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

                                        <div class="form-group">
                                            <label for="other_images_4">Image 3</label>
                                            <input type="file" accept="image/*" class="form-control" id="other_images_4"
                                                   name="other_images_4">
                                            <span class="text-info ml-3">Max size: 5MB</span>
                                            <input type="text" style="word-break: break-word !important;"
                                                   class="form-control"
                                                   id="other_contents_4" name="other_contents_4"
                                                   value="{{ $page->other_contents_3 ?? '' }}"
                                                   placeholder="Nice description of the third image">
                                        </div>
                                        <div class="banner-placeholder py-3" id="banner-placeholder">
                                            <img
                                                src="@if(!!$page->other_images_4) /images/{{ $page->other_images_4 }} @endif"
                                                alt="Other Image"
                                                style="width: 400px"
                                                class="@if(!$page->other_images_4) d-none @endif"
                                            >
                                        </div>

                                        @elseif($page->slug == 'academic-calendar' && $page->page_category_id == 2)
                                            <div class="form-group">
                                                <label for="other_images_1">Academic Calendar</label>
                                                <input type="file"
                                                       accept="image/*, application/pdf, application/vnd.ms-excel"
                                                       class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                @if(!!$page->other_images_1)
                                                    <a
                                                        href="/images/{{ $page->other_images_1 }}"
                                                        title="Athletic Activities"
                                                        class="@if(!$page->other_images_1) d-none @endif"
                                                    ><img
                                                            src="/document-icon.png"
                                                            alt="Document"
                                                            style="width: 100px"
                                                            class="@if(!$page->other_images_1) d-none @endif"
                                                        ></a>
                                                @endif
                                            </div>


                                            <div class="form-group">
                                                <label for="other_images_3">Athletic Activities</label>
                                                <input type="file"
                                                       accept="image/*, application/pdf, application/vnd.ms-excel"
                                                       class="form-control"
                                                       id="other_images_2"
                                                       name="other_images_2">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                @if(!!$page->other_images_2)
                                                    <a
                                                        href="/images/{{ $page->other_images_2 }}"
                                                        title="Athletic Activities"
                                                        class="@if(!$page->other_images_2) d-none @endif"
                                                    ><img
                                                            src="/document-icon.png"
                                                            alt="Document"
                                                            style="width: 100px"
                                                            class="@if(!$page->other_images_1) d-none @endif"
                                                        ></a>
                                                @endif

                                            </div>

                                        @elseif($page->slug == 'partnership-with-parents' && $page->page_category_id == 1)
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="title"
                                                       name="other_contents_1"
                                                       value="{{ $page->other_contents_1 ?? '' }}"
                                                       placeholder="Parent partnership is foundational to the mission and philosophy of Oakcrest School. We are committed to supporting parents as the primary educators of">
                                            </div>
                                            <div class="form-group">
                                                <label for="other_images_1">Image</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
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

                                            <textarea id="summernote" name="content"
                                                      class="editor-height"></textarea>

                                            <div class="form-group">
                                                <label for="other_images_2">Image</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_2"
                                                       name="other_images_2">
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
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_3"
                                                       name="other_images_3">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                                    alt="Other Image"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_3) d-none @endif"
                                                >
                                            </div>

                                        @elseif(($page->slug == 'service' && $page->page_category_id == 4)||($page->slug == 'uniform' && $page->page_category_id == 6))
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="title"
                                                       name="other_contents_1"
                                                       value="{{ $page->other_contents_1 ?? '' }}"
                                                       placeholder="S   ervice is an integral part of the Lagoon culture. At the heart of Christian leadership is service. Our service program helps girls recognize the beauty of self-gift and the many ways they can step up to be servant- leaders. Each service component at Laggon encourages our girls to serve in ways that are best suited to their gifts and personal circumstance">
                                            </div>
                                            <div class="form-group">
                                                <label for="other_images_1">Big Image</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
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

{{--                                            <textarea id="summernote" name="content"--}}
{{--                                                      class="editor-height"></textarea>--}}

                                            <div class="form-group">
                                                <label for="other_images_2">Smaller Image 1</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_2"
                                                       name="other_images_2">
                                                <span class="text-info ml-3">Max size: 5MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                                    alt="Other Image 1"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_2) d-none @endif"
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label for="other_images_3">Image 2</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_3"
                                                       name="other_images_3">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                                    alt="Other Image 2"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_3) d-none @endif"
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label for="other_images_3">Image 3</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_4"
                                                       name="other_images_4">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_4) /images/{{ $page->other_images_4 }} @endif"
                                                    alt="Other Image 3"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_4) d-none @endif"
                                                >
                                            </div>
                                        @elseif($page->slug == 'club-activities' && $page->page_category_id == 4)
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="title"
                                                       name="other_contents_1"
                                                       value="{{ $page->other_contents_1 ?? '' }}"
                                                       placeholder="We encourage students to participate in extracurricular events, pursue their personal interests, and create new clubs each school year. Lagoon is currently home to many Primary and Secondary School clubs, many of them initiated by students. These clubs and activities encourage students to take initiative and responsibility in leading activities that allow them to explore their talents and passions outside the classroom.">
                                            </div>
                                            <div class="form-group">
                                                <label for="other_images_1">Image 1</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
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

                                            {{--                                            <textarea id="summernote" name="content"--}}
                                            {{--                                                      class="editor-height"></textarea>--}}

                                            <div class="form-group">
                                                <label for="other_images_2">Image 2</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_2"
                                                       name="other_images_2">
                                                <span class="text-info ml-3">Max size: 5MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_2) /images/{{ $page->other_images_2 }} @endif"
                                                    alt="Other Image 1"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_2) d-none @endif"
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label for="other_images_3">Image 3</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_3"
                                                       name="other_images_3">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_3) /images/{{ $page->other_images_3 }} @endif"
                                                    alt="Other Image 2"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_3) d-none @endif"
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label for="other_images_3">Image 4</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_4"
                                                       name="other_images_4">
                                                <span class="text-info ml-3">Max size: 1MB</span>
                                            </div>
                                            <div class="banner-placeholder py-3" id="banner-placeholder">
                                                <img
                                                    src="@if(!!$page->other_images_4) /images/{{ $page->other_images_4 }} @endif"
                                                    alt="Other Image 3"
                                                    style="width: 400px"
                                                    class="@if(!$page->other_images_4) d-none @endif"
                                                >
                                            </div>
                                        @elseif($page->slug == 'life-in-lagoon' && $page->page_category_id == 4)
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="title"
                                                       name="other_titles_1"
                                                       value="{{ $page->other_titles_1 ?? '' }}"
                                                       placeholder="Image Caption">
                                            </div>
                                            <div class="form-group">
                                                <label for="other_images_1">Image</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
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

                                            <textarea id="summernote1" name="other_contents_1"
                                                      class="editor-height">{{$page->other_contents_1}}</textarea>
                                        @elseif(($page->slug == 'lunch-menu'|| $page->slug == 'digital-safety') && $page->page_category_id == 6)
{{--                                            <div class="form-group">--}}
{{--                                                <input type="text" class="form-control" id="title"--}}
{{--                                                       name="other_titles_1"--}}
{{--                                                       value="{{ $page->other_titles_1 ?? '' }}"--}}
{{--                                                       placeholder="Image Caption">--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <label for="other_images_1">Upload PDF</label>
                                                <input type="file" class="form-control"
                                                       id="other_images_1"
                                                       name="other_images_1">
                                                <span class="text-info ml-3">Max size: 5MB</span>
                                            </div>
{{--                                            <div class="banner-placeholder py-3" id="banner-placeholder">--}}
{{--                                                <img--}}
{{--                                                    src="@if(!!$page->other_images_1) /images/{{ $page->other_images_1 }} @endif"--}}
{{--                                                    alt="Other Image"--}}
{{--                                                    style="width: 400px"--}}
{{--                                                    class="@if(!$page->other_images_1) d-none @endif"--}}
{{--                                                >--}}
{{--                                            </div>--}}

{{--                                            <textarea id="summernote1" name="other_contents_1"--}}
{{--                                                      class="editor-height">{{$page->other_contents_1}}</textarea>--}}

                                        @else
                                            <textarea id="summernote" name="content"
                                                      class="editor-height"></textarea>
                                        @endif

                                        <br>
                                        <hr>

                                        <div class="form-group">
                                            <label for="banner">Banner</label>
                                            <input type="file" accept="image/*" class="form-control" id="banner"
                                                   name="banner">
                                            <span class="text-info ml-3">Max size: 1MB</span>
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

                                        {{--                                <div class="form-group">--}}
                                        {{--                                    <label for="footerImage">Footer image</label><br>--}}
                                        {{--                                    <input type="file" accept="image/*" class="form-control" id="footerImage"--}}
                                        {{--                                           name="footerImage">--}}
                                        {{--                                </div>--}}


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
        {{--var content2 = '{!! addcslashes($page->content2 ?? '', '"') !!}';--}}
        // $('#summernote').summernote('pasteHTML', content).addClass('editor-height');
        // $('#summernote2').summernote('pasteHTML', content2);
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
