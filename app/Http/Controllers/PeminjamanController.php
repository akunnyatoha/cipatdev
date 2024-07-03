<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class PeminjamanController extends Controller
{
    public function index(){
        $peminjamans = Peminjaman::with('rooms')->orderBy('created_at', 'desc')->get();
        return view("dashboardpage.peminjaman.index",compact('peminjamans'));
    }
    public function create(){
        $rooms = Room::all();
        return view('dashboardpage.peminjaman.create',compact('rooms'));
    }
    public function datacsv(){
        $rooms = Room::all();
        return view('dashboardpage.peminjaman.datacsv',compact('rooms'));
    }
    public function store(Request $request){
        if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan' || Auth::user()->role->name == 'Perkuliahan') {
            $status = 'accepted';
            $peminjaman = Peminjaman::create([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'room_id' => $request->room,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'capacity' => $request->capacity,
                'created_by' => Auth::id(),
                'validated_by' => Auth::id(),
            ]);
        } else {
            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            $status = 'pending';
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
        if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan' || Auth::user()->role->name == 'Perkuliahan') {
            return redirect()->route('dashboardpage.peminjaman.index');
        } else {
            return redirect()->route('landingpage.peminjaman');
        }
    }
    public function importCSV(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses file CSV
        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));

        // Loop untuk setiap baris CSV
        for ($i = 2; $i < count($csvData); $i++) {
            $row = $csvData[$i];

            // Ensure the number of columns matches the requirement
            if (count($row) == 10) {
                // Find or create the room based on the provided name
                $room = Room::firstOrCreate(['name' => $row[4]]);

                // Format the start_datetime using Carbon
                $startDatetime = Carbon::createFromFormat('m/d/Y H:i', $row[6])->format('Y-m-d H:i:s');
                $endDatetime = Carbon::createFromFormat('m/d/Y H:i', $row[7])->format('Y-m-d H:i:s');

                // Add data to the peminjamans table
                Peminjaman::create([
                    'email' => $row[1],
                    'name' => $row[2],
                    'phone' => $row[3],
                    'room_id' => $room->id,
                    'description' => $row[5],
                    'start_datetime' => $startDatetime,
                    'end_datetime' => $endDatetime,
                    'capacity' => $row[8],
                    'status' => $row[9],
                    'created_by' => auth()->user()->id,
                    'validated_by' => auth()->user()->id,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('dashboardpage.peminjaman.index')->with('success', 'Data berhasil diimpor dari CSV.');
    }
    public function edit($id){
        $peminjaman = Peminjaman::where('id',$id)->with('rooms')->first();
        $ruangans = Room::all();
        return view('dashboardpage.peminjaman.edit',compact('peminjaman','ruangans'));
    }
    public function update(Request $request, $id){
        Peminjaman::where('id',$id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'room_id' => $request->room,
            'description' => $request->description,
            'start_datetime' => $request->tanggalawal,
            'end_datetime' => $request->tanggalakhir,
            'capacity' => $request->capacity,
        ]);
        return redirect()->route('dashboardpage.peminjaman.index');
    }
    public function accept($id)
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'accepted';
        $peminjaman->validated_by = $user->id;
        $peminjaman->save();

        return redirect()->route('dashboardpage.peminjaman.index')->with('success', 'accepted successfully.');
    }

    public function reject($id)
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'reject';
        $peminjaman->validated_by = $user->id;
        $peminjaman->save();

        return redirect()->route('dashboardpage.peminjaman.index')->with('success', 'has been rejected.');
    }
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        return redirect()->route('dashboardpage.peminjaman.index');
    }
    public function downloadCSV()
    {
        $path = storage_path('app/public/data/templatecsv.csv');

        // Membuat response untuk file yang akan didownload
        $response = Response::download($path, 'templatecsv.csv', [
            'Content-Type' => 'text/csv',
        ]);

        return $response;
    }
}
