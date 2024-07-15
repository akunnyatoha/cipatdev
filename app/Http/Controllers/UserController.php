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
        $users = User::get();
        return view('dashboardpage.user.index', compact('users'));
    }
    public function create(){
        $roles = Role::all();
        return view('dashboardpage.user.create', compact('roles'));
    }
    public function store(Request $request){
        $validateImg = $request->validate([
            "image" => 'image|file|max:2048'
        ]);
        if($request->file('image')) {
            $validateImg['image'] = $request->file('image')->store('user-images');
            $user = User::create([
                'id' => $request->noinduk,
                'role_id' => $request->role,
                'name' => $request->name,
                'image' => $validateImg['image'],
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'id' => $request->noinduk,
                'role_id' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('dashboardpage.user.index');
    }
    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('dashboardpage.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id){
        $validateImage = $request->validate([
            "image" => 'image|file|max:2048'
        ]);
        // dd($validateImage);

        if($request->file('image')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validateImage['image'] = $request->file('image')->store('user-images');
            // $nameImage = $request['image']
        }

        
        User::where('id', $id)->update([
            'id' => $request->noinduk,
            'name' => $request->name,
            'image' => $validateImage['image'],
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('dashboardpage.user.index');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->image) {
            Storage::delete($user->image);
        }
        $user->delete();
        return redirect()->route('dashboardpage.user.index');
    }
}
