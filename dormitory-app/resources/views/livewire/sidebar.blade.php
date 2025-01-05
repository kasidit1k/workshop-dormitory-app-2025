<div class="sidebar">
    <div class="sidebar-header">
        <div class="text-center">Wavisorn 13.0</div>
    </div>
    <div class="sidebar-body">
        {{-- Menu  --}}
        <div class="menu">
            <ul>
                <li wire:click="changeMenu('dashboard')" @if ($currentMenu == 'dashboard') class="active" @endif>
                    <i class="fa-solid fa-chart-line me-2"></i>
                    Dashboard
                </li>
                <li wire:click="changeMenu('billing')" @if ($currentMenu == 'billing') class="active" @endif>
                    <i class="fa-solid fa-file-invoice me-2"></i>
                    ใบเสร็จรับเงิน
                </li>
                <li wire:click="changeMenu('pay')" @if ($currentMenu == 'pay') class="active" @endif>
                    <i class="fa-solid fa-receipt me-2"></i>
                    บันทึกค่าใช้จ่าย
                </li>
                <li wire:click="changeMenu('room')" @if ($currentMenu == 'room') class="active" @endif>
                    <i class="fa-solid fa-door-open me-2"></i>
                    ห้องพัก
                </li>
                <li wire:click="changeMenu('customer')" @if ($currentMenu == 'customer') class="active" @endif>
                    <i class="fa-solid fa-users me-2"></i>
                    ผู้เข้าพัก
                </li>
                <li wire:click="changeMenu('user')" @if ($currentMenu == 'user') class="active" @endif>
                    <i class="fa-solid fa-user-gear me-2"></i>
                    ผู้ใช้งาน
                </li>
                <li wire:click="changeMenu('company/index')" @if ($currentMenu == 'company/index') class="active" @endif>
                    <i class="fa-solid fa-building-user me-2"></i>
                    สถานประกอบการ
                </li>
            </ul>
        </div>
    </div>
</div>
