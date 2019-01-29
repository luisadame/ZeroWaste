@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('inventory', $inventory) }}
        <h2>@flang('pages.inventory', true): {{ $inventory->name }}</h2>
        <div class="container-fluid grid mt-3 p-0">
            <h2>ble</h2>
        </div>
    </div>
@endsection
