<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 

class RoomModel extends Model
{
    protected $table = 'rooms'; 
    // ระบุคอลัมน์บันทึกข้อมูล
    protected $fillable = ['name', 'price_per_day', 'price_per_month', 'status'];

    // ปิด timestamp
    public $timestamps = false;
}