@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">medical_services</i>
                    </div>
                    <p class="card-category">No. Of Patients</p>
                    <h3 class="card-title">{{$clients}}

                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-secondary">arrow_right_alt</i>
                        <a href="{{route('admin.patients.index')}}">view</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">rowing</i>
                    </div>
                    <p class="card-category">No. Of Exercises</p>
                    <h3 class="card-title">{{$exercis}}

                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-secondary">arrow_right_alt</i>
                        <a href="{{route('admin.exercises.index')}}">view</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">contact_page</i>
                    </div>
                    <p class="card-category">No. Of Programs</p>
                    <h3 class="card-title">{{$program}}

                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-secondary">arrow_right_alt</i>
                        <a href="{{route('admin.programs.index')}}">view</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">account_box</i>
                    </div>
                    <p class="card-category">No. Of Users</p>
                    <h3 class="card-title">{{$users}}

                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-secondary">arrow_right_alt</i>
                        <a href="{{route('admin.users.index')}}">view</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection