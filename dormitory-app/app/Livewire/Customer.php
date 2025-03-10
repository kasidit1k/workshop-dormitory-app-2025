<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CustomerModel;
use App\Models\RoomModel;

class Customer extends Component {
    public $customers = [];
    public $rooms = [];
    public $showModal = false;
    public $showModalDelete = false;
    public $showModalMove = false;
    public $id;
    public $name;
    public $address;
    public $phone;
    public $remark;
    public $roomId;
    public $createdAt;
    public $stayType = 'd'; // รายวัน, รายเดือน (d, m)
    public $roomIdMove;

    // ฟังก์ชันที่ทำงานเมื่อ Component ถูกโหลด 
    public function mount() {
        $this->fetchData();
        $this->createdAt = date('Y-m-d');
    }

    // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล 
    public function fetchData() {
        $this->customers = CustomerModel::where('status', 'use')
            ->orderBy('id', 'desc')
            ->get();
        
        $this->rooms = RoomModel::where('status', 'use')
            ->where('is_empty', 'yes')
            ->orderBy('name', 'asc')
            ->get();
    }

    // ฟังก์ชันเปิด Modal เพื่อเพิ่มข้อมูล
    public function openModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;
    }

    // ฟังก์ชันบันทึกข้อมูล หรือแก้ไขข้อมูล 
    public function save() {
        $customer = new CustomerModel();

        if ($this->id) {
            $customer = CustomerModel::find($this->id);
        } else {
            $customer->room_id = $this->roomId;
        }

        // update room status
        $room = RoomModel::find($this->roomId);
        $room->is_empty = 'no';
        $room->save();

        $price = $room->price_per_day;

        if ($this->stayType == 'm') {
            $price = $room->price_per_month;
        }

        $customer->name = $this->name;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
        $customer->remark = $this->remark;
        $customer->created_at = $this->createdAt;
        $customer->status = 'use';
        $customer->stay_type = $this->stayType;
        $customer->price = $price;
        $customer->save();

        $this->showModal = false;
        $this->id = null;

        $this->fetchData();
    }

    // ฟังก์ชันลบข้อมูล รับค่า id ของข้อมูลที่ต้องการลบ
    public function openModalDelete($id) {
        $this->showModalDelete = true;
        $this->id = $id;
    }

    // ฟังก์ชันแก้ไขข้อมูล และเปิด Modal แก้ไขข้อมูล โดยรับค่า id ของข้อมูลที่ต้องการแก้ไข 
    public function openModalEdit($id) {
        $this->showModal = true;
        $this->id = $id;

        $customer = CustomerModel::find($id);
        $this->name = $customer->name;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->remark = $customer->remark;
        $this->roomId = $customer->room_id;
        $this->createdAt = date('Y-m-d', strtotime($customer->created_at));
        $this->stayType = $customer->stay_type;
    }

    // ฟังก์ชันลบข้อมูล
    public function delete() {
        $customer = CustomerModel::find($this->id);
        $customer->status = 'delete';
        $customer->save();

        $room = RoomModel::find($customer->room_id);
        $room->is_empty = 'yes';
        $room->save();

        $this->showModalDelete = false;
        $this->fetchData();
    }

    // ฟังก์ชันยกเลิกการลบ
    public function closeModalDelete() {
        $this->showModalDelete = false;
    }

    public function render() {
        return view('livewire.customer');
    }

    public function openModalMove($id) {
        $this->showModalMove = true;
        $this->id = $id;
    }

    // ฟังก์ชันย้ายห้อง
    public function closeModalMove() {
        $this->showModalMove = false;
    }

    // ฟังก์ชันย้ายห้อง
    public function move() {
        $customer = CustomerModel::find($this->id);

        // old room 
        $room = RoomModel::find($customer->room_id);
        $room->is_empty = 'yes';
        $room->save();

        // new room
        $customer->room_id = $this->roomIdMove;
        $customer->save();

        // update status new room
        $room = RoomModel::find($this->roomIdMove);
        $room->is_empty = 'no';
        $room->save();

        $this->showModalMove = false;
        $this->fetchData();
    }
}