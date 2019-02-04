@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('inventory', $inventory) }}
        <h2>@flang('pages.inventory', true): {{ $inventory->name }}</h2>
        <div class="d-flex options">
            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning" tabindex="-1" role="button">
                Edit
            </a>
            <form action="{{ route('inventories.destroy', $inventory->id) }}" class="form-inline" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-link">Delete</button>
            </form>
        </div>
        <div class="container-fluid grid mt-3 p-0">
            <h2>ble</h2>
        </div>
    </div>
@endsection
