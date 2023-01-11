<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function addProd(Request $request){

        if(Auth::check()){
            $product_id = $request->input('product_id');
            if(Product::find($product_id)){
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::id();
                $wishlist->prod_id = $product_id;
                $wishlist->save();
                return response()->json(["status" => "Product Added to Wishlist"]);
            }else{
                return response()->json(["status" => "Product does not exist"]);
            }
        }else{
            return response()->json(["status" => "Login to continue shopping"]);
        }
    }

    public function deleteProd(Request $request){
        if(Auth::check()){
            $product_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                $wishlist = Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $wishlist->delete();
                return response()->json(["status" => "Product removed successfully"]);
            }
        }else{
            return response()->json(["status" => "Login to continue shopping"]);
        }
    }

    public function wishlistCount(){
        $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(["count" => $wishlistCount]);
    }
}
