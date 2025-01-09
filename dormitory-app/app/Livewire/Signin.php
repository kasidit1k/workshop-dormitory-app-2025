<?php

namespace App\Livewire; // กำหนด namespace อยู่ในโฟลเดอร์ app/Livewire

use Livewire\Component;
use Illuminate\Support\Facades\Validator; // Validator ตรวจสอบข้อมูล
use App\Models\User; // User เพื่อดึงข้อมูลผู้ใช้จาก Database
use Illuminate\Support\Facades\Hash; // Hash ตรวจสอบรหัสผ่านแบบเข้ารหัส

// Signin
class Signin extends Component
{
    public $username; 
    public $password; 
    public $errorUsername; 
    public $errorPassword; 
    public $error = null;

    
    public function signin()
    {
        // เคลียร์ค่าข้อผิดพลาดก่อนการตรวจสอบ
        $this->errorUsername = null;
        $this->errorPassword = null;

        // ตรวจสอบข้อมูลที่ผู้ใช้กรอกด้วย Validator
        $validator = Validator::make([
            'username' => $this->username,
            'password' => $this->password
        ], [
            'username' => 'required', 
            'password' => 'required' 
        ]);

        // ตรวจสอบล้มเหลวบันทึกข้อผิดพลาดลงในตัวแปร
        if ($validator->fails()) {
            $this->errorUsername = $validator->errors()->get('username')[0] ?? null; 
            $this->errorPassword = $validator->errors()->get('password')[0] ?? null; 
        } else {
            // ตรวจสอบว่ามีชื่อผู้ใช้ในฐานข้อมูลหรือไม่
            $user = User::where('name', $this->username)
                ->first();

            // รหัสผ่านถูกต้อง
            if ($user && Hash::check($this->password, $user->password)) {
                // เก็บข้อมูลผู้ใช้ใน session
                session()->put('user_id', $user->id);
                session()->put('user_name', $user->name);
                session()->put('user_level', $user->level);

                // ไปยังหน้า dashboard
                $this->redirect('/dashboard');
            } else {
                $this->error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }
        }
    }

    /**
     * render ใช้แสดง View ของคอมโพเนนต์นี้
     */
    public function render()
    {
        return view('livewire.signin');
    }
}
