@extends('layouts.app')
@section('content')
<main class="container">
    <div class="container d-flex align-items-center justify-content-center" style="height:100vh">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to Zero Waste!</h1>
            <p class="lead">Let Zero Waste plan your diet's week based on the food's expiry dates to decrease the wasted food and save you money!</p>
            <hr class="my-4">
            <p>Sign up and start using the awesome features Zero Waste provides you</p>
            <a href="{{ route('register') }}" class="btn btn-primary">@lang('auth.signup')</a>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-3 invisible-md">
            <nav id="features" class="navbar navbar-light bg-light">
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#inventory">Inventory</a>
                    <a class="nav-link" href="#recipes">Recipes</a>
                </nav>
            </nav>
        </div>
        <div class="col-12 col-lg-9">
            <div data-spy="scroll" data-target="#features" data-offset="0">
                <div class="mb-5">
                    <h2 style="font-size: 3rem" id="inventory">Inventory</h2>
                    <p style="font-size: 2rem">
                        This feature provides user a way to create multiple inventories where they can save items, each item has an expiry date and more information they can set. This way users will have a way to know what items are about to expire and use them before others which will last longer.
                    </p>
                    <img class="w-100" src="/features/inventory.gif">
                </div>
                <div class="mb-5 pt-5">
                    <h2 style="font-size: 3rem" id="recipes">Recipes</h2>
                    <p style="font-size: 2rem">
                        Recipes allow users to share recipes, this way the system can provide suggestions to the users on what recipes should they prepare in order to waste the less amount of food based on their inventories. This way the user gets a regard for saving all his information about their items.
                    </p>
                    <img class="w-100" src="/features/recipe.gif">
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
<script src="{{ mix('/js/app.js') }}" defer></script>
@endpush
@endsection
