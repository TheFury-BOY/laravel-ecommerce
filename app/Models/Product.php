<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Formate le prix des articles pour qu'il soit au format fr
     */
    public function getPrice()
    {
        $price = $this->price / 100;

        return number_format($price, 2, ',', ' ').' €';
    }

    /**
     * Permet la liaison avec la table pivot category_product
     */
    public function categories ()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
