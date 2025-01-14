<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Navbar extends Component
{

    public $user_name;
    public $showModal = false; 
    public $showModalEdit = false; 
    public $username;
    public $password;
    public $password_confirm;
    public $errorUsername;
    public $errorPassword;
    public $saveSuccess = false;
    public $userLevel = '';

    // ฟังก์ชันที่ใช้เปิด Modal สำหรับการแก้ไขข้อมูลของผู้ใช้
    public function editProfile()
    {
        $this->showModalEdit = true; // เปิด Modal แก้ไขข้อมูล

        // ดึงข้อมูลผู้ใช้จาก session
        $user = User::find(session()->get('user_id'));
        $this->username = $user->name; // กำหนดค่า username จากข้อมูลผู้ใช้
        $this->saveSuccess = false; // รีเซ็ตสถานะการบันทึก
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลหลังจากที่แก้ไขแล้ว
    public function updateProfile()
    {
        // ตรวจสอบว่า username ไม่ว่าง
        if ($this->username == '') {
            $this->addError('username', 'กรุณากรอก username'); // แสดงข้อผิดพลาดถ้าไม่มีการกรอก
            return;
        }

        // ตรวจสอบว่า password และ password_confirm ตรงกันหรือไม่
        if ($this->password != $this->password_confirm) {
            $this->addError('password_confirm', 'รหัสผ่านไม่ตรงกัน'); 
            return;
        }

        // ค้นหาผู้ใช้จาก session 
        $user = User::find(session()->get('user_id'));
        $user->name = $this->username; 
        $user->password = $this->password ?? $user->password; // อัพเดตรหัสผ่าน
        $user->save(); 

        $this->saveSuccess = true; // ตั้งสถานะว่าแก้ไขข้อมูลสำเร็จแล้ว

        $this->clearErrors();
    }

    public function mount()
    {
        // ดึงข้อมูลชื่อผู้ใช้จาก session
        $this->user_name = session()->get('user_name');
        $this->userLevel = session()->get('user_level');
    }

    // ฟังก์ชันออกจากระบบ
    public function logout()
    {
        session()->flush(); // เคลียร์ข้อมูล session ทั้งหมด
        $this->redirect('/');
    }

    // ฟังก์ชันที่ใช้ในการแสดงผล view
    public function render()
    {
        return view('livewire.navbar'); // โหลด view สำหรับ Navbar
    }
}
