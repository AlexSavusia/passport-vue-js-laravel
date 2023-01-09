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
  <preregistr    :token="'{{ csrf_token() }}'"
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
                            ]) }}'"></preregistr>
</div>
<form class="popup__form">
    @csrf
</form>
{{--    <div class="overlay">--}}
{{--        <div class="popup">--}}
{{--            <h1 class="popup__header">Create your free account</h1>--}}
{{--            @if(!empty($redirect->getReturnPath()))--}}
{{--                <a href="{{ $redirect->getReturnPath() }}">Назад</a>--}}
{{--            @endif--}}
{{--            <form class="popup__form" method="post" action="{{ route('auth.redirect.do') }}">--}}
{{--                @csrf--}}

{{--                <div class="popup__inputs">--}}
{{--                    <input class="popup__input{{ count($errors->get('email')) ? ' is-error' : '' }}" name="email" type="text" placeholder="">--}}
{{--                </div>--}}

{{--                @if($errors->getMessages())--}}
{{--                    <div class="popup__errors">--}}
{{--                        @foreach ($errors->getMessages() as $field => $errors)--}}
{{--                            <p>{{ $field }} error:</p>--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors as $text)--}}
{{--                                    <li>{{ $text }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <button class="popup__button" type="submit">Continue</button>--}}
{{--            </form>--}}
{{--            <div class="popup__footer">--}}
{{--                All fields are required. By creating an account you agree to our <a href="https://yellowimages.com/terms/">Terms & Conditions</a> and our <a href="https://yellowimages.com/privacy-policy/">Privacy Policy--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

    <!-- Add your site or application content here -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
