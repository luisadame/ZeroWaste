<nav class="navbar navbar-expand d-flex">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <div class="buttons ml-auto">
        <a href="{{ route('login') }}" class="btn btn-link">Log In</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
    </div>
</nav>
