<div>
    <div class="content-header">ผู้ใช้งาน</div>
    <div class="content-body">
        <button class="btn-info" wire:click="openModal">
            <i class="fa-solid fa-plus mr-2"></i>
            เพิ่มผู้ใช้งาน
        </button>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="text-left" width="200px">ชื่อ</th>
                    <th class="text-left">อีเมล</th>
                    <th class="text-left" width="80px">ระดับ</th>
                    <th class="text-center" width="130px">วันที่สร้าง</th>
                    <th width="130px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listUser as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td class="text-right">
                            <button class="btn-edit" wire:click="openModalEdit({{ $user->id }})">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button class="btn-delete"
                                wire:click="openModalDelete({{ $user->id }}, '{{ $user->name }}')">
                                <i class="fa-solid fa-times mr-2"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-modal wire:model="showModal" title="ผู้ใช้งาน">
        @if (isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

        <div>ชื่อ</div>
        <input type="text" wire:model="name" class="form-control" />

        <div class="mt-2">อีเมล</div>
        <input type="text" wire:model="email" class="form-control" />

        <div class="flex gap-2">
            <div class="w-1/2">
                <div class="mt-2">รหัสผ่าน</div>
                <input type="password" wire:model="password" class="form-control" />
            </div>
            <div class="w-1/2">
                <div class="mt-2">ยืนยันรหัสผ่าน</div>
                <input type="password" wire:model="password_confirmation" class="form-control" />
            </div>
        </div>

        <div class="mt-2">ระดับ</div>
        <select wire:model="level" class="form-control">
            @foreach ($listLevel as $level)
                <option value="{{ $level }}">{{ $level }}</option>
            @endforeach
        </select>

        <div class="mt-4 text-center">
            <button class="btn-success mr-2" wire:click="save">
                <i class="fa-solid fa-check mr-2"></i>
                บันทึก
            </button>
            <button class="btn-secondary" wire:click="closeModal">
                <i class="fa-solid fa-times mr-2"></i>
                ยกเลิก
            </button>
        </div>
    </x-modal>

    <x-modal-confirm showModalDelete="showModalDelete" title="ยืนยันการลบ"
        text="คุณต้องการลบผู้ใช้งาน {{ $nameForDelete }} หรือไม่?" clickConfirm="delete"
        clickCancel="closeModalDelete" />


</div>
