<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ProductPrice::with('product')->orderBy('product_id','ASC')->get();
        return view('admin.pages.product-price.index',[
            'title' => 'Data Harga Produk',
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
        $products = Product::orderBy('name','ASC')->get();
        return view('admin.pages.product-price.create',[
            'title' => 'Tambah Harga Produk',
            'products' => $products
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
            'product_id' => ['required','unique:product_prices,product_id'],
            'price' => ['required'],
        ]);

        $data = request()->all();

        ProductPrice::create($data);

        return redirect()->route('admin.product-prices.index')->with('success','Harga Produk berhasil ditambahkan');
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
        $item = ProductPrice::findOrFail($id);
        return view('admin.pages.product-price.edit',[
            'title' => 'Edit Harga Produk',
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
            'price' => ['required']
        ]);

        $data = request()->all();
        $item = ProductPrice::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.product-prices.index')->with('success','Harga Produk berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductPrice::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.product-prices.index')->with('success','Harga Produk berhasil dihapus');
    }
}
