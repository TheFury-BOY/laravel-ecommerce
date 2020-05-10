@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach (Auth()->user()->orders as $order)
                        <div class="card">
                            <div class="card-header">
                                Commande du {{ Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y à H:i') }} pour un montant de <strong>{{ getPrice($order->amount) }}</strong>
                            </div>
                            <div class="card-body">
                                <h4>Liste des produits</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Prix HT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (unserialize($order->products) as $product)
                                        <tr>
                                            <td>{{ $product[0]}}</td>
                                            <td>{{ $product[2] }}</td>
                                            <td>{{ getPrice($product[1]) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
