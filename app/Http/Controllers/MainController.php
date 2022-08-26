<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
       // \DB::connection()->enableQueryLog();
       
       // $products = Product::where('status', 'available')->get(); // sin scope
        $products = Product::all(); // usando scope en el modelo product
        return view('welcome')->with([
            'products' => $products,
        ]);
    }
}
