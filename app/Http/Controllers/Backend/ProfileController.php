<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    //admin Profile
    public function profile()
    {
        return view('Admin.Profile.index');
    }

    //Update Profile Image && email
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            // 'image' => ['required','max:2048'],
        ]);

        //Chack Image Has OR Not---

        $user = Auth::user();


//Jode Update data and User Model Data Same hola Update hoba na errr deba
        if ($request->name === $user->name && $request->email === $user->email && !$request->hasFile('image')) {
            toastr()->error('No changes were made.');
            return redirect()->back();
        }
    

        if ($request->hasFile('image')) {
    //Jode Request Image Thka Then validation hoba---
            $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);

            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $path = "/uploads/" . $imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;

       
        $user->save();
        toastr()->success('Prfofile Update Successfully!');
        return redirect()->back();
    }

    //update Password 

    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Prfofile Password Update Successfully!');
        return redirect()->back();
    }
}
