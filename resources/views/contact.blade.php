@extends('layouts.app')
@section('content')
<main id="contact" class="container d-flex justify-content-center align-items-center flex-grow-1 flex-column">
    <h2>Contact</h2>
    <contact-form></contact-form>
</main>
@push('scripts')
<script src="{{ mix('/js/app.js') }}" defer></script>
@endpush
@push('style')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@endpush
@endsection
