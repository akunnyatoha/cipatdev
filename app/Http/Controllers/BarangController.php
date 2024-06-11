<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index(){
        $barangs = Barang::all();
        return view('dashboardpage.barang.index',compact('barangs'));
    }
    public function create(){
        return view('dashboardpage.barang.create');
    }
    public function store(Request $request){
        $room = Barang::create([
            'id'=>$request->code,
            'name'=>$request->name,
            'quantity'=>$request->quantity,
        ]);
        return redirect()->route('dashboardpage.barang.index');
    }
    public function edit($id){
        $barang = Barang::where('id',$id)->first();
        return view('dashboardpage.barang.edit',compact('barang'));
    }
    public function update(Request $request, $id){
        Barang::where('id',$id)->update([
            'id'=>$request->code,
            'name'=>$request->name,
            'quantity'=>$request->quantity,
        ]);
        return redirect()->route('dashboardpage.barang.index');
    }
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('dashboardpage.barang.index');
    }
}
