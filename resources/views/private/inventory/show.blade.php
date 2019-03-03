@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('inventory', $inventory) }}
        <h2>@flang('pages.inventory', true): {{ $inventory->name }}</h2>
        <div class="d-flex options my-2">
            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning" tabindex="-1" role="button">
                Edit
            </a>
            <form action="{{ route('inventories.destroy', $inventory->id) }}" class="form-inline" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-link">Delete</button>
            </form>
        </div>
        <h3>Your food items</h3>
        @include('private.partials.alert')
        <div class="container-fluid grid mt-3 mb-5 p-0">
            @forelse($foodCollection as $food)
                @component(
                    'private.components.food',
                    [
                        'classes' => [$food->expirationProximity()],
                        'food' => $food
                    ]
                )
                    @slot('route', '')
                    @slot('title', $food->name)
                    @slot('text', $food->expirationString())
                @endcomponent
            @empty
                <p>__('empty.no_food_yet')</p>
            @endforelse
        </div>
        @if($foodCollection->isNotEmpty())
            {{ $foodCollection->links() }}
        @endif
    </div>
@endsection
