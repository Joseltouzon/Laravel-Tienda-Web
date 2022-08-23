<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Services\CartService;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('carts.index')->with([
            'cart' => $this->cartService->getFromCookie(),
        ]);
    }

}
