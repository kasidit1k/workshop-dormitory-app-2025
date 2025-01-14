<div class="navbar">
    <div class="flex items-center justify-between">
        <div>
            <i class="fa-solid fa-user me-2"></i>
            <span class="username">{{ $user_name }} ({{ $userLevel }}) </span>
        </div>
        <div>
            <button wire:click="editProfile"
                class="border border-blue-700 text-blue-700 px-6 py-2 rounded-lg hover:bg-gray-800 hover:text-white transition mr-2">
                <i class="fa-solid fa-user-pen me-2"></i>
                แก้ไขข้อมูล
            </button>

            {{-- ปุ่ม Sign Out --}}
            <button wire:click="showModal = true"
                class="border border-gray-700 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-800 hover:text-white transition">
                <span>ออกจากระบบ</span>
                <i class="fa-solid fa-right-from-bracket ms-3"></i>
            </button>
        </div>
    </div>

    {{-- ส่วนของ Modal เงื่อนไขสำหรับการยืนยันการออกจากระบบ  --}}
    <x-modal wire:model="showModal" maxWidth="sm" title="Sign Out">
        <div class="text-center">
            <!-- เปลี่ยนไอคอนเป็นสีเทาเข้ม -->
            <div><i class="fa-solid fa-sign-out-alt text-gray-700 text-5xl"></i></div>
            <!-- ปรับขนาดและสีตัวอักษรให้ดูเป็นทางการ -->
            <div class="text-2xl font-semibold text-gray-700 mt-4">ออกจากระบบ</div>
            <div class="text-gray-600 mt-3">คุณต้องการออกจากระบบหรือไม่</div>
        </div>
        <!-- ปรับปุ่มให้ดูเรียบและเป็นทางการ -->
        <div class="flex justify-center mt-6 space-x-4 pb-4">
            <button class="px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition duration-200"
                wire:click="logout">
                <i class="fa-solid fa-check me-2"></i>
                ยืนยัน
            </button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition duration-200"
                wire:click="showModal = false">
                <i class="fa-solid fa-xmark me-2"></i>
                ยกเลิก
            </button>
        </div>
    </x-modal>
    
    {{-- ส่วนของ Modal เงื่อนไขสำหรับการแก้ไขข้อมูลส่วนตัว --}}
    <x-modal wire:model="showModalEdit" maxWidth="sm" title="แก้ไขข้อมูลส่วนตัว">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div>ชื่อผู้ใช้</div>
        <input type="text" wire:model="username" class="form-control" />

        <div class="mt-3">รหัสผ่านใหม่</div>
        <input type="password" wire:model="password" class="form-control" />

        <div class="mt-5">ยืนยันรหัสผ่านใหม่</div>
        <input type="password" wire:model="password_confirm" class="form-control" />

        <div class="mt-5 text-center pb-5">
            <button class="px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition duration-200 mr-2"
                wire:click="updateProfile">
                <i class="fa-solid fa-check mr-2 text-lg"></i>
                บันทึก
            </button>

            <button
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition duration-200 mr-2"
                wire:click="showModalEdit = false">
                <i class="fa-solid fa-xmark me-2 text-lg"></i>
                ยกเลิก
            </button>
        </div>

        @if ($saveSuccess)
            <div class="alert alert-success">
                <i class="fa-solid fa-check mr-2"></i>
                บันทึกข้อมูลสำเร็จ
            </div>
        @endif
    </x-modal>
</div>
