<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory;
    protected $table = "pengembalian_barangs";
    protected $fillable = [
        'id',
        'code_peminjaman',
        'email',
        'name',
        'phone',
        'barang_id',
        'quantity',
        'description',
        'tgl_pengembalian',
    ];
}
