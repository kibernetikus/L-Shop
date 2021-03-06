<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ $csrfToken }}">

    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" type="text/css" rel="stylesheet">

    @if($captchaEnabled)
        <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    @endif
</head>
<body>

<div id="app">
    <v-app>
        <notifications></notifications>
        <request-error></request-error>
        <preloader></preloader>

        <router-view></router-view>
    </v-app>
</div>

<script type="text/javascript">
    window.baseUrl = '{{ $baseUrl }}';
    window.baseUrlPath = '{{ $baseUrlPath }}';
</script>
<script src="{{ route('frontend.lang.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script>
</body>
</html>
