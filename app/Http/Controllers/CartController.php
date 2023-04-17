<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Cart,
    Order,
};

class CartController extends Controller
{
    public function store(Request $request){
        $cart = Cart::create([
            'email' => $request->email,
            'phoneNumber' =>$request->phoneNumber,
            'total_price' => $request->total_price,
        ]);

        foreach($request->products as $product) {
            Order::create([
                'quantity' => $product['quantity'],
                'product_id' => $product['id'],
                'cart_id' => $cart->id,
            ]);
        }

        $response = [
            'message' => "Order has been accepted"
        ];

        return response($response, 201);
    }

}
