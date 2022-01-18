

<div id="slider-{{$id}}" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        @foreach($images as $key => $image)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{$image->path}}" alt="image" style="width: -webkit-fill-available; margin-bottom: 1.5em; border-radius: 10px">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slider-{{$id}}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider-{{$id}}" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
