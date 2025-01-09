<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    // ระบุคอลัมน์บันทึกข้อมูล
    protected $fillable = ['name', 'address', 'phone', 'status', 'created_at', 'remark', 'room_id', 'stay_type', 'price'];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(RoomModel::class, 'room_id', 'id');
    }
}
