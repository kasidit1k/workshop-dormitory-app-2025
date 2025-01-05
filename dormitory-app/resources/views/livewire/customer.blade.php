<div>
    <div class="content-header">ผู้เข้าพัก</div>
    <div class="content-body">
        <button class="btn-info" wire:click="openModal">
            <i class="fa fa-plus mr-2"></i>
            เพิ่มผู้เข้าพัก
        </button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>เบอร์โทร</th>
                    <th>ห้องพัก</th>
                    <th>วันที่เข้าพัก</th>
                    <th>ประเภทการพัก</th>
                    <th>หมายเหตุ</th>
                    <th width="230px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->room->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($customer->created_at)) }}</td>
                        <td>{{ $customer->stay_type == 'd' ? 'รายวัน' : 'รายเดือน' }}</td>
                        <td>{{ $customer->remark }}</td>
                        <td class="text-center">
                            <button
                                class="btn-move"
                                wire:click="openModalMove({{ $customer->id }})">
                                <span class="text-base font-medium">ย้ายห้อง</span>
                            </button>
                            <button class="p-2 text-indigo-600 hover:text-indigo-800 transition-colors"
                                wire:click="openModalEdit({{ $customer->id }})">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button class="p-2 text-gray-600 hover:text-gray-800 transition-colors"
                                wire:click="openModalDelete({{ $customer->id }})">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal สำหรับเพิ่มผู้เข้าพัก และ แก้ไขผู้เข้าพัก และ ย้ายห้องพัก และ ลบผู้เข้าพัก --}}
    <x-modal wire:model="showModal" title="ผู้เข้าพัก">
        <div class="flex gap-2">
            <div class="w-1/2">
                <label>ชื่อ</label>
                <input type="text" class="form-control" wire:model="name">
            </div>
            <div class="w-1/2">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" wire:model="phone">
            </div>
        </div>
        <div class="flex gap-2 mt-3">
            <div class="w-1/2">
                <label>ห้องพัก</label>
                <select class="form-control" wire:model="roomId">
                    <option value="">เลือกห้องพัก</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/2">
                <label>วันที่เข้าพัก</label>
                <input type="date" class="form-control" wire:model="createdAt">
            </div>
            <div class="w-1/2">
                <label>ประเภทการพัก</label>
                <select class="form-control" wire:model="stayType">
                    <option value="d">รายวัน</option>
                    <option value="m">รายเดือน</option>
                </select>
            </div>
        </div>

        <div class="mt-3">ที่อยู่</div>
        <input type="text" class="form-control" wire:model="address">

        <div class="mt-3">หมายเหตุ</div>
        <textarea class="form-control" wire:model="remark"></textarea>

        <div class="mt-3 text-center">
            <button class="btn-success" wire:click="save">
                <i class="fa fa-check mr-2"></i>
                บันทึก
            </button>
            <button class="btn-secondary" wire:click="closeModal">
                <i class="fa fa-times mr-2"></i>
                ยกเลิก
            </button>
        </div>
    </x-modal>

    {{-- Modal ยืนยันการลบผู้เข้าพัก --}}
    <x-modal-confirm showModalDelete="showModalDelete" title="ลบผู้เข้าพัก" text="คุณต้องการลบผู้เข้าพักนี้หรือไม่?"
        clickConfirm="delete" clickCancel="closeModalDelete">
    </x-modal-confirm>

    {{-- Modal แก้ไขผู้เข้าพัก และ ย้ายห้องพัก --}}
    <x-modal wire:model="showModalMove" title="ย้ายห้องพัก">
        <div>ห้องใหม่</div>
        <select class="form-control" wire:model="roomIdMove">
            <option value="">เลือกห้องพัก</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}">
                    {{ $room->name }}
                </option>
            @endforeach
        </select>

        <div class="mt-3 text-center">
            <button class="btn-success" wire:click="move">
                <i class="fa fa-check mr-2"></i>
                บันทึก
            </button>
            <button class="btn-secondary" wire:click="closeModalMove">
                <i class="fa fa-times mr-2"></i>
                ยกเลิก
            </button>
        </div>
    </x-modal>
</div>
