@extends('layouts.app')

@section('title')
{{ $product->title }}
@endsection

@section('content')

<div class="row no-gutters border rounded flex-md-row mb-4 shadow-sm position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">
            <div class="badge badge-pill badge-info">{{ $stock }}</div>
            @include('partials.categories')
        </strong>
        <h3 class="mb-3">{{ $product->title }}</h3>
        <span class="card-text mb-auto">{!! $product->description !!}</span>
        <strong class="card-text mb-2 display-4 text-muted">{{ $product->getPrice() }}</strong>
        @if ($stock === "Disponible")
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-info"><i class="fas fa-plus"></i> Ajouter au panier</button>
        </form>
        @endif
    </div>
    <div class="col-auto d-none d-lg-block">
        <img src="{{ $product->image }}" alt="thumbnail" id="main-image" width="200">
        <div class="mt-2">
            @if ($product->images)
            <img src="{{ $product->image }}" alt="thumbnail" width="50" class="img-thumbnail">
            @foreach (json_decode($product->images, true) as $image)
            <img src="{{ asset('storage/' . $image) }}" width="50" alt="thumbnail" class="img-thumbnail">
            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@section('extra-js')
<script>
    var mainImage = document.querySelector('#main-image');
    var thumbnails = document.querySelectorAll('.img-thumbnail');

    thumbnails.forEach((element) => element.addEventListener('click', changeImage));

    function changeImage(e) {
        mainImage.src = this.src;
    }

</script>
@endsection
