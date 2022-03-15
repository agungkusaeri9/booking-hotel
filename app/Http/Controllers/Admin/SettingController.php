<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item =Setting::first();
        return view('admin.pages.setting.show',[
            'title' => 'Pengaturan Situs',
            'item' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'address' => ['required'],
            'description' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required'],
            'logo' => ['image','mimes:jpeg,jpg,png'],
        ]);

        $item =Setting::first();
        $data = request()->all();
        if($item)
        {   
            if(request()->file('logo'))
            {
                Storage::disk('public')->delete($item->logo);
                $data['logo'] = request()->file('logo')->store('setting','public');
            }else{
                $data['logo'] = $item->logo;
            }
            $item->update($data);
        }else{
            $data['logo'] = request()->file('logo')->store('setting','public');
            Setting::create($data);
        }
        return redirect()->route('admin.setting.index')->with('success','Pengaturan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
