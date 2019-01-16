<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') - {{ env('APP_NAME') }}
        @else
            {{ env('APP_NAME') }}
        @endif
    </title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>

    @include('private.partials.navbar')

    <main role="main" class="container">
      @yield('content')
    </main>

    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
