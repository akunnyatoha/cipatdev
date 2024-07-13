<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanBarang;
use App\Models\Barang;
use App\Models\PengembalianBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class PengembalianBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pengembalians = DB::table('pengembalian_barangs as pengembalian')
            ->join('peminjaman_barangs as peminjaman', 'pengembalian.code_peminjaman', 'peminjaman.code')
            ->join('barangs as br', 'br.id', 'pengembalian.barang_id')
            ->select(
                'pengembalian.id',
                'pengembalian.code_peminjaman',
                'pengembalian.email',
                'pengembalian.name',
                'pengembalian.phone',
                'pengembalian.barang_id',
                'br.name as barang_name',
                'pengembalian.quantity',
                'pengembalian.tgl_pengembalian',
                'pengembalian.description',
            )
        ->get();

        return view('dashboardpage.pengembalianbarang.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $getPeminjaman = DB::table('peminjaman_barangs as pb')
            ->join('barangs as br', 'br.id', 'pb.barang_id')
            ->select('pb.*', 'br.name as barang_name')
            ->where('pb.code', $request['code_peminjaman'])
        ->first();
        $getPengembalians = PengembalianBarang::where('code_peminjaman', $request['code_peminjaman'])->get();
        // dd($getPeminjaman);
        if($getPeminjaman != null) {
            if(count($getPengembalians) > 0) {
                $qty = 0;
                foreach ($getPengembalians as $i) {
                    $qty += intval($i->quantity);
                }
                if(intval($getPeminjaman->quantity) != $qty && intval($getPeminjaman->quantity) > $qty) {
                    return view('dashboardpage.pengembalianbarang.create', compact('getPeminjaman'));
                } else {
                    return redirect()->route('dashboardpage.pengembalianbarang.index')->with('warning', 'Data peminjaman dengan code ' . $request['code_peminjaman'] . ' sudah dikembalikan dengan quantity yang sesuai');
                }
            } else {
                return view('dashboardpage.pengembalianbarang.create', compact('getPeminjaman'));
            }
        } else {
            return redirect()->route('dashboardpage.pengembalianbarang.index')->with('warning', 'Data peminjaman dengan code ' . $request['code_peminjaman'] . ' tidak ditemukan');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $getPeminjaman = PeminjamanBarang::where('code', $request['code_peminjaman'])->first();
        if(intval($request->quantity) > intval($getPeminjaman->quantity)) {
            return redirect()->route('dashboardpage.pengembalianbarang.index')->with('error', 'Quantity yang anda masukkan melebihi quantity data yang di pinjam');
        }
        $saveDdata = PengembalianBarang::create([
            "code_peminjaman" => $request->code_peminjaman,
            "email" => $request->email,
            "name" => $request->name,
            "phone" => $request->phone,
            "barang_id" => $request->barang_id,
            "quantity" => $request->quantity,
            "description" => $request->description,
            "tgl_pengembalian" => $request->tgl_pengembalian
        ]);

        $findBarang = Barang::find(intval($request->barang_id));
        $qty = intval($findBarang->quantity) + intval($request->quantity);
        $findBarang->update(["quantity" => $qty]);

        return redirect()->route('dashboardpage.pengembalianbarang.index')->with('success', 'Data peminjaman dengan kode ' . $request->code_peminjaman . ' telah dikembalikan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
