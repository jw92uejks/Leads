<?php

namespace App\Http\Controllers;

use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = CartItem::where('broker_id', auth()->user()->broker->id)->get();
        return view('pclient.cart.index', compact('cart'));
    }
}
