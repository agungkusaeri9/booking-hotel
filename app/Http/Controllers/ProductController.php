<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $item = Product::where('slug',$slug)->first();
        if(!$item)
        {
            return redirect()->route('home');
        }
        $payments = Payment::orderBy('name','ASC')->get();
        return view('user.pages.product.show',[
            'title' => $item->name,
            'item' => $item,
            'payments' => $payments
        ]);
    }
}
