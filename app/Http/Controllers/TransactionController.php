<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $items  = Transaction::with('payment','product')->latest()->get();
        return view('user.pages.transaction.index',[
            'title' => 'History Transaksi',
            'items' => $items
        ]);
    }

    public function success($uuid)
    {
        $item = Transaction::where('uuid',$uuid)->first();
        if(!$item)
        {
            return redirect()->route('home');
        }
        if($item->is_confirmed == 1)
        {
            return redirect()->route('home');
        }

        return view('user.pages.transaction.success',[
            'title' => 'Konfirmasi Pembayaran',
            'item' => $item
        ]);
    }

    public function confirm($id)
    {
        $item = Transaction::findOrFail($id);

        $item->update([
            'is_confirmed' => 1
        ]);

        return redirect()->route('transaction.index')->with('success','Anda berhasil melakukan konfirmasi pembayaran. Silahkan tunggu admin untuk memverifikasi');

    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'product_id' => ['required'],
            'nik' => ['required','digits:16'],
            'gender' => ['required'],
            'duration' => ['required'],
            'payment_id' => ['required'],
            'date' => ['required']
        ]);

        $latest =Transaction::latest()->first();
        if($latest)
        {
            $uuid = 'TRX' . str_pad($latest->id + 1,5,"0", STR_PAD_LEFT);
        }else{
            $uuid = 'TRX' . str_pad(1,5,"0", STR_PAD_LEFT);
        }
        // dd(request()->all());
        $product = Product::findOrFail(request('product_id'));
        $transaction_total = $product->price->price * request('duration');

        if(request('duration') > 3)
        {
            $discount = $transaction_total * 10/100;
            $transaction_total = $transaction_total - $discount;
        }
        if(request('is_breakfast'))
        {
            $transaction_total = $transaction_total + 80000;
        }
        
        $transaction = Transaction::create([
            'uuid' => $uuid,
            'product_id' => request('product_id'),
            'name' => request('name'),
            'nik' => request('nik'),
            'gender' => request('gender'),
            'duration' => request('duration'),
            'payment_id' => request('payment_id'),
            'transaction_total' => $transaction_total,
            'proof' => 'Tidak Ada',
            'date' => request('date'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('transaction.success',$transaction->uuid);
    }
}
