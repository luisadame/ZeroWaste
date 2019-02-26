@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('recipes') }}
        <h2>Recipes</h2>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary" tabindex="-1" role="button">
            Create
        </a>
        <div class="container-fluid grid mt-3 p-0">
            @forelse ($recipes as $recipe)
                @component('private.components.card')
                    @slot('route', route('recipes.show', $recipe))
                    @slot('title', $recipe->name)
                @endcomponent
            @empty
                <p>Nothing to show here</p>
            @endforelse
        </div>
    </div>
@endsection
