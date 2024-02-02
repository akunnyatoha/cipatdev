<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('dashboardpage.user.index', compact('users'));
    }
    public function create(){
        $roles = Role::all();
        return view('dashboardpage.user.create', compact('roles'));
    }
    public function store(Request $request){
        // ubah nama file
        $imageName = time() . '.' . $request->image->extension();

        // simpan file ke folder public/product
        Storage::putFileAs('public/user', $request->image, $imageName);
        $user = User::create([
            'id' => $request->noinduk,
            'role_id' => $request->role,
            'name' => $request->name,
            'image' => $imageName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboardpage.user.index');
    }
    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('dashboardpage.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id){
        if ($request->hasFile('image')) {
            $old_image = User::find($id)->image;
            Storage::delete('public/user/'.$old_image);
            $imageName = time().'.'.$request->image->extension();
            Storage::putFileAs('public/user', $request->file('image'), $imageName);
            User::where('id', $id)->update([
                'id' => $request->noinduk,
                'name' => $request->name,
                'image' => $imageName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        }
        else {
            User::where('id', $id)->update([
                'id' => $request->noinduk,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }
        return redirect()->route('dashboardpage.user.index');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboardpage.user.index');
    }
}
