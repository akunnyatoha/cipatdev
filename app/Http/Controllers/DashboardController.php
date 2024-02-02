<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(){
        $peminjamans = Peminjaman::with('rooms')->latest()->limit(7)->get();
        $pendingOrder = Peminjaman::where('status', 'pending')->count();
        $rejectOrder = Peminjaman::where('status', 'reject')->count();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $totalPeminjaman = Peminjaman::whereBetween('created_at', [$startDate, $endDate])->count();
        $completedPeminjaman = Peminjaman::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'accepted')->count();

        $rate = ($completedPeminjaman / $totalPeminjaman) * 100;
        $userCount = User::count();
        // Ambil data peminjaman dari minggu ini
        $peminjamanThisWeek = Peminjaman::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->where('status', 'accepted')->get();

        // Ambil data peminjaman dari minggu lalu
        $peminjamanLastWeek = Peminjaman::whereBetween('start_datetime', [
            Carbon::now()->startOfWeek()->subWeek(),
            Carbon::now()->endOfWeek()->subWeek(),
        ])->where('status', 'accepted')->get();
        return view("dashboard",compact('peminjamans','pendingOrder','rejectOrder','rate','userCount','peminjamanThisWeek', 'peminjamanLastWeek'));
    }
    public function calendar(){
        return view("dashboardpage.calendar");
    }
}
