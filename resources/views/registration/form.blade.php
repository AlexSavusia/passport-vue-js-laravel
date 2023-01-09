<?php
/**
 * @var App\Commands\RedirectCommand $redirect
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
    <registration :token="'{{ csrf_token() }}'"
                  :google="'{{ \Illuminate\Support\Facades\URL::route('auth.federal-login.redirect', [
                                'provider' => 'google',
                                'return_path' => $redirect->getReturnPath(),
                            ]) }}'"
                  :facebook="'{{ \Illuminate\Support\Facades\URL::route('auth.federal-login.redirect', [
                                'provider' => 'facebook',
                                'return_path' => $redirect->getReturnPath(),
                            ]) }}'"
                  :apple="'{{ \Illuminate\Support\Facades\URL::route('auth.federal-login.redirect', [
                                'provider' => 'apple',
                                'return_path' => $redirect->getReturnPath(),
                            ]) }}'"></registration>
</div>
<form class="popup__form">
    @csrf
</form>
{{--<div class="overlay">--}}
{{--    <div class="popup">--}}
{{--        <h1 class="popup__header">Create your free account</h1>--}}

{{--        <form class="popup__form" method="post" action="{{ route('registration.temp') }}">--}}
{{--            @csrf--}}

{{--            <div class="popup__inputs">--}}
{{--                <input class="popup__input{{ count($errors->get('email')) ? ' is-error' : '' }}" name="email" type="email" placeholder="Email">--}}
{{--                <input class="popup__input{{ count($errors->get('first_name')) ? ' is-error' : '' }}" name="first_name" type="text" placeholder="First Name">--}}
{{--                <input class="popup__input{{ count($errors->get('last_name')) ? ' is-error' : '' }}" name="last_name" type="text" placeholder="Last Name">--}}
{{--                <input class="popup__input{{ count($errors->get('password')) ? ' is-error' : '' }}" name="password" type="password" placeholder="Password">--}}
{{--            </div>--}}

{{--            <button class="popup__button" type="submit">Continue</button>--}}
{{--        </form>--}}
{{--        <div class="popup__footer">--}}
{{--            All fields are required. By creating an account you agree to our--}}
{{--            <a href="https://yellowimages.com/terms/">Terms & Conditions</a> and our--}}
{{--            <a href="https://yellowimages.com/privacy-policy/">Privacy Policy</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Add your site or application content here -->
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
