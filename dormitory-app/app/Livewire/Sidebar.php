<?php


namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component 
{
    public $currentMenu = ''; // เก็บค่าเมนูที่ถูกเลือก

    public function mount()
    {
        $user_id = session()->get('user_id'); // อ่านค่า user_id จาก session

        if (!isset($user_id)) { // เช็คถ้าไม่มีค่าเปลี่ยนเส้นทางไปยังหน้า login
            return redirect()->to('/');
        }

        $this->currentMenu = session()->get('current_menu') ?? ''; 
    }

    public function changeMenu($menu)
    {
        session()->put('current_menu', $menu); // บันทึกค่าเมนูที่ถูกเลือก
        $this->currentMenu = $menu; // กำหนดค่าใหม่

        return redirect()->to('/' . $menu); 
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
