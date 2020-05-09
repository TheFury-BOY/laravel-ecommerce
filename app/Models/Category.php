<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * Permet la liaison avec la table pivot category_product
     */
    public function products ()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
