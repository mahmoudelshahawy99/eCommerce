<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        $orders = Order::count();
        $completedOrders = Order::where('status','1')->count();
        $pendingOrders = Order::where('status','0')->count();
        return view('admin.index', compact('categories','products','users','orders','completedOrders','pendingOrders'));
    }
}
