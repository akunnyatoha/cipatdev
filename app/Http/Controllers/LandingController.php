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
        $status = ($userRole === 'Admin' || $userRole === 'BKA' || $userRole === 'Perkuliahan') ? 'accepted' : 'pending';

            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            if($request->barang) {
                $getQuantityBarang = Barang::where('id', $request->barang)->first();
                if(intval($request->quantity) <= intval($getQuantityBarang->quantity)) {
                    $getCodePeminjamanLast = PeminjamanBarang::orderBy('code', 'DESC')->first();
                    $codeFix = '';
                    $now = getdate(date("U"));
                    $year = $now['year'];
                    if($getCodePeminjamanLast != null) {
                        // RG/0001/2024
                        $split = str_split($getCodePeminjamanLast['code']);
                        $codeFront = $split[0] . $split[1];
                        $nourut = $split[3] . $split[4] . $split[5] . $split[6];
                        $getYear = $split[8] . $split[9] .$split[10] . $split [11];
                        if($year == $getYear) {
                            $nourut = intval($nourut) + 1;
                            $nourut = sprintf('%04s', $nourut);
                            $codeFix = 'BR' . '/'. $nourut . '/' . $year;
                        } else {
                            $codeFix = 'BR' . '/'. '0001' . '/' . $year;
                        }
                    } else {
                        $codeFix = 'BR' . '/'. '0001' . '/' . $year;
                    }
                    $sisaQuantity = intval($getQuantityBarang->quantity) - intval($request->quantity);
                    $peminjaman = PeminjamanBarang::create([
                        'code' => $codeFix,
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
                } else {
                    return redirect()->route('landingpage.peminjamanbarang')->with('error', 'jumlah permintaan melebihi jumlah barang yang tersedia!');
                }
                // dd($updateQtyBarang);
            } else {
                $getCapacityRoom = Room::where('id', $request->room)->first();
                if(intval($request->capacity) <= intval($getCapacityRoom->capacity)) {
                    $getCodePeminjamanLast = Peminjaman::orderBy('code', 'DESC')->first();
                    $codeFix = '';
                    $now = getdate(date("U"));
                    $year = $now['year'];
                    if($getCodePeminjamanLast != null) {
                        // RG/0001/2024
                        $split = str_split($getCodePeminjamanLast['code']);
                        $codeFront = $split[0] . $split[1];
                        $nourut = $split[3] . $split[4] . $split[5] . $split[6];
                        $getYear = $split[8] . $split[9] .$split[10] . $split [11];
                        if($year == $getYear) {
                            $nourut = intval($nourut) + 1;
                            $nourut = sprintf('%04s', $nourut);
                            $codeFix = 'RG' . '/'. $nourut . '/' . $year;
                        } else {
                            $codeFix = 'RG' . '/'. '0001' . '/' . $year;
                        }
                    } else {
                        $codeFix = 'RG' . '/'. '0001' . '/' . $year;
                    }
                    $peminjaman = Peminjaman::create([
                        'code' => $codeFix,
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
                } else {
                    return redirect()->route('landingpage.peminjaman')->with('error', 'Jumlah kapasitas melebihi kapasitas ruangan!');
                }
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
