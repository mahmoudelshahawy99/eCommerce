<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request){

        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->where('status', '0')->first();

        if($product_check){
            $verfied_purchase = Order::where('orders.user_id', Auth::id())
            ->join('order_items', 'orders.id', 'order_items.order_id')
            ->where('order_items.prod_id', $product_id)->get();
            if($verfied_purchase->count() > 0){
                $existingRate = Rating::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
                if($existingRate->count() > 0){
                    $existingRate = Rating::find($existingRate->id);
                    $existingRate->stars_rated = $stars_rated;
                    $existingRate->update();
                }else{
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id,
                        'stars_rated' => $stars_rated
                    ]);
                }
                return redirect()->back()->with('status', 'Thanks for rating this product');
            }else{
                return redirect()->back()->with('status', 'You can not rate a product without purchase');
            }
        }else{
            return redirect()->back()->with('status', 'The link was broken');
        }
    }
}
