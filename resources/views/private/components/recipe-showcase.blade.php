<div id="recipe-showcase" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($images); $i++)
            <li data-target="#recipe-showcase" data-slide-to="{{ $i }}" {{ $i === 0 ? 'class="active"' : '' }}></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach ($images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : ''}}">
                <img src="{{ $image->url }}" class="d-block">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#recipe-showcase" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#recipe-showcase" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
