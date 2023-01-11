<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $featured_products = Product::where('trending','1')->take(15)->get();
        $trending_categories = Category::where('popular','1')->take(15)->get();
        return view('frontend.index',compact('featured_products','trending_categories'));
    }

    public function category(){
        $category = Category::where('status','0')->get();
        return view('frontend.category',compact('category'));
    }

    public function viewCategory($slug){
        if(Category::where('slug', $slug)->exists()){
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cat_id', $category->id)->get();
            return view('frontend.products.index',compact('category','products'));
        }else{
            return redirect('/')->with('status', "Slug not exists");
        }
    }

    public function viewProduct($cat_slug,$prod_slug){
        if(Category::where('slug', $cat_slug)->exists()){
            if(Product::where('slug', $prod_slug)->exists()){
                $product = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $product->id)->get();
                $ratings_sum = Rating::where('prod_id', $product->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('prod_id', $product->id)->get();
                if($ratings->count() > 0){
                    $rating_value = $ratings_sum/$ratings->count();
                }else{
                    $rating_value = 0;
                }
                return view('frontend.products.viewprod',compact('product', 'ratings', 'rating_value', 'user_rating', 'reviews'));
            }else{
                return redirect('/')->with('status', "The link is not found");
            }
        }else{
            return redirect('/')->with('status', "No such category");
        }
    }

    public function productList(){
        $products = Product::select('name')->where('status','0')->get();
        $data = [];
        foreach($products as $product){
            $data[] = $product['name'];
        }
        return $data;
    }

    public function search(Request $request){
        $searched_product = $request->input('product_name');
        if($searched_product != ''){
            $product = Product::where("name","LIKE","%$searched_product%")->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }else{
                return redirect()->back()->with('status', 'No products matched your search');
            }
        }else{
            return redirect()->back();
        }
    }
}
