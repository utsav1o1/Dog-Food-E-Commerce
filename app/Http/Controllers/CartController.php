<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {

        return view('cart');
    }

    public function add_to_cart(Request $request)
    {
        //if we have cart in session 
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');

            $product_array_ids = array_column($cart, 'id'); //[32,98,45]

            $id = $request->input('id');
            // add product to cart 
            if (!in_array($id, $product_array_ids)) {
                $name = $request->input('name');
                $image = $request->input('image');
                $price = $request->input('price');
                $quantity = $request->input('quantity');
                $sale_price = $request->input('sale_price');

                if ($sale_price != null) {
                    $price_to_charge = $sale_price;
                } else {
                    $price_to_charge = $price;
                }

                //if both id are not similar we add the item detail in a product array
                $product_array = array(

                    'id' => $id,
                    'name' => $name,
                    'image' => $image,
                    'quantity' => $quantity,
                    'price' => $price_to_charge

                );
                //Saving the detail item array in cart id 
                //where id is of item sent through form  
                $cart[$id] = $product_array;
                $request->session()->put('cart', $cart);
            }
            //product is already in cart
            else {
                echo "<script>alert('product is already in cart')</script>";
                // $quantity=$request->session()->get('quantity');

            }
            $this->calculateTotalCart($request);
            return view('cart');
        }

        //if we do not have a cart in a session
        else {
            $cart = array();
            $id = $request->input('id');
            $name = $request->input('name');
            $image = $request->input('image');
            $price = $request->input('price');
            $quantity = $request->input('quantity');
            $sale_price = $request->input('sale_price');

            if ($sale_price != null) {
                $price_to_charge = $sale_price;
            } else {
                $price_to_charge = $price;
            }

            $product_array = array(

                'id' => $id,
                'name' => $name,
                'image' => $image,
                'quantity' => $quantity,
                'price' => $price_to_charge

            );

            $cart[$id] = $product_array;
            $request->session()->put('cart', $cart);

            $this->calculateTotalCart($request);
            return view('cart');
        }
    }


    function calculateTotalCart(Request $request)
    {
        $cart = $request->session()->get('cart');
        $total_price = 0;
        $total_quantity = 0;

        foreach ($cart as $id => $product) {
            $product = $cart[$id];
            $quantity = $product['quantity'];
            $price = $product['price'];

            $total_price = $total_price + ($price * $quantity);
            $total_quantity = $total_quantity + $quantity;
        }

        $request->session()->put('total', $total_price);
        $request->session()->put('quantity', $total_quantity);
    }

    public function remove(Request $request){

        $id = $request->input('id');
        $request->session()->forget('id',$id);

    }
}
