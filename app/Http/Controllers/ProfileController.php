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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // sesuaikan dengan kebutuhan
        ]);

        // Update data profil
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Proses upload gambar ke direktori 'public/user'
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/user', $image, $imageName);

            // Simpan nama file gambar ke dalam kolom 'image' pada tabel users
            $user->image = $imageName;
        }

        // Simpan perubahan
        $user->save();

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
