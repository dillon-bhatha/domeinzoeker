<?php

namespace App\Http\Controllers;

class OrderController extends \Illuminate\Routing\Controller
{
    public function view() {

//        Haal alle bestellingen op uit de database
        $orders = [];
        return view("orders")->with([
            "orders" => $orders
        ]);
    }
}
