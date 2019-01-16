@extends('private.layouts.main')
@section('title', 'Food')
@section('content')
<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
    <ul>
        @foreach($foods as $food)
            <li>{{ $food->name }}</li>
        @endforeach
    </ul>
</div>
@endsection
