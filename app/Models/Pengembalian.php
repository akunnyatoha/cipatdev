<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = "pengembalians";
    protected $fillable = [
        'id',
        'code_peminjaman',
        'email',
        'name',
        'phone',
        'room_id',
        'description',
        'tgl_pengembalian',
    ];
}
