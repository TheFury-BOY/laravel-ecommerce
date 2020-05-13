<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon) {
            return redirect()->back()->withErrors('Le Code du Coupon est invalide.');
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => round($coupon->discount(Cart::subtotal())),
        ]);

        return redirect()->back()->with('success', 'Le coupon a bien été appliqué.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('cart.index')->with('success', 'Le Coupon a bien été supprimé.');
    }
}
