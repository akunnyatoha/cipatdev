<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuangController extends Controller
{
    public function index(){
        $rooms = Room::all();
        return view('dashboardpage.ruangan.index',compact('rooms'));
    }
    public function create(){
        return view('dashboardpage.ruangan.create');
    }
    public function store(Request $request){
        $getRuangan = Room::where('code', $request->code);
        if($getRuangan != null) {
            return redirect()->route('dashboardpage.ruangan.create')->with('error', 'Code ruangan sudah ada!');
        }
        $room = Room::create([
            'code'=>$request->code,
            'name'=>$request->name,
            'floor'=>$request->floor,
            'building'=>$request->building,
            'capacity'=>$request->capacity,
        ]);
        return redirect()->route('dashboardpage.ruangan.index');
    }
    public function edit($id){
        $room = Room::where('id',$id)->first();
        return view('dashboardpage.ruangan.edit',compact('room'));
    }
    public function update(Request $request, $id){
        $getRuangan = Room::where('code', $request->code);
        if($getRuangan != null) {
            return redirect()->back()->with('error', 'Code ruangan sudah ada!');
        }
        Room::where('id',$id)->update([
            'code'=>$request->code,
            'name'=>$request->name,
            'floor'=>$request->floor,
            'building'=>$request->building,
            'capacity'=>$request->capacity,
        ]);
        return redirect()->route('dashboardpage.ruangan.index');
    }
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('dashboardpage.ruangan.index');
    }
}
