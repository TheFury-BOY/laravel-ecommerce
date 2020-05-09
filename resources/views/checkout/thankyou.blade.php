@extends('layouts.app')
@section('title')
Thank You !
@endsection

@section('content')
<div class="col-md-12 text-center">
    <div class="jumbotron">
        <h1>Votre commande à bien été prise en compte, <br><span class="display-3">Merci</span> pour votre confiance.</h1>
        <hr>
        <p class="text-muted">Vous rencontrez un problème ? <a href="#">Nous Contacter</a></p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Retourner à la boutique</a>
    </div>
</div>
@endsection
