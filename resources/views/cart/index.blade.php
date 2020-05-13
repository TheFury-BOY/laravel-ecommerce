@extends('layouts.app')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Panier
@endsection

@section('content')
<div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container">
            @if (Cart::count() > 0)
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ $product->model->image }}" alt="" width="70"
                                                class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> <a href="#"
                                                        class="text-dark d-inline-block align-middle">{{ $product->model->title }}</a>
                                                </h5><span
                                                    class="text-muted font-weight-normal font-italic d-block">Category:
                                                </span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>{{ getPrice($product->subtotal()) }}</strong></td>
                                    <td class="border-0 align-middle">
                                        <select name="qty" id="qty" data-id="{{ $product->rowId }}"
                                            data-stock="{{ $product->model->stock }}" class="custom-select">
                                            @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}"
                                                {{ $i == $product->qty ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                        </select></td>
                                    <td class="border-0 align-middle">
                                        <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded border-0 bg-danger text-light"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>

            <div class="row py-5 p-4 bg-white rounded shadow-sm">
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon</div>
                    <div class="p-4">
                        @if (!request()->session()->has('coupon'))
                        <p class="font-italic mb-4">Si vous avez un Coupon, entrez votre code ci-dessous</p>
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="input-group mb-4 border rounded-pill p-2">
                                <input type="text" placeholder="Entrez le Code ici" aria-describedby="button-addon3"
                                    class="form-control border-0" name="coupon_code" id="coupon_code">
                                <div class="input-group-append border-0">
                                    <button id="button-addon3" type="submit" class="btn btn-dark px-4 rounded-pill"><i
                                            class="fa fa-gift mr-2"></i>Appliquer le Coupon</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <p class="font-italic mb-4">Votre Coupon à bien été pris en compte.</p>
                        @endif

                    </div>
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le
                        vendeur
                    </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Si vous souhaitez ajouter des précisions concernant votre commande,
                            merci de les rentrer dans le champ ci-dessous</p>
                        <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Les frais d'envoi et surcoûts additionnels sont calculés en fonction
                            de
                            votre commande.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Sous-total
                                </strong><strong>{{ getPrice(Cart::subtotal()) }}</strong>
                            </li>
                            @if (request()->session()->has('coupon'))
                            <li class="d-flex justify-content-between py-3 border-bottom border-dark"><strong
                                    class="text-muted">Coupon
                                    {{ session()->get('coupon')['code'] }}</strong>
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-times"></i>
                                        Supprimer</button>
                                </form>
                                <strong>- {{ getPrice($discount) }}</strong>
                            </li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                class="text-muted">Nouveau Sous-total
                            </strong><strong>{{ getPrice($newSubtotal) }}</strong>
                        </li>
                            @endif
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Taxes</strong><strong>{{ getPrice($newTax) }}</strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Total</strong>
                                <h5 class="font-weight-bold">{{ getPrice($newTotal) }}</h5>
                            </li>
                        </ul><a href="{{ route('checkout.index') }}"
                            class="btn btn-dark rounded-pill py-2 btn-block">Passer
                            au paiement</a>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <p>Votre Panier est vide.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    var selects = document.querySelectorAll('#qty');

    Array.from(selects).forEach((element) => {
        element.addEventListener('change', function () {
            var rowId = element.getAttribute('data-id');
            var stock = element.getAttribute('data-stock');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(
                `/panier/${rowId}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Request-with": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'patch',
                    body: JSON.stringify({
                        'qty': this.value,
                        'stock': stock
                    })
                }
            ).then((data) => {
                console.log(data);
                //revient sur la page
                location.reload();
            }).catch((error) => {
                console.log(error)
            })
        });
    });

</script>
@endsection
