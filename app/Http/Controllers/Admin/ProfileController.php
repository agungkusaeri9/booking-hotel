<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $item = User::findOrFail(auth()->id());
        return view('admin.pages.profile.show',[
            'title' => 'Profil Saya',
            'item' => $item
        ]);
    }

    public function update()
    {
        $item = User::findOrFail(auth()->id());
        request()->validate([
            'name' => ['required','string','min:3'],
            'username' => ['required','alpha_dash','min:3',Rule::unique('users','username')->ignore($item->id)],
            'email' => ['required','email',Rule::unique('users','email')->ignore($item->id)],
            'avatar' => ['image','mimes:jpg,jpeg,png'],
            'role' => ['required','in:admin,user']
        ]);

        $data = request()->all();
        if(request()->file('avatar'))
        {
            Storage::disk('public')->delete($item->avatar);
            $data['avatar'] = request()->file('avatar')->store('user','public');
        }else{
            $data['avatar'] = $item->avatar;
        }

        if(request('password'))
        {
            request()->validate([
                'password' => ['min:5']
            ]);
            $data['password'] = bcrypt(request('password'));
        }else{
            $data['password'] = $item->password;
        }
        $item->update($data);

        return redirect()->route('admin.profile.show')->with('success','Profil berhasil disimpan');
    }
}
