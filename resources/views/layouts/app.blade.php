<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/Style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/Ad_Style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/Responsive.css') }}"> 
</head>
<body class="@yield('body-class', 'default-body')"> <!-- Set body class from content or default-body -->

    @yield('content') 

    @yield('scripts')
</body>
</html>
   