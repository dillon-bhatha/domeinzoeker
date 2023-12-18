<?php

namespace App\Http\Controllers;

class CartController extends \Illuminate\Routing\Controller
{
    public function view() {

//        Haal alle producten op uit de winkel wagen
        $cartItems = [];
        return view("cart")->with([
            "cartItems" => $cartItems
        ]);
    }
}
