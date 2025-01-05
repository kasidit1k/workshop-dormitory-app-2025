<div class="bg-white rounded-lg shadow-sm">
    <div class="content-header border-b border-gray-100 p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">จัดการห้องพัก</h1>
            <div class="text-sm text-gray-600">
                จำนวนห้องทั้งหมด <span class="font-medium text-indigo-600">{{ $rooms->count() }}</span> ห้อง
            </div>
        </div>
    </div>

    <div class="content-body p-6">
        <button
            class="btn-info"
            wire:click="openModal">
            <i class="fa-solid fa-plus mr-2"></i>
            เพิ่มห้องพัก
        </button>

        <div class="mt-6">
            <table class="table min-w-full">
                <thead>
                    <tr>
                        <th class="text-left font-medium">ห้องพัก</th>
                        <th class="text-right w-40 font-medium">ค่าเช่าต่อวัน</th>
                        <th class="text-right w-40 font-medium">ค่าเช่าต่อเดือน</th>
                        <th width="130px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td class="font-medium text-gray-700">{{ $room->name }}</td>
                            <td class="text-right text-gray-600">{{ number_format($room->price_per_day) }} บาท</td>
                            <td class="text-right text-gray-600">{{ number_format($room->price_per_month) }} บาท</td>
                            <td class="text-center">
                                <button class="btn-edit"
                                    wire:click="openModalEdit({{ $room->id }})">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn-delete"
                                    wire:click="openModalDelete({{ $room->id, $room->name }})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Room Modal -->
    <x-modal wire:model="showModal" title="เพิ่มห้องพักใหม่" maxWidth="xl">
        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-800 mb-2">สร้างห้องพักแบบจำนวนมาก</h2>
                <p class="text-sm text-gray-600">กรุณากรอกข้อมูลช่วงหมายเลขห้องและราคาที่ต้องการ</p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">หมายเลขห้องเริ่มต้น</label>
                    <input type="text" class="form-control" wire:model="from_number">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">หมายเลขห้องสิ้นสุด</label>
                    <input type="text" class="form-control" wire:model="to_number">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่าเช่าต่อวัน (บาท)</label>
                    <input type="number" class="form-control" wire:model="price_per_day">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่าเช่าต่อเดือน (บาท)</label>
                    <input type="number" class="form-control" wire:model="price_per_month">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <button
                    class="px-4 py-2 btn-secondary"
                    wire:click="showModal = false">
                    <i class="fa-solid fa-xmark mr-2"></i>
                    ยกเลิก
                </button>
                <button
                    class="px-4 py-2 btn-success" wire:click="createRoom">
                    <i class="fa-solid fa-check mr-2"></i>
                    สร้างห้องพัก
                </button>
            </div>
        </div>
    </x-modal>

    <!-- Edit Room Modal -->
    <x-modal wire:model="showModalEdit" title="แก้ไขข้อมูลห้องพัก" maxWidth="xl">
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อห้องพัก</label>
                <input type="text" class="form-control" wire:model="name">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ราคาเช่าต่อวัน (บาท)</label>
                <input type="number" class="form-control" wire:model="price_day">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ราคาเช่าต่อเดือน (บาท)</label>
                <input type="number" class="form-control" wire:model="price_month">
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                <button
                    class="btn-secondary"
                    wire:click="showModalEdit = false">
                    <i class="fa-solid fa-xmark mr-2"></i>
                    ยกเลิก
                </button>
                <button
                    class="btn-success"
                    wire:click="updateRoom">
                    <i class="fa-solid fa-check mr-2"></i>
                    บันทึก
                </button>
            </div>
        </div>
    </x-modal>


    <!-- Delete Confirmation Modal -->
    <x-modal-confirm showModalDelete="showModalDelete" title="ลบห้องพัก"
        text="ท่านต้องการลบห้องพัก {{ $nameForDelete }} ใช่หรือไม่?" clickConfirm="deleteRoom"
        clickCancel="showModalDelete = false" />
</div>
