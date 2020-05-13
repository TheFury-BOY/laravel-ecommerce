<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($subtotal)
    {
        if ($this->type === 'fixed') {
            return $this->value;
        } else if ($this->type ==='percent') {
            return $subtotal * ($this->percent_off / 100);
        } else {
            return 0;
        };
    }
}
