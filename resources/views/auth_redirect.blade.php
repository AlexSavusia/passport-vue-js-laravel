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

    <!-- Add your site or application content here -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
