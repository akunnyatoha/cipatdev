<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use App\Models\Barang;
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
        $peminjamans = [];
        $userEmail = Auth::user()->email;
        $peminjamanruangans = Peminjaman::with('rooms')
            ->where('email', $userEmail)
        ->get();
        $peminjamanbarangs = PeminjamanBarang::with('barangs')
            ->where('email', $userEmail)
        ->get();

        foreach ($peminjamanruangans as $i) {
            $i->kategori = "Ruangan";
            $i->name = $i->rooms->name;
            array_push($peminjamans, $i);
        }
        foreach ($peminjamanbarangs as $j) {
            $j->kategori = "Barang";
            $j->name = $j->barangs->name;
            array_push($peminjamans, $j);
        }
        // dd($peminjamans);
        return view("landingpage.histori", compact('peminjamans'));
    }
    public function peminjaman(){
        $peminjamans=Peminjaman::all();
        $rooms= Room::all();
        return view("landingpage.peminjaman",compact('peminjamans','rooms'));
    }
    public function peminjamanBarang(){
        $peminjamans=PeminjamanBarang::all();
        $barangs= Barang::all();
        return view("landingpage.peminjamanbarang",compact('peminjamans','barangs'));
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
    public function showAvailableBarangs(Request $request)
    {
        $request->validate([
            'tanggalawal' => 'required|date_format:Y-m-d\TH:i',
            'tanggalakhir' => 'required|date_format:Y-m-d\TH:i|after:tanggalawal',
        ]);

        $startDatetime = Carbon::parse($request->input('tanggalawal'));
        $endDatetime = Carbon::parse($request->input('tanggalakhir'));

        $availableBarangs = PeminjamanBarang::getAvailableBarangs($startDatetime, $endDatetime);

        return view('landingpage.peminjamanbarang', compact('availableBarangs', 'startDatetime', 'endDatetime'));
    }
    public function store(Request $request){
        $userRole = auth()->user()->role->name;
        $status = ($userRole === 'admin' || $userRole === 'staff') ? 'accepted' : 'pending';

            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            if($request->barang) {
                $getQuantityBarang = Barang::where('id', $request->barang)->first();
                $sisaQuantity = intval($getQuantityBarang->quantity) - intval($request->quantity);

                $peminjaman = PeminjamanBarang::create([
                    'email' => $email,
                    'name' => $name,
                    'phone' => $phone,
                    'barang_id' => $request->barang,
                    'description' => $request->description,
                    'start_datetime' => $request->tanggalawal,
                    'end_datetime' => $request->tanggalakhir,
                    'quantity' => $request->quantity,
                    'status' => $status,
                    'created_by' => Auth::id(),
                ]);

                $updateQtyBarang = Barang::where('id', $request->barang)->update(['quantity' => $sisaQuantity]);
                // dd($updateQtyBarang);
            } else {
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
            }
        return redirect()->route('landingpage.histori')->with('success', 'Peminjaman telah berhasil terkirim');
    }
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if($peminjaman === null) {
            $peminjaman = PeminjamanBarang::find($id);
        }
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
