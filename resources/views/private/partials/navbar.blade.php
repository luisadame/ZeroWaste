<nav class="navbar navbar-expand d-flex">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <div class="buttons ml-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-link">Log Out</button>
        </form>
    </div>
</nav>
