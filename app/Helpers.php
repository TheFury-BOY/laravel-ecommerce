<?php

function getPrice($priceInDecimals)
{
    //conversion en float sinon erreur format_num
    $price = floatval($priceInDecimals) /100;

    return number_format($price, 2, ',', ' ').' €';

}
