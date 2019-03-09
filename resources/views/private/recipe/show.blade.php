@extends('private.layouts.main')
@section('content')
<div class="container mt-3">
    {{ Breadcrumbs::render('recipe', $recipe) }}
    @include('private.partials.alert')
    <h2>@flang('pages.recipe', true): {{ $recipe->name }}</h2>
    @can('update', $recipe)
        <div class="d-flex options my-2">
            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning" tabindex="-1" role="button">
                Edit
            </a>
            <form action="{{ route('recipes.destroy', $recipe->id) }}" class="form-inline" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-link">Delete</button>
            </form>
        </div>
    @endcan
    <div class="container-fluid mt-3 mb-5 p-0">
        <h3>{{ $recipe->name }}</h3>
        <h4>Cooking time: {{ $recipe->time() }}</h4>
        <h4>
            Suitable for:
            @foreach($recipe->types as $type)
                <div class="badge badge-pill badge-dark">
                    {{ $type->value }}
                </div>
            @endforeach
        </h4>
        @if($recipe->images->isNotEmpty())
            @component('private.components.recipe-showcase', ['images' => $recipe->images]) @endcomponent
        @endif
        <p>Origin: {{ __("countries.{$recipe->country_code}") }}</p>
        <div class="content">
            {{ $recipe->content }}
        </div>
    </div>
</div>
@endsection
