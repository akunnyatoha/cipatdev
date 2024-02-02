@extends('layoutlanding.main')
@section('landing')
<div class="container">
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                        {{-- cek apakah slider memiliki image --}}
                        @if ($slider->image)
                            <img src="{{ asset('storage/slider/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->image }}">
                        @else
                            <img src="{{ asset('images/default-slider.png') }}" class="d-block w-100" alt="default-image">
                        @endif
                    </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection
