<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $count = [
            'transaction' => Transaction::count(),
            'user' => User::whereNotIn('role',['admin'])->count(),
            'product' => Product::count(),
            'payment' => Payment::count()
        ];
        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'count' => $count
        ]);
    }
}
