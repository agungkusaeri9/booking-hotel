<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::orderBy('name','ASC')->get();
        return view('admin.pages.product.index',[
            'title' => 'Data Produk',
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
        return view('admin.pages.product.create',[
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
            'name' => ['required','unique:products,name'],
            'description' => ['required'],
            'image' => ['required','image','mimes:jpg,jpeg,png']
        ]);

        $data = request()->all();

        $data['slug'] = Str::slug(request('name'));
        $data['image'] = request()->file('image')->store('product','public');
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan');
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
        $item = Product::findOrFail($id);
        return view('admin.pages.product.edit',[
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
            'name' => ['required',Rule::unique('products','name')->ignore($id)],
            'description' => ['required'],
            'image' => ['image','mimes:jpg,jpeg,png']
        ]);

        $data = request()->all();
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug(request('name'));
        if(request()->file('image'))
        {
            Storage::disk('public')->delete($item->image);
            $data['image'] = request()->file('image')->store('product','public');
        }else{
            $data['image'] = $item->image;
        }
        $item->update($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        Storage::disk('public')->delete($item->image);
        $item->delete();

        return redirect()->route('admin.products.index')->with('success','Produk berhasil dihapus');
    }
}
