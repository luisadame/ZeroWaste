@extends('layouts.app')
@section('content')
<main class="container d-flex justify-content-center align-items-center flex-grow-1">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Zero Waste!</h1>
        <p class="lead">Let Zero Waste plan your diet's week based on the food's expiry dates to decrease the wasted food and save you money!</p>
        <hr class="my-4">
        <p>Sign up and start using the awesome features Zero Waste provides you</p>
        <a href="{{ route('register') }}" class="btn btn-primary">@lang('auth.signup')</a>
    </div>
</main>
@endsection
