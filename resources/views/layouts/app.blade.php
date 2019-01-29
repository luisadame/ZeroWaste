<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <link rel="stylesheet" href="{{ mix('/css/landing.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    <header>
        <div class="container-fluid p-0">
            @include('partials.navbar')
        </div>
    </header>
    @yield('content')
    @stack('scripts')
</body>
</html>
