@extends('private.layouts.main')
@section('content')
    <div class="container mt-3">
        {{ Breadcrumbs::render('food.create', $inventory) }}
        <h2>Create @lang('pages.food')</h2>
        <div class="container-fluid grid mt-3 p-0">
        <form action="{{ route('food.store') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name">
                    <small id="nameHelp" class="form-text text-muted">This is the name of the food</small>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration date</label>
                    <input type="date" class="form-control {{ $errors->has('expiration_date') ? 'is-invalid' : '' }}" id="expiration_date" name="expiration_date" aria-describedby="expirationDateHelp">
                    <small id="expirationDateHelp" class="form-text text-muted">This is the expiration date of the food</small>
                    @if($errors->has('expiration_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('expiration_date') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection
