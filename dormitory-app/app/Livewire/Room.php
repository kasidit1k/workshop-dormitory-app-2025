<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomModel;

// คลาส Room สืบทอดจาก Component
class Room extends Component
{
    public $rooms = [];
    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;
    public $id;
    public $name;
    public $price_day;
    public $price_month;
    public $from_number;
    public $to_number;
    public $price_per_day;
    public $price_per_month;
    public $nameForDelete;

    // ฟังก์ชันที่ทำงานเมื่อ Component ถูกโหลด
    public function mount(){
        $this->fetchData();
    }

    // ฟังก์ชันสำหรับเปิด Modal เพิ่มข้อมูล
    public function openModal(){
        $this->showModal = true;
        $this->from_number = '';
        $this->to_number = '';
        $this->price_per_day = '';
        $this->price_per_month = '';
    }

    // ฟังก์ชันสำหรับเปิด Modal แก้ไขข้อมูล
    public function openModalEdit($id){
        $this->showModalEdit = true;
        $this->id = $id;

        $room = RoomModel::find($id);
        $this->name = $room->name;
        $this->price_day = $room->price_per_day;
        $this->price_month = $room->price_per_month;
    }

    // ฟังก์ชันสำหรับเปิด Modal ลบข้อมูล
    public function openModalDelete($id){
        $this->showModalDelete = true;
        $this->id = $id;

        $room = RoomModel::find($id);
        $this->nameForDelete = $room->name;
    }

    // ฟังก์ชันสำหรับอัพเดทข้อมูลห้องพัก
    public function updateRoom(){
        $room = RoomModel::find($this->id);
        $room->name = $this->name;
        $room->price_per_day = $this->price_day;
        $room->price_per_month = $this->price_month;
        $room->save();

        $this->showModalEdit = false;
        $this->fetchData();
    }

    // ฟังก์ชันสำหรับลบข้อมูลห้องพัก
    public function deleteRoom(){
        $room = RoomModel::find($this->id);
        $room->status = 'delete';
        $room->save();

        $this->showModalDelete = false;
        $this->fetchData();
    }

    // ฟังก์ชันสำหรับดึงข้อมูลห้องพัก
    public function fetchData(){
        $this->rooms = RoomModel::where('status', 'use')
            ->orderBy('id', 'asc')
            ->get();
    }

    // ฟังก์ชันสำหรับสร้างห้องพัก
    public function createRoom(){
        $this->validate([
            'from_number' => 'required',
            'to_number' => 'required',
            'price_per_day' => 'required',
            'price_per_month' => 'required',
        ]);

        if($this->from_number > $this->to_number) {
            $this->addError('from_number', 'หมายเลขจากต้องน้อยกว่าหมายเลขถึง');
            return;
        }

        if($this->to_number > 1000) {
            $this->addError('to_number', 'หมายเลขถึงต้องน้อยกว่า 1000');
            return;
        }

        for ($i = $this->from_number; $i <= $this->to_number; $i++) {
            $room = new RoomModel();
            $room->name = $i;
            $room->price_per_day = $this->price_per_day;
            $room->price_per_month = $this->price_per_month;
            $room->status = 'use';
            $room->save();
        }

        $this->showModal = false;
        $this->fetchData();
    }

    // ฟังก์ชันสำหรับปิด Modal
    public function render()
    {
        return view('livewire.room');
    }
}