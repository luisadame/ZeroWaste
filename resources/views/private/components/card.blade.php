<a href="{{ $route }}" class="text-decoration-none text-body">
    <div class="card inventory">
        <div class="card-body">
            @isset($img)
                {!! $img !!}
            @endisset
            <h2 class="card-title">{{ $title }}</h2>
            @isset($text)
            <p class="card-text">{{ $text }}</p>
            @endisset
        </div>
    </div>
</a>
