@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('inventory.edit', $inventory) }}
        <h2>Edit @lang('pages.inventory')</h2>
        <div class="container-fluid grid mt-3 p-0">
        <form action="{{ route('inventories.update', $inventory) }}" method="post">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{ $inventory->name }}">
                    <small id="nameHelp" class="form-text text-muted">This is the name of your inventory</small>
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('inventories.index') }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection
