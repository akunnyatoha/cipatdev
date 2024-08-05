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
        // dd($peminjamans);
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
        $getCodePeminjamanLast = Peminjaman::orderBy('code', 'DESC')->first();
        $codeFix = '';
        $now = getdate(date("U"));
        $year = $now['year'];
        $validateFile = $request->validate([
            'file_pendukung' => 'file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);
        $nameFile = null;
        if($request->file('file_pendukung')) {
            $validateFile['file_pendukung'] = $request->file('file_pendukung')->store('peminjaman-folder');
            $nameFile = $validateFile['file_pendukung'];
        }
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
        if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan' || Auth::user()->role->name == 'Perkuliahan') {
            $status = 'accepted';
            $peminjaman = Peminjaman::create([
                'code' => $codeFix,
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'room_id' => $request->room,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'capacity' => $request->capacity,
                'file_pendukung' => $nameFile,
                'created_by' => Auth::id(),
                'validated_by' => Auth::id(),
            ]);
        } else {
            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            $status = 'pending';
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
                'file_pendukung' => $nameFile,
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
        $validateData = $request->validate([
            'email' => 'email|min:5|max:50|required',
            'name' =>'min:5|max:50|required',
            'phone' => 'min:5|max:13|',
            'room_id' => 'max:10|required',
            'description' =>'min:3|max:255|required',
            'start_datetime' =>'required',
            'end_datetime' =>'required',
            'capacity' =>'required',
            'file_pendukung' => 'file|mimes:jpeg,png,jpg,pdf|max:5120'
        ]);
        if($request->file('file_pendukung')) {
            if($request->old_file) {
                Storage::delete($request->old_file);
            }
            $validateData['file_pendukung'] = $request->file('file_pendukung')->store('peminjaman-folder');
            // $nameImage = $request['image']
        }
        Peminjaman::where('id',$id)->update($validateData);
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
