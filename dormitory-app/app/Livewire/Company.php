<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // ใช้อัพโหลดไฟล์
use App\Models\OrganizationModel; 
use Illuminate\Support\Facades\Storage; 

class Company extends Component
{
    use WithFileUploads; // ฟีเจอร์อัพโหลดไฟล์ Livewire


    public $name, $address, $phone, $tax_code, $logo;
    public $amount_water = 0;
    public $amount_water_per_unit = 0;
    public $amount_electric_per_unit = 0;
    public $amount_internet = 0;
    public $amount_etc = 0;
    public $logoUrl; 
    public $flashMessage; 

    public function mount()
    {
        $this->fetchData(); 
    }

    // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล
    public function fetchData()
    {
        $organization = OrganizationModel::first(); 
        $this->name = $organization->name ?? ''; // ถ้าไม่มีค่ากำหนดให้เป็นค่าว่าง
        $this->address = $organization->address ?? '';
        $this->phone = $organization->phone ?? '';
        $this->tax_code = $organization->tax_code ?? '';
        $this->amount_water  = $organization->amount_water ?? 0;
        $this->amount_water_per_unit = $organization->amount_water_per_unit ?? 0;
        $this->amount_electric_per_unit = $organization->amount_electric_per_unit ?? 0;
        $this->amount_internet = $organization->amount_internet ?? 0;
        $this->amount_etc = $organization->amount_etc ?? 0;

        //  เช็คว่ามีโลโก้หรือไม่
        if (isset($organization->logo)) {
            $this->logoUrl = asset('storage/' . $organization->logo);
        }
    }

  
    public function render()
    {
        return view('livewire.company'); 
    }

    // บันทึกข้อมูลเมื่อผู้ใช้กรอก
    public function save()
    {
        $logo = ''; 

        // เช็คการอัพโหลดไฟล์โลโก้
        if ($this->logo) {
            $logo = $this->logo->store('organizations', 'public'); 
        }

        // เช็คใน database ว่ามีข้อมูลองค์กรหรือไม่
        if (OrganizationModel::count() == 0) {
            $organization = new OrganizationModel(); 
        } else {
            $organization = OrganizationModel::first();

            // ลบโลโก้เก่าออก ถ้าอัพโหลดโลโก้ใหม่
            if ($organization->logo) {
                if ($logo != '') {
                    $storage = Storage::disk('public'); 
                    if ($storage->exists($organization->logo)) {
                        $storage->delete($organization->logo); 
                    }
                }
            }
        }

        // อัพเดตข้อมูลองค์กร
        $organization->name = $this->name;
        $organization->address = $this->address;
        $organization->phone = $this->phone;
        $organization->tax_code = $this->tax_code;

        // เช็คถ้าอัพโหลดโลโก้ใหม่ เก็บชื่อไฟล์โลโก้ใหม่
        if ($logo != '') {
            $organization->logo = $logo;
        }

        // อัพเดตข้อมูลใช้น้ำ, ไฟฟ้า, อินเทอร์เน็ต 
        $organization->amount_water = $this->amount_water;
        $organization->amount_water_per_unit = $this->amount_water_per_unit;
        $organization->amount_electric_per_unit = $this->amount_electric_per_unit;
        $organization->amount_internet = $this->amount_internet;
        $organization->amount_etc = $this->amount_etc;

 
        $organization->save();

        // แจ้งเตือนสำเร็จ
        $this->flashMessage = 'บันทึกข้อมูลสำเร็จ';

        
        $this->fetchData();
    }
}
