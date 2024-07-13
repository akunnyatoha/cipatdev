<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        return view("landingpage.profile");
    }
    public function edit(){
        return view("landingpage.editprofile");
    }
    public function pass(){
        return view("landingpage.change-password");
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi form
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        if($request->file('image')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validateData['image'] = $request->file('image')->store('user-images');
            // $nameImage = $request['image']
        }

        // Simpan perubahan
        $updateData = User::where('id', $user->id)->update($validateData);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('landingpage.profile')->with('success', 'Profile updated successfully');
    }
    public function change(Request $request){
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Validasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('landingpage.change-password')->with('hola', 'Current password is incorrect.');
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return redirect()->route('landingpage.profile')->with('success', 'Password updated successfully.');
    }
}
