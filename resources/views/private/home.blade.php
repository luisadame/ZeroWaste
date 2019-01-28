@extends('private.layouts.main')

@section('content')
<div class="container-fluid p-3">
    <h2>Dashboard</h2>
    <div class="grid">
        @component('private.components.card')
            @slot('route', 'inventory.index')
            @slot('title', 'Inventory')
            @slot('text', 'This is the example text of the Inventory...')
        @endcomponent
    </div>
</div>
@endsection
