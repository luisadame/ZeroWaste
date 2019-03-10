@extends('private.layouts.main')
@section('content')
<div class="container mt-3">
    {{ Breadcrumbs::render('food', $food) }}
    @include('private.partials.alert')
    <h2>@flang('pages.food', true): {{ $food->name }}</h2>
    <div class="d-flex options my-2">
        <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning" tabindex="-1" role="button">
            Edit
        </a>
    </div>
    @can('update', $food)
    <div class="d-flex options my-2">
        <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning" tabindex="-1" role="button">
            Edit
        </a>
        <form action="{{ route('food.destroy', $food->id) }}" class="form-inline" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-link">Delete</button>
        </form>
    </div>
    @endcan
    <div class="container-fluid mt-3 mb-5 p-0">
        <h3>{{ $food->name }}</h3>
    </div>
</div>
@endsection
