<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBarang;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request) {
        $laporanFix = [];
        $getPeminjamanBarang = PeminjamanBarang::with('barangs')->where('status', 'accepted');
        $getPeminjamanRuangan = Peminjaman::with('rooms')->where('status', 'accepted');

        if($request['periodeAwal']) {
            $getPeminjamanBarang = $getPeminjamanBarang->where('created_at', '>=', $request['periodeAwal']);
            $getPeminjamanRuangan = $getPeminjamanRuangan->where('created_at', '>=', $request['periodeAwal']);
        }
        if($request['periodeAkhir']) {
            $getPeminjamanBarang = $getPeminjamanBarang->where('created_at', '<=', $request['periodeAkhir']);
            $getPeminjamanRuangan = $getPeminjamanRuangan->where('created_at', '<=', $request['periodeAkhir']);
        }

        $getPeminjamanBarang = $getPeminjamanBarang->orderBy('created_at', 'ASC')->get();
        $getPeminjamanRuangan = $getPeminjamanRuangan->orderBy('created_at', 'ASC')->get();
        
        if (Auth::user()->role->name == 'Dekan') {
            for ($i=0; $i < count($getPeminjamanBarang); $i++) { 
                array_push($laporanFix, [
                    "name_peminjam" => $getPeminjamanBarang[$i]->name,
                    "email" => $getPeminjamanBarang[$i]->email,
                    "phone" => $getPeminjamanBarang[$i]->phone,
                    "kategori" => 'Barang',
                    "title" => $getPeminjamanBarang[$i]->barangs->name,
                    "keperluan" => $getPeminjamanBarang[$i]->description,
                    "tgl_mulai" => $getPeminjamanBarang[$i]->start_datetime,
                    "tgl_selesai" => $getPeminjamanBarang[$i]->end_datetime,
                    'capacity_quantity' => $getPeminjamanBarang[$i]->quantity,
                ]);
            }

            for ($j=0; $j < count($getPeminjamanRuangan); $j++) { 
                array_push($laporanFix, [
                    "name_peminjam" => $getPeminjamanRuangan[$j]->name,
                    "email" => $getPeminjamanRuangan[$j]->email,
                    "phone" => $getPeminjamanRuangan[$j]->phone,
                    "kategori" => 'Ruangan',
                    "title" => $getPeminjamanRuangan[$j]->rooms->name,
                    "keperluan" => $getPeminjamanRuangan[$j]->description,
                    "tgl_mulai" => $getPeminjamanRuangan[$j]->start_datetime,
                    "tgl_selesai" => $getPeminjamanRuangan[$j]->end_datetime,
                    'capacity_quantity' => $getPeminjamanRuangan[$j]->capacity,
                ]);
            }
        } else if(Auth::user()->role->name == 'Perkuliahan') {
            for ($j=0; $j < count($getPeminjamanRuangan); $j++) { 
                array_push($laporanFix, [
                    "name_peminjam" => $getPeminjamanRuangan[$j]->name,
                    "email" => $getPeminjamanRuangan[$j]->email,
                    "phone" => $getPeminjamanRuangan[$j]->phone,
                    "kategori" => 'Ruangan',
                    "title" => $getPeminjamanRuangan[$j]->rooms->name,
                    "keperluan" => $getPeminjamanRuangan[$j]->description,
                    "tgl_mulai" => $getPeminjamanRuangan[$j]->start_datetime,
                    "tgl_selesai" => $getPeminjamanRuangan[$j]->end_datetime,
                    'capacity_quantity' => $getPeminjamanRuangan[$j]->capacity,
                ]);
            }
        } else if(Auth::user()->role->name == 'BKA') {
            for ($i=0; $i < count($getPeminjamanBarang); $i++) { 
                array_push($laporanFix, [
                    "name_peminjam" => $getPeminjamanBarang[$i]->name,
                    "email" => $getPeminjamanBarang[$i]->email,
                    "phone" => $getPeminjamanBarang[$i]->phone,
                    "kategori" => 'Barang',
                    "title" => $getPeminjamanBarang[$i]->barangs->name,
                    "keperluan" => $getPeminjamanBarang[$i]->description,
                    "tgl_mulai" => $getPeminjamanBarang[$i]->start_datetime,
                    "tgl_selesai" => $getPeminjamanBarang[$i]->end_datetime,
                    'capacity_quantity' => $getPeminjamanBarang[$i]->quantity,
                ]);
            }
        }
        // dd($laporanFix);

        return view('dashboardpage.laporan.index', compact('laporanFix'));
    }
}
