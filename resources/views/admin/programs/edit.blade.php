@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <form method="post" id="patient_form" action="{{route('admin.programs.update',$programs->id)}}" autocomplete="off"

                      class="form-horizontal">
                @csrf
                @method('put')
                <div class="card ">
                    <div class="card-header card-header-primary">


                        <h4 class="card-title">{{ __('Create a Program') }}</h4>
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
                                <a href="{{ route('admin.programs.index') }}"
                                   class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Program name:') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" id="input-name" type="text"
                                           placeholder="{{ __('Program name') }}" value="{{ old('name',$programs->name) }}"
                                           required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger"
                                              for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Descriptions:') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea
                                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    name="description" id="input-description" type="text"
                                                    placeholder="{{ __('Program description') }}"
                                                    value="{{ old('description') }}"
                                                    required="true" aria-required="true" value="{{ old('name',$programs->description) }}" rows="3">{{ old('name',$programs->description) }}</textarea>
                                    @if ($errors->has('description'))
                                        <span id="description-error" class="error text-danger"
                                              for="input-description">{{ $errors->first('description') }}</span>
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
                                            placeholder="{{ __('Program tags') }}"
                                            value="{{ old('name',$programs->tags) }}"
                                            required="true" aria-required="true"/>
                                    @if ($errors->has('tags'))
                                        <span id="tags-error" class="error text-danger"
                                              for="input-tags">{{ $errors->first('tags') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit"  class="btn btn-primary">{{ __('Update Program') }}</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('scripts')
    @parent



@endsection
