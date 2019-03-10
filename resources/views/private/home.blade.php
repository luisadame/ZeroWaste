@extends('private.layouts.main')

@section('content')
<div class="container-fluid p-3 p-sm-1">
    <h2>Dashboard</h2>
    <div class="grid">
        @component('private.components.card')
            @slot('route', route('inventories.index'))
            @slot('title', 'Inventories')
            @slot('text', 'Manage the edible items you got.')
        @endcomponent
        @component('private.components.card')
            @slot('route', route('recipes.index'))
            @slot('title', 'Recipes')
            @slot('text', 'See the recipes people share and add them to your wish diet.')
        @endcomponent
    </div>
</div>
@endsection
