@extends('layouts.admin')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" id="patient_form" action="{{route('admin.patients.update',$patients->id)}}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">



                                <h4 class="card-title">{{ __('Edit patient') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('admin.patients.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Patient Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text"
                                                   placeholder="{{ __('patient Name') }}" value="{{ old('name',$patients->user->name) }}"
                                                   disabled/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" id="input-email" type="email"
                                                   placeholder="{{ __('Email') }}" value="{{ old('email',$patients->user->email) }}" disabled/>
                                            @if ($errors->has('email'))
                                                <span id="email-error" class="error text-danger"
                                                      for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Gender') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">

                                            {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female','Other'=>'Other'),$patients->gender,['class' => 'form-control']); !!}
                                            {{--                                            {!! Form::select('product_id', $groups, 1, ['class' => 'form-control']) !!}--}}

                                            @if ($errors->has('gender'))
                                                <span id="gender-error" class="error text-danger" for="input-gender">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Age') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" value="{{$patients->age}}" min="1" name="age" id="input-age" type="number" placeholder="{{ __('Age in years') }}"  required />
                                            @if ($errors->has('age'))
                                                <span id="age-error" class="error text-danger" for="input-age">{{ $errors->first('age') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Weight') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('weight') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" min="1" name="weight" id="input-weight" type="number" placeholder="{{ __('Weight in Kgs') }}" value="{{ $patients->weight }}" required />
                                            @if ($errors->has('weight'))
                                                <span id="weight-error" class="error text-danger" for="input-weight">{{ $errors->first('weight') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Height') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('height') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" min="1" name="height" id="input-height" type="number" placeholder="{{ __("Height in cm e.g 160") }}" value="{{ $patients->height }}" required />
                                            @if ($errors->has('height'))
                                                <span id="height-error" class="error text-danger" for="input-height">{{ $errors->first('height') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="input-address" type="text" placeholder="{{ __('Kasuku lane,Kileleshwa') }}" value="{{ $patients->address }}" required />
                                            @if ($errors->has('address'))
                                                <span id="address-error" class="error text-danger" for="input-address">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"  class="btn btn-primary">{{ __('Update patient') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
