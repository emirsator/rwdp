<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    @include('includes.head')
</head>

<body>

    @include('includes.simple-header')

    <div id="app" class="container">
        @yield('content')
    </div>

    @include('includes.footer')

    @yield('scripts')
</body>