@extends('layouts.admin')
@section('content')
    <form action="{{ route("admin.patients.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
        </h4>
    </div>

    <div class="card-body">



            <div class="row">
                <div class="col-sm-12">
                    @if ($errors->has('error'))
                        <span id="weight-error" class="error text-danger" for="input-error">{{ $errors->first('error') }}</span>
                    @endif
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
                    <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                        <select name="user_id" id="user_id" class="form-control select2" multiple="multiple" required>
                            @foreach($users as  $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                                {{--                        <option value="{{ $value }}" {{ (in_array($id, old('user_id', [])) || isset($user) && $user->user_id->contains($id)) ? 'selected' : '' }}>{{ $user_id }}</option>--}}
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Gender') }}</label>
                <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">

                        {!! Form::select('gender', array('Male'=>'Male','Female'=>'Female','Other'=>'Other'),null,array('class' => 'form-control')) !!}
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
                        <input class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" min="1" name="age" id="input-age" type="number" placeholder="{{ __('Age in years') }}" value="{{ old('age') }}" required />
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
                        <input class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" min="1" name="weight" id="input-weight" type="number" placeholder="{{ __('Weight in Kgs') }}" value="{{ old('weight') }}" required />
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
                        <input class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" min="1" name="height" id="input-height" type="number" placeholder="{{ __("Height in cm e.g 160") }}" value="{{ old('height') }}" required />
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
                        <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="input-address" type="text" placeholder="{{ __('Kasuku lane,Kileleshwa') }}" value="{{ old('address') }}" required />
                        @if ($errors->has('address'))
                            <span id="address-error" class="error text-danger" for="input-address">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
            </div>



    </div>
    <div class="card-footer ml-auto mr-auto">
        <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
    </div>
</div>
    </form>
@endsection
