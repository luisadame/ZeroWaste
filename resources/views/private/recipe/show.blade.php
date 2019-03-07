@extends('private.layouts.main')
@section('content')
<div class="container mt-3">
    {{ Breadcrumbs::render('recipe', $recipe) }}
    @include('private.partials.alert')
    <h2>@flang('pages.recipe', true): {{ $recipe->name }}</h2>
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
    <div class="container-fluid grid mt-3 mb-5 p-0">
        <h3>{{ $recipe->name }}</h3>
        @foreach($recipe->images as $image)
            <img src="{{ $image->url }}" width="100%"/>
        @endforeach
    </div>
</div>
@endsection
