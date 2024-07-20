<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barangs";
    protected $fillable = [
        'id',
        'code',
        'name',
        'quantity'
    ];
    public function barangs()
    {
        return $this->hasMany(PeminjamanBarang::class,'barang_id');
    }
}
