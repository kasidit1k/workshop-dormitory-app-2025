<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BillingModel;
use App\Models\CustomerModel;
use App\Models\RoomModel;
use App\Models\PayLogModel;

class Dashboard extends Component
{
    public $income = 0;
    public $roomFee = 0;
    public $debt = 0;
    public $pay = 0;
    public $incomeInMonths = [];
    public $incomePie = [];
    public $yearList = []; // ตัวแปรของกราฟแท่ง
    public $monthList = [
        'มกราคม',
        'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน',
        'ตุลาคม',
        'พฤศจิกายน',
        'ธันวาคม'
    ];
    public $selectedYear;
    public $selectedMonth;

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');

        // อ่านฟอร์ม url ถ้ามีการส่งค่า year และ month 
        if (request()->has('year') && request()->has('month')) {
            $this->selectedYear = request()->query('year');
            $this->selectedMonth = request()->query('month');
        }

        // สร้างรายการปี 5 ปีย้อนหลัง
        for ($i = 0; $i < 5; $i++) {
            $this->yearList[] = date('Y') - $i;
        }

        $this->fectchData(); // เรียกใช้ฟังก์ชันตอนที่เริ่มโหลดหน้าเว็บ
    }

    public function fectchData()
    { //เรียกใช้ตอนที่กดปุ่มและเรียกใช้ฟังก์ชันนี้

        // clear ค่าทุกรอบที่กรองข้อมูล
        $this->income = 0;
        $this->debt = 0;
        $this->pay = 0;

        // รายได้
        $incomes = BillingModel::where('status', 'paid')
            ->whereYear('created_at', $this->selectedYear) // กรองเฉพาะปีที่เลือก
            ->whereMonth('created_at', $this->selectedMonth) // กรองเฉพาะเดือนที่เลือก
            ->get();

        foreach ($incomes as $income) {
            $this->income += $income->sumAmount() + $income->money_added;
        }

        // ห้องว่าง
        $countCustomer = CustomerModel::where('status', 'use')->count();
        $countRoom = RoomModel::where('status', 'use')->count();

        $this->roomFee = $countRoom - $countCustomer;

        // ค้างจ่าย
        $waits = BillingModel::where('status', 'wait')
            ->whereYear('created_at', $this->selectedYear) 
            ->whereMonth('created_at', $this->selectedMonth) // กรองเฉพาะเดือนที่เลือก
            ->get();

        foreach ($waits as $wait) {
            $this->debt += $wait->sumAmount() + $wait->money_added;
        }

        // รายจ่าย
        $this->pay = PayLogModel::where('status', 'use')
            ->whereYear('pay_date', $this->selectedYear)
            ->whereMonth('pay_date', $this->selectedMonth)
            ->sum('amount');

            

        // รายได้ในแต่ละเดือน
        for ($i = 1; $i <= 12; $i++) {
            $billingsInMonth = BillingModel::where('status', 'paid')
                ->whereMonth('created_at', $i)
                ->get();
            $sum = 0;

            foreach ($billingsInMonth as $billing) {
                $sum += $billing->sumAmount() + $billing->money_added;
            }

            $this->incomeInMonths[$i] = $sum;
        }

        
        

        $incomeTypeDay = rand(1000, 10000);
        $incomeTypeMonth = rand(1000, 10000);

        $this->incomePie = [
            $incomeTypeDay,
            $incomeTypeMonth
        ];

        $this->dispatch('incomeUpdated');
    }


    // function เปลี่ยนปีและเดือน
    public function loadNewData() {
        return redirect()->to('/dashboard?year=' . $this->selectedYear  . '$month=' . $this->selectedMonth);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
