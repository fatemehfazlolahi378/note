<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="" type="image/x-icon"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>یادداشت نویسی</title>
    <link href="{{mix('css/desktop/app.css')}}" rel="stylesheet">
</head>
<body class="bg-[#cdd7d6]">
 @include('desktop.auth.login')
 @yield('content')
<script src="{{mix('js/desktop/app.js')}}"></script>
@yield('scripts')
</body>
</html>
<?php
