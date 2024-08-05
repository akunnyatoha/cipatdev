<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjamans";
    protected $fillable = [
        'id',
        'code',
        'email',
        'name',
        'phone',
        'room_id',
        'description',
        'start_datetime',
        'end_datetime',
        'capacity',
        'file_pendukung',
        'status',
        'created_by',
        'validated_by',
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'email');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class,'room_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Role::class,'created_by');
    }
    public function validated_by()
    {
        return $this->belongsTo(Role::class,'validated_by');
    }
    public static function getAvailableRooms($startDatetime, $endDatetime)
    {
        // Query to get room_ids that are booked during the specified time range
        $bookedRoomIds = self::where(function ($query) use ($startDatetime, $endDatetime) {
            $query->where('start_datetime', '<', $endDatetime)
                ->where('end_datetime', '>', $startDatetime)
                ->whereIn('status', ['accepted', 'pending']);;
        })->pluck('room_id')->toArray();

        // Query to get rooms that are not booked during the specified time range
        $availableRooms = Room::whereNotIn('id', $bookedRoomIds)->get();

        return $availableRooms;
    }
}
