<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;
    protected $table = "peminjaman_barangs";
    protected $fillable = [
        'id',
        'email',
        'name',
        'phone',
        'barang_id',
        'description',
        'start_datetime',
        'end_datetime',
        'quantity',
        'status',
        'created_by',
        'validated_by',
    ];
    public function barangs()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Role::class,'created_by');
    }
    public function validated_by()
    {
        return $this->belongsTo(Role::class,'validated_by');
    }
    public static function getAvailableBarangs($startDatetime, $endDatetime)
    {

        $barang = Barang::get();
        $availableBarangs = [];
        foreach ($barang as $i) {
            if(intval($i->quantity) > 0) {
                array_push($availableBarangs, $i);
            }
        }
        return $availableBarangs;
    }
}
