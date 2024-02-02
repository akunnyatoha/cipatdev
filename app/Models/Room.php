<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $fillable = [
        'id',
        'name',
        'floor',
        'capacity',
        'building',
    ];
    public function rooms()
    {
        return $this->hasMany(Peminjaman::class,'room_id');
    }
}
