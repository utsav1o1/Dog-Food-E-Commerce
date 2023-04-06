<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\ElseIf_;

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

     function remove(Request $request)
    {

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');

            $product_id = $request->input('id');

            unset($cart[$product_id]);

            $request->session()->put('cart', $cart);
            $this->calculateTotalCart($request);
        }

        return view('cart');
    }


     function edit_quantity(Request $request)
    {

        if ($request->session()->has('cart')) {
            
            $product_id = $request->input('id');
            $product_quantity = $request->input('quantity');

            if ($request->has('decrease_product_quantity_btn')) {
                $product_quantity = $product_quantity - 1;
            } else if ($request->has('increase_product_quantity_btn')) {
                $product_quantity = $product_quantity + 1;
            } else{

            }

            if ($product_quantity <= 0) {
                $this->remove($request);
            }
            $cart = $request->session()->get('cart');
            if (array_key_exists($product_id, $cart)) {
                $cart[$product_id]['quantity'] = $product_quantity;
                $request->session()->put('cart', $cart);
                $this->calculateTotalCart($request);
            }
        }

        return view('cart');
        
    }
}
