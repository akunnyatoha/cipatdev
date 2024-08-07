<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{
    public function index(){
        $peminjamans = [];
        $peminjamanrooms = Peminjaman::with('rooms')->latest()->limit(5)->get();
        $peminjamanbarangs = PeminjamanBarang::with('barangs')->latest()->limit(5)->get();
        // return ["1" => $peminjamanrooms, "2" => $peminjamanbarangs[0]];
        foreach ($peminjamanrooms as $i) {
            array_push($peminjamans, $i);
        }
        foreach ($peminjamanbarangs as $j) {
            array_push($peminjamans, $j);
        }
        $pendingRoomOrder = Peminjaman::where('status', 'pending')->count();
        $rejectRoomOrder = Peminjaman::where('status', 'reject')->count();
        $pendingBarangOrder = PeminjamanBarang::where('status', 'pending')->count();
        $rejectBarangOrder = PeminjamanBarang::where('status', 'reject')->count();

        $pendingOrder = $pendingRoomOrder + $pendingBarangOrder;
        $rejectOrder = $rejectRoomOrder + $rejectBarangOrder;

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $totalPeminjamanRuangan = Peminjaman::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalPeminjamanBarang = PeminjamanBarang::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalPeminjaman = $totalPeminjamanRuangan + $totalPeminjamanBarang;
        $completedPeminjamanRuangan = Peminjaman::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'accepted')->count();
        $completedPeminjamanBarang = PeminjamanBarang::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'accepted')->count();

        $completedPeminjaman = $completedPeminjamanBarang + $completedPeminjamanRuangan;    

        $rate = 0;
        if($totalPeminjaman != 0 && $completedPeminjaman != 0) {
            $rate = $completedPeminjaman / $totalPeminjaman * 100;
        }

        $userCount = User::count();
        // Ambil data peminjaman dari minggu ini
        $peminjamanRuanganThisWeek = Peminjaman::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->where('status', 'accepted')->get();
        $peminjamanBarangThisWeek = PeminjamanBarang::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->where('status', 'accepted')->get();

        // foreach ($peminjamanRuanganThisWeek as $o) {
        //     array_push($peminjamanThisWeek, $o);
        // }
        // foreach ($peminjamanBarangThisWeek as $o) {
        //     array_push($peminjamanThisWeek, $o);
        // }

        $peminjamanThisWeek = count($peminjamanRuanganThisWeek) + count($peminjamanBarangThisWeek);
        // Ambil data peminjaman dari minggu lalu
        $peminjamanRuanganLastWeek = Peminjaman::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek()->subWeek(),
            Carbon::now()->endOfWeek()->subWeek(),
        ])->where('status', 'accepted')->get();
        $peminjamanBarangLastWeek = PeminjamanBarang::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek()->subWeek(),
            Carbon::now()->endOfWeek()->subWeek(),
        ])->where('status', 'accepted')->get();

        // foreach ($peminjamanRuanganLastWeek as $p) {
        //     array_push($peminjamanLastWeek, $p);
        // }
        // foreach ($peminjamanBarangLastWeek as $q) {
        //     array_push($peminjamanLastWeek, $q);
        // }
        
        $peminjamanLastWeek = count($peminjamanRuanganLastWeek) + count($peminjamanBarangLastWeek);

        return view("dashboard",compact('peminjamans','pendingOrder','rejectOrder','rate','userCount','peminjamanThisWeek', 'peminjamanLastWeek'));
    }
    public function calendar(){
        return view("dashboardpage.calendar");
    }

    public function downloadFile(Request $request) {
        $path = Storage::path($request->file);
        // dd($path);
        return response()->download($path);
    }
}
