<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Cart,
    Order,
    Product,
};

class CartController extends Controller
{
    public function store(Request $request){
        $totalPrice = 0;
        foreach($request->products as $product) {
            $productPrice = Product::where('id', $product['id'])->value('price');
            $totalPrice += $productPrice * $product['quantity'];
        }
    
        $cart = Cart::create([
            'email' => $request->email,
            'phoneNumber' =>$request->phoneNumber,
            'total_price' => $totalPrice,
            'fullName' => $request->fullName,
            'companyName' => $request->companyName
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
