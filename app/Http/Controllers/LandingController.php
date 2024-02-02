<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\Room;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    private $startDatetime;
    private $endDatetime;
    public function index(){
        return view("landing");
    }
    public function denah(){
        $sliders = Slider::all();
        return view("landingpage.denah", compact('sliders'));
    }
    public function kontak(){
        return view("landingpage.kontak");
    }
    public function histori(){
        $userEmail = Auth::user()->email;
        $peminjamans = Peminjaman::with('rooms')
            ->where('email', $userEmail)
            ->get();

        return view("landingpage.histori", compact('peminjamans'));
    }
    public function peminjaman(){
        $peminjamans=Peminjaman::all();
        $rooms= Room::all();
        return view("landingpage.peminjaman",compact('peminjamans','rooms'));
    }
    public function showAvailableRooms(Request $request)
    {
        $request->validate([
            'tanggalawal' => 'required|date_format:Y-m-d\TH:i',
            'tanggalakhir' => 'required|date_format:Y-m-d\TH:i|after:tanggalawal',
        ]);

        $startDatetime = Carbon::parse($request->input('tanggalawal'));
        $endDatetime = Carbon::parse($request->input('tanggalakhir'));

        $availableRooms = Peminjaman::getAvailableRooms($startDatetime, $endDatetime);

        return view('landingpage.peminjaman', compact('availableRooms', 'startDatetime', 'endDatetime'));
    }
    public function store(Request $request){
        $userRole = auth()->user()->role->name;
        $status = ($userRole === 'admin' || $userRole === 'staff') ? 'accepted' : 'pending';

            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            $peminjaman = Peminjaman::create([
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'room_id' => $request->room,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'capacity' => $request->capacity,
                'status' => $status,
                'created_by' => Auth::id(),
            ]);
        return redirect()->route('landingpage.histori')->with('success', 'Peminjaman telah berhasil terkirim');
    }
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        return redirect()->route('landingpage.histori');
    }
    public function login(){
        return view("landingpage.login");
    }
    public function register(){
        return view("landingpage.register");
    }
    public function tes(){
        return view("landingpage.test");
    }
}
