@extends('layouts.app')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Paiement
@endsection

@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h3 class="text-center display-4">Finalisez votre commande</h3>
            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="my-4">
                @csrf
                <div id="card-element">
                    <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>

                <button class="btn btn-success btn-block mt-3" id="submit">Procéder au paiement ({{ getPrice(Cart::total()) }})</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    var stripe = Stripe('pk_test_bJASiljB7NKZDZ1lMXspckMV00G6UQ322o');
    var elements = stripe.elements();
    var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
    };

    var card = elements.create("card", {
        style: style
    });
    card.mount("#card-element");

    card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert', 'alert-danger');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-danger');
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit');

    form.addEventListener('submit', function (ev) {
        ev.preventDefault();
        submitButton.disabled = true;
        stripe.confirmCardPayment( "{{ $clientSecret }}", {
            payment_method: {
                card: card
            }
        }).then(function (result) {
            if (result.error) {
                // Show error to your customer (e.g., insufficient funds)
                console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var url = form.action;
                    var redirect = '/merci';
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    fetch(
                        url, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Request-with": "XMLHttpRequest",
                                'X-CSRF-TOKEN': token
                            },
                            method: "post",
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })
                        }).then((data) => {
                        console.log(data)
                        window.location.href = redirect
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            }
        });
    });

</script>
@endsection
