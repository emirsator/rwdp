<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    @include('includes.head')
</head>

<body>

    @include('includes.simple-header')
    @include('includes.navbar')

    <div id="app" class="container">
        <div class="row">
            <h2 class="col-12 text-center margin-top-0 margin-bottom-0 padding-top-15 padding-bottom-15">
                @yield('title')    
            </h2>
        </div>
        @yield('content')
    </div>

    @include('includes.footer')

    @yield('scripts')
</body>