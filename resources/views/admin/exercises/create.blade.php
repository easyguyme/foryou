@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{route('admin.exercises.store')}}" autocomplete="off"
                          class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">


                                <h4 class="card-title">{{ __('Add an exercise') }}</h4>
                                {{--                                <p class="card-category"> {{ __('You can separate them using a comma e.g Chair,Ball') }}</p>--}}
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('admin.exercises.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Exercise name:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text"
                                                   placeholder="{{ __('Exercise name') }}" value="{{ old('name') }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Description:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <input
                                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    name="description" id="input-description" type="text"
                                                    placeholder="{{ __('Exercise description') }}"
                                                    value="{{ old('description') }}"
                                                    required="true" aria-required="true"/>
                                            @if ($errors->has('description'))
                                                <span id="description-error" class="error text-danger"
                                                      for="input-description">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Instructions:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('instruction') ? ' has-danger' : '' }}">
                                            <textarea
                                                    class="form-control{{ $errors->has('instruction') ? ' is-invalid' : '' }}"
                                                    name="instruction" id="input-instruction" type="text"
                                                    placeholder="{{ __('Exercise instruction') }}"
                                                    value="{{ old('instruction') }}"
                                                    required="true" aria-required="true" value="{{ old('instruction') }}" rows="3"></textarea>
                                            @if ($errors->has('instruction'))
                                                <span id="instruction-error" class="error text-danger"
                                                      for="input-instruction">{{ $errors->first('instruction') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Tags:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                            <input
                                                    class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                                                    name="tags" id="input-tags" type="text"
                                                    placeholder="{{ __('Exercise tags') }}"
                                                    value="{{ old('tags') }}"
                                                    required="true" aria-required="true"/>
                                            @if ($errors->has('tags'))
                                                <span id="tags-error" class="error text-danger"
                                                      for="input-tags">{{ $errors->first('tags') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10">
                                        <h3>
                                            <small>Media</small>
                                        </h3>
                                        <!-- Tabs with icons on Card -->
                                        <div class="card card-nav-tabs">
                                            <div class="card-header card-header-warning">
                                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                                <div class="nav-tabs-navigation">
                                                    <div class="nav-tabs-wrapper">
                                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="#photos"
                                                                   data-toggle="tab">
                                                                    <i class="material-icons">camera_alt</i>
                                                                    Photos
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#videos" data-toggle="tab">
                                                                    <i class="material-icons">videocam</i>
                                                                    Videos
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                <div class="tab-content text-center">
                                                    <div class="tab-pane active" id="photos">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h4>
                                                                    <small>Start</small>
                                                                    @if ($errors->has('start'))
                                                                        <span id="start-error" class="error text-danger"
                                                                              for="input-modules">{{ $errors->first('start') }}</span>
                                                                    @endif
                                                                </h4>
                                                                <b class="caret"></b>
                                                                <div class="col-sm-6">
                                                                    <div class="col-sm-6 btn btn-secondary btn-sm float-left">
                                                                        <span>Select an image to upload</span>
                                                                        <input type="file" name="photo_start">

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4>
                                                                    <small>End</small>
                                                                    @if ($errors->has('start'))
                                                                        <span id="end-error" class="error text-danger"
                                                                              for="input-modules">{{ $errors->first('end') }}</span>
                                                                    @endif
                                                                </h4>
                                                                <b class="caret"></b>
                                                                <div class="col-sm-6">
                                                                    <div class="col-sm-6 btn btn-secondary btn-sm float-left">
                                                                        <span>Select an image to upload</span>
                                                                        <input type="file" name="photo_end">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="videos">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6 btn btn-secondary btn-sm float-left">
                                                                <span>Select a video to upload</span>
                                                                <input type="file" name="video">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Tabs with icons on Card -->
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" id="add_client"
                                        class="btn btn-primary">{{ __('Add exercise') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
