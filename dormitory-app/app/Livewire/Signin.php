<?php

namespace App\Livewire; // กำหนด namespace ของคอมโพเนนต์ให้อยู่ในโฟลเดอร์ app/Livewire

use Livewire\Component; // ใช้ Livewire Component เป็นพื้นฐานของคอมโพเนนต์
use Illuminate\Support\Facades\Validator; // ใช้ Validator สำหรับตรวจสอบข้อมูล
use App\Models\User; // ใช้โมเดล User เพื่อดึงข้อมูลผู้ใช้จากฐานข้อมูล
use Illuminate\Support\Facades\Hash; // ใช้ Hash สำหรับตรวจสอบรหัสผ่านแบบเข้ารหัส

/**
 * Signin
 */
class Signin extends Component
{
    // ตัวแปรสาธารณะที่ใช้เก็บค่าจากฟอร์ม
    public $username; 
    public $password; 

    // ตัวแปรสำหรับเก็บข้อความแสดงข้อผิดพลาดของแต่ละฟิลด์
    public $errorUsername; 
    public $errorPassword; 

    // ตัวแปรสำหรับเก็บข้อความแสดงข้อผิดพลาดทั่วไป
    public $error = null;

    /**
     * ฟังก์ชันจัด Signin
     */
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

        // หากการตรวจสอบล้มเหลว ให้บันทึกข้อผิดพลาดลงในตัวแปร
        if ($validator->fails()) {
            $this->errorUsername = $validator->errors()->get('username')[0] ?? null; 
            $this->errorPassword = $validator->errors()->get('password')[0] ?? null; 
        } else {
            // ตรวจสอบว่ามีชื่อผู้ใช้ในฐานข้อมูลหรือไม่
            $user = User::where('name', $this->username)
                ->first();

            // ถ้ารหัสผ่านถูกต้อง
            if ($user && Hash::check($this->password, $user->password)) {
                // เก็บข้อมูลผู้ใช้ใน session
                session()->put('user_id', $user->id);
                session()->put('user_name', $user->name);
                session()->put('user_level', $user->level);

                // เปลี่ยนเส้นทางไปยังหน้า dashboard
                $this->redirect('/dashboard');
            } else {
                $this->error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }
        }
    }

    /**
     * render ฟังก์ชันที่ใช้แสดง View ของคอมโพเนนต์นี้
     */
    public function render()
    {
        return view('livewire.signin');
    }
}
