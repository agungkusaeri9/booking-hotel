<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::with('price')->latest()->get();
        return view('user.pages.home',[
            'title' => 'Selamat datang di hotel kami',
            'products' => $products
        ]);
    }
}
