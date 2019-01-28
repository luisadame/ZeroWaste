<a href="{{ route($route) }}" class="text-decoration-none text-body">
    <div class="card inventory">
        <div class="card-body">
            @isset($img)
                {!! $img !!}
            @endisset
            <h2 class="card-title">{{ $title }}</h2>
            <p class="card-text">{{ $text }}</p>
        </div>
    </div>
</a>
