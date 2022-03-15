<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Payment::orderBy('name','ASC')->get();
        return view('admin.pages.payment.index',[
            'title' => 'Data Metode Pembayaran',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.payment.create',[
            'title' => 'Tambah Produk'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'number' => ['required','numeric'],
            'description' => ['required']
        ]);

        $data = request()->all();
        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success','Metode Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Payment::findOrFail($id);
        return view('admin.pages.payment.edit',[
            'title' => 'Edit Produk',
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'name' => ['required'],
            'description' => ['required'],
            'number' => ['required','numeric']
        ]);

        $data = request()->all();
        $item = Payment::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.payments.index')->with('success','Metode Pembayaran berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Payment::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.products.index')->with('success','Metode Pembayaran berhasil dihapus');
    }
}
