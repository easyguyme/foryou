@extends('layouts.app')
@section('content')
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
    <div class="container justify-content-center">
        <div class="navbar-wrapper text-center">
            <a class="navbar-brand" href="#"><img src="{{ asset('images') }}/logo.png" alt="{{ trans('panel.site_title') }}" style="width: 150px"></a>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('images') }}/login.svg');  " data-color="red">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <div class="card card-login mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">
                                <strong>{{ trans('global.reset_password') }}</strong>
                            </h4>
                        </div>
                        <div class="card-body login-card-body">
                            <form method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div>
                                    <div class="form-group has-feedback">
                                        <input type="email" name="email" class="form-control" required="autofocus" placeholder="{{ trans('global.login_email') }}">
                                        @if($errors->has('email'))
                                            <p class="help-block">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-link btn-lg">
                                        {{ trans('global.reset_password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <nav class="float-left">

        </nav>
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            <a href="https://www.physio4u.co/" target="_blank">physio4u.co</a>
        </div>
    </div>
</footer>
@endsection
