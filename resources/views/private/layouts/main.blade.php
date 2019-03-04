<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main role="main" class="container-fluid pb-5">
      @yield('content')
    </main>

    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
