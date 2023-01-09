<?php
/**
 * @var \App\Commands\RedirectCommand $redirect
 * @var $errors
 */
?>
    <!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Login form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fafafa">
    <link rel="manifest" href="site.webmanifest">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div id="app">
    <password :token="'{{ csrf_token() }}'"></password>
</div>
<form class="popup__form">
    @csrf
</form>
<!-- Add your site or application content here -->
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

{{--<main class="login-form">--}}
{{--    <div class="cotainer">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">Reset Password</div>--}}
{{--                    <div class="card-body">--}}
{{--                        @if (\Illuminate\Support\Facades\Session::has('message'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ \Illuminate\Support\Facades\Session::get('message') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <form action="{{ route('forget.password.post') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>--}}
{{--                                    @if ($errors->has('email'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('email') }}</span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    Send Password Reset Link--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</main>--}}
