<?php


namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component 
{
    public $currentMenu = ''; // สร้างตัวแปร currentMenu เพื่อเก็บค่าของเมนูที่ถูกเลือก

    public function mount()
    {
        $user_id = session()->get('user_id'); // อ่านค่า user_id จาก session

        if (!isset($user_id)) { // ถ้าไม่มีค่า user_id ให้ทำการเปลี่ยนเส้นทางไปยังหน้า login
            return redirect()->to('/');
        }

        $this->currentMenu = session()->get('current_menu') ?? ''; // กำหนดค่าเริ่มต้นของ currentMenu จากค่าที่เก็บไว้ใน session
    }

    public function changeMenu($menu)
    {
        session()->put('current_menu', $menu); // บันทึกค่าของเมนูที่ถูกเลือกลงใน session
        $this->currentMenu = $menu; // กำหนดค่าของ currentMenu ใหม่

        return redirect()->to('/' . $menu); // ทำการเปลี่ยนเส้นทางไปยังเมนูที่ถูกเลือก
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
