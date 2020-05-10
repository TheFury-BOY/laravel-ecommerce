@extends('layouts.app')

@section('title')
    Recherche
@endsection

@section('content')
@foreach ($products as $product)
<div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">@foreach ($product->categories as $category)
                {{ $category->name }}
            @endforeach</strong>
            <h4 class="mb-0 font-weight-bold">{{ $product->title }}</h4>
            <p class="card-text mb-auto">{{ $product->subtitle }}</p>
            <strong class="card-text mb-auto display-4 text-muted">{{ $product->getPrice() }}</strong>
            <a href="{{ route('products.show', $product->slug) }}" class="stretched-link btn btn-info font-weight-bold"><i class="fas fa-play"></i> Voir
                l'article</a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <!--<img src="{{ asset('storage/' . $product->image) }}" alt="thumbnail" class="align-middle" style="max-width: 200px;">-->
            <img src="{{ $product->image }}" alt="thumbnail" class="align-middle" style="max-width: 200px;">
        </div>
    </div>
</div>
@endforeach
{{ $products->appends(request()->input())->links() }}
@endsection
