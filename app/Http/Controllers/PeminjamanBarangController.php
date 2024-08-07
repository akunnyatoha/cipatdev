<?php

namespace App\Http\Controllers;
use App\Models\PeminjamanBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class PeminjamanBarangController extends Controller
{
    public function index(){
        $peminjamans = PeminjamanBarang::with('barangs')->orderBy('created_at', 'desc')->get();
        $peminjamanAvailable = PeminjamanBarang::select(
            'id','barang_id', 
            'quantity', 
            'created_at',
            DB::raw(
                'TIMESTAMPDIFF(SECOND,created_at, NOW()) AS selisih_waktu'
            )
        )
            ->where('status' , 'pending')
        ->get();
        if(count($peminjamanAvailable) > 0) {
            foreach ($peminjamanAvailable as $p) {
                if(intval($p->selisih_waktu) >= 86400) {
                    $getBarang = Barang::find($p->barang_id);
                    $quantity = intval($getBarang->quantity) + intval($p->quantity);
                    $getBarang->update(['qantity' => $quantity]);
                    $updatePpeminjaman = PeminjamanBarang::where('id', $p->id)->update(['status' => 'expired']);
                }
            }
        }
        return view("dashboardpage.peminjamanbarang.index",compact('peminjamans'));
    }
    public function create(){
        $barangs = Barang::all();
        return view('dashboardpage.peminjamanbarang.create',compact('barangs'));
    }
    public function datacsv(){
        $barangs = Barang::all();
        return view('dashboardpage.peminjamanbarang.datacsv',compact('barangs'));
    }
    public function store(Request $request){
        $getCodePeminjamanLast = PeminjamanBarang::orderBy('code', 'DESC')->first();
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
                $codeFix = 'BR' . '/'. $nourut . '/' . $year;
            } else {
                $codeFix = 'BR' . '/'. '0001' . '/' . $year;
            }
        } else {
            $codeFix = 'BR' . '/'. '0001' . '/' . $year;
        }
        if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan' || Auth::user()->role->name == 'BKA') {
            $status = 'accepted';
            $peminjaman = PeminjamanBarang::create([
                'code' => $codeFix,
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'barang_id' => $request->barang,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'quantity' => $request->quantity,
                'file_pendukung' => $nameFile,
                'created_by' => Auth::id(),
                'validated_by' => Auth::id(),
            ]);

            $getBarang = Barang::where('id', $request->barang)->first();
            $sisaQty = intval($getBarang->quantity) - intval($request->quantity); 

            $updateQuantity = Barang::where('id', $request->barang)->update([
                'quantity' => $sisaQty
            ]);
        } else {
            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
            $status = 'pending';
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
                'file_pendukung' => $nameFile,
                'created_by' => Auth::id(),
            ]);

            $getBarang = Barang::where('id', $request->barang)->first();
            $sisaQty = intval($getBarang->quantity) - intval($request->quantity); 

            $updateQuantity = Barang::where('id', $request->barang)->update([
                'quantity' => $sisaQty
            ]);
        }
        if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan' || Auth::user()->role->name == 'BKA' ) {
            return redirect()->route('dashboardpage.peminjamanbarang.index');
        } else {
            return redirect()->route('landingpage.peminjamanbarang');
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
                $barang = Barang::firstOrCreate(['name' => $row[4]]);

                // Format the start_datetime using Carbon
                $startDatetime = Carbon::createFromFormat('m/d/Y H:i', $row[6])->format('Y-m-d H:i:s');
                $endDatetime = Carbon::createFromFormat('m/d/Y H:i', $row[7])->format('Y-m-d H:i:s');

                // Add data to the peminjamans table
                PeminjamanBarang::create([
                    'email' => $row[1],
                    'name' => $row[2],
                    'phone' => $row[3],
                    'barang_id' => $barang->id,
                    'description' => $row[5],
                    'start_datetime' => $startDatetime,
                    'end_datetime' => $endDatetime,
                    'quantity' => $row[8],
                    'status' => $row[9],
                    'created_by' => auth()->user()->id,
                    'validated_by' => auth()->user()->id,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('dashboardpage.peminjamanbarang.index')->with('success', 'Data berhasil diimpor dari CSV.');
    }
    public function edit($id){
        $peminjaman = PeminjamanBarang::where('id',$id)->with('rooms')->first();
        $ruangans = Barang::all();
        return view('dashboardpage.peminjamanbarang.edit',compact('peminjaman','ruangans'));
    }
    public function update(Request $request, $id){
        $validateFile = $request->validate([
            'file_pendukung' => 'file|mimes:jpeg,png,jpg,pdf|max:5120'
        ]);
        $qtySebelumUpdate = PeminjamanBarang::where('id',$id)->first();
        $getBarang = Barang::where('id', $request->barang)->first();
        $qtyBarang = intval($qtySebelumUpdate->quantity) + intval($getBarang->quantity);
        if($request->file('file_pendukung')) {
            if($request->old_file) {
                Storage::delete($request->old_file);
            }
            $validateFile['file_pendukung'] = $request->file('file_pendukung')->store('peminjaman-folder');
            PeminjamanBarang::where('id',$id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'barang_id' => $request->barang,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'quantity' => $request->quantity,
                'file_pendukung' => $validateFile['image']
            ]);
        } else {
            PeminjamanBarang::where('id',$id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'barang_id' => $request->barang,
                'description' => $request->description,
                'start_datetime' => $request->tanggalawal,
                'end_datetime' => $request->tanggalakhir,
                'quantity' => $request->quantity,
            ]);
        }
        $sisaQty = intval($qtyBarang) - intval($request->quantity); 

        $updateQuantity = Barang::where('id', $request->barang)->update([
            'quantity' => $sisaQty
        ]);
        return redirect()->route('dashboardpage.peminjamanbarang.index');
    }
    public function accept($id)
    {
        $user = Auth::user();
        $peminjaman = PeminjamanBarang::findOrFail($id);
        $peminjaman->status = 'accepted';
        $peminjaman->validated_by = $user->id;
        $peminjaman->save();

        return redirect()->route('dashboardpage.peminjamanbarang.index')->with('success', 'accepted successfully.');
    }

    public function reject($id)
    {
        $user = Auth::user();
        $peminjaman = PeminjamanBarang::findOrFail($id);

        $findBarang = Barang::where('id', $peminjaman->barang_id)->first();
        $quantity = intval($findBarang->quantity) + intval($peminjaman->quantity);
        $updateBarang = Barang::where('id', $peminjaman->barang_id)->update(['quantity' => $quantity]);

        $peminjaman->status = 'reject';
        $peminjaman->validated_by = $user->id;
        $peminjaman->save();

        return redirect()->route('dashboardpage.peminjamanbarang.index')->with('success', 'has been rejected.');
    }
    public function destroy($id)
    {
        $peminjaman = PeminjamanBarang::find($id);
        $getBarang = Barang::where('id', $peminjaman->barang_id)->first();
        $quantity = intval($getBarang->quantity) + intval($peminjaman->quantity);

        $updateBarang = Barang::where('id', $peminjaman->barang_id)->update(['quantity'=> $quantity]);
        $peminjaman->delete();
        return redirect()->route('dashboardpage.peminjamanbarang.index');
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
