<?php

namespace App\Models; // namespace ของ Model ให้อยู่ในโฟลเดอร์ App\Models

use Illuminate\Database\Eloquent\Model; 

class OrganizationModel extends Model
{

    protected $table = 'organizations';

    //(Mass Assignment)
    protected $fillable = [
        'name',                      
        'address',                   
        'phone',                     
        'tax_code',                  
        'logo',                      
        'amount_water',              
        'amount_water_per_unit',     // ค่าใช้น้ำต่อหน่วย
        'amount_electric_per_unit',  // ค่าไฟฟ้าต่อหน่วย
        'amount_internet',           
        'amount_etc'                 // ค่าใช้จ่ายอื่น ๆ
    ];

    // ปิด timestamp (created_at และ updated_at)
    public $timestamps = false;
}
