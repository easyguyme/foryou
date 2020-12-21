{{--<form method="POST">--}}
{{--    @csrf--}}



{{--    <div>--}}
{{--        <label for="password">{{ __('Password') }}</label>--}}

{{--        <div>--}}
{{--            <input id="password" type="password" class="@error('password') is-invalid @enderror"--}}
{{--                   name="password" required autocomplete="new-password">--}}

{{--            @error('password')--}}
{{--            <span>--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div>--}}
{{--        <label for="password-confirm">{{ __('Confirm Password') }}</label>--}}

{{--        <div>--}}
{{--            <input id="password-confirm" type="password" name="password_confirmation" required--}}
{{--                   autocomplete="new-password">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div>--}}
{{--        <button type="submit">--}}
{{--            {{ __('Save password and login') }}--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</form>--}}
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
                                    <strong>Input a new password</strong>
                                </h4>
                            </div>
                            <div class="card-body login-card-body">
                                @if(\Session::has('message'))
                                    <p class="alert alert-info">
                                        {{ \Session::get('message') }}
                                    </p>
                                @endif

                                <form  method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="email" value="{{ $user->email }}"/>

                                    <div class="form-group">
                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}" name="password">
                                        @error('password')
                                        <span>
                    <strong>{{ $message }}</strong>
                </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" name="password_confirmation" required
                                               autocomplete="new-password">

                                    </div>

                                    <div class="card-footer justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-link btn-lg"> {{ __('Save password and login') }}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.login-card-body -->
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
