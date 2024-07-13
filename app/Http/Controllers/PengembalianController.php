<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;
use App\Models\Room;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request) {
        $pengembalians = DB::table('pengembalians as pb')
            ->join('peminjamans as pm', 'pm.code', '=', 'pb.code_peminjaman')
            ->join('rooms as ru', 'ru.id', 'pm.room_id')
            ->select(
                'pb.id',
                'pb.code_peminjaman',
                'pb.email',
                'pb.name',
                'pb.email',
                'pb.phone',
                'pb.room_id',
                'ru.name as room_name',
                'pb.description',
                'pb.tgl_pengembalian',
            )
        ->get();
        // dd($pengembalians);
        return view("dashboardpage.pengembalian.index",compact('pengembalians'));
    }

    public function create(Request $request) {
        $getPengembalian = DB::table('pengembalians')->where('code_peminjaman', $request->code_peminjaman)->first();
        if($getPengembalian != null) {
            return redirect()->route("dashboardpage.pengembalian.index")->with('warning', 'sudah di kembalikan');
        }
        $peminjamans = Peminjaman::where('code', $request->code_peminjaman)->where('status', 'accepted')->with('rooms')->orderBy('created_at', 'desc')->first();
        if($peminjamans == null) {
            return redirect()->route("dashboardpage.pengembalian.index")->with('warning', 'Data peminjaman dengan kode peminjaman ' . $request->code_peminjaman . ' tidak di temukan');
        }
        // dd($peminjamans);
        return view("dashboardpage.pengembalian.create", compact('peminjamans'));
    }

    public function store(Request $request) {
        $paramSave = [
            "code_peminjaman" => $request->code_peminjaman,
            "email" => $request->email,
            "name" => $request->name,
            "phone" => $request->phone,
            "room_id" => $request->room_id,
            "description" => $request->description,
            "tgl_pengembalian" => $request->tgl_pengembalian
        ];

        $saveData = Pengembalian::create($paramSave);
        return redirect()->route("dashboardpage.pengembalian.index")->with('success', 'Peminjaman dengan kode ' . $request->code_peminjaman . ' telah di kembalikan :)');
    }

    public function edit(Request $request, $id) {
        $pengembalian =  DB::table('pengembalians as pb')
            ->join('peminjamans as pm', 'pm.code', '=', 'pb.code_peminjaman')
            ->join('rooms as ru', 'ru.id', 'pm.room_id')
            ->select(
                'pb.id',
                'pb.code_peminjaman',
                'pb.email',
                'pb.name',
                'pb.email',
                'pb.phone',
                'pb.room_id',
                'ru.name as room_name',
                'pb.description',
                'pb.tgl_pengembalian',
            )
            ->where('pb.id', $id)
        ->first();
        return view('dashboardpage.pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id) {
        $paramSave = [
            "code_peminjaman" => $request->code_peminjaman,
            "email" => $request->email,
            "name" => $request->name,
            "phone" => $request->phone,
            "room_id" => $request->room_id,
            "description" => $request->description,
            "tgl_pengembalian" => $request->tgl_pengembalian
        ];

        $findData = Pengembalian::find($id);
        $code = $request->code_peminjaman;
        $findData->update($paramSave);
        return redirect()->route('dashboardpage.pengembalian.index')->with('succes', 'Data pengembalian dengan code ' . $code . ' berhasil di update!');
    }

    public function destroy(Request $request, $id) {
        $deleteData = Pengembalian::find($id);
        $code = $deleteData->code_peminjaman;
        $deleteData->delete();

        return redirect()->route("dashboardpage.pengembalian.index")->with('success', 'Data pengembalian dengan kode ' . $code . ' telah di hapus :)');
    }
}
