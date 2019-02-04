@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('inventories') }}
        <h2>Inventories</h2>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary" tabindex="-1" role="button">
            Create
        </a>
        <div class="container-fluid grid mt-3 p-0">
            @forelse ($inventories as $inventory)
                @component('private.components.card')
                    @slot('route', route('inventories.show', $inventory))
                    @slot('title', $inventory->name)
                @endcomponent
            @empty
                <p>Nothing to show here</p>
            @endforelse
        </div>
    </div>
@endsection
