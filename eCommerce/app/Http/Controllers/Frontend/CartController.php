<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){
            $product_check = Product::where('id',$product_id)->first();
            if($product_check){
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(["status" => $product_check->name." Already added to cart"]);
                }else{
                    $cart = new Cart();
                    $cart->user_id = Auth::id();
                    $cart->prod_id = $product_id;
                    $cart->prod_qty = $product_qty;
                    $cart->save();
                    return response()->json(["status" => $product_check->name." Added to cart"]);
                }
            }
        }else{
            return response()->json(["status" => "Login to continue shopping"]);
        }
    }

    public function viewCart(){
        $cartData = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart',compact('cartData'));
    }

    public function deleteItem(Request $request){
        if(Auth::check()){
            $product_id = $request->input('prod_id');
            if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $cart->delete();
                return response()->json(["status" => "Product removed successfully"]);
            }
        }else{
            return response()->json(["status" => "Login to continue shopping"]);
        }
    }

    public function updateCart(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if(Auth::check()){
            if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(["status" => "Quantity updated successfully"]);
            }
        }
    }

    public function cartCount(){
        $cartCount = Cart::where('user_id',Auth::id())->count();
        return response()->json(["count" => $cartCount]);
    }
}
