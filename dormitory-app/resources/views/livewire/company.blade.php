<div class="max-w-5xl mx-auto p-6">
    <div class="content-header mb-6">
        <h3 class="text-2xl font-semibold text-gray-800">ข้อมูลสถานประกอบการ</h3>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-3 gap-6">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">ชื่อสถานประกอบการ</label>
                <input type="text" class="btn-input-form-company" wire:model="name">
            </div>
            <div class="space-y-2">
                <label for="address" class="block text-sm font-medium text-gray-700">ที่อยู่</label>
                <input type="text" class="btn-input-form-company" wire:model="address">
            </div>
            <div class="space-y-1">
                <label for="phone" class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
                <input type="text" class="btn-input-form-company" wire:model="phone">
            </div>
        </div>

        <div class="space-y-1">
            <label for="tax_code" class="block text-sm font-medium text-gray-700">เลขประจำตัวผู้เสียภาษี</label>
            <input type="text" class="btn-input-form-company" wire:model="tax_code">
        </div>

        <div class="space-y-1">
            @if ($logoUrl)
                <div class="p-2 bg-white border border-gray-200 inline-block rounded">
                    <img src="{{ $logoUrl }}" alt="Logo" class="w-20 h-20 object-cover">
                </div>
            @endif

            <div class="space-y-1">
                <label for="logo" class="block text-sm font-medium text-gray-700">โลโก้</label>
                <input type="file" class="btn-input-form-company" wire:model="logo">
            </div>

            <div class="flex gap-3">
                <div class="w-1/5 mt-3">
                    <div>
                        <div for="amount_water" class="text-rigth">ค่าน้ำ/เหือน</div>
                        <input type="number" class="btn-input-form-company text-rigth" wire:model="amount_water">
                    </div>
                </div>
                <div class="w-1/5 mt-3">
                    <div>
                        <div for="amount_water_per_unit" class="text-rigth">ค่าน้ำ/หน่วย</div>
                        <input type="number" class="btn-input-form-company text-rigth"
                            wire:model="amount_water_per_unit">
                    </div>
                </div>
                <div class="w-1/5 mt-3">
                    <div>
                        <div for="amount_water_per_unit" class="text-rigth">ค่าไฟฟ้า/หน่วย</div>
                        <input type="number" class="btn-input-form-company text-rigth"
                            wire:model="amount_electric_per_unit">
                    </div>
                </div>
                <div class="w-1/5 mt-3">
                    <div>
                        <div for="amount_water_per_unit" class="text-rigth">ค่าอินเตอร์เน็ต</div>
                        <input type="number" class="btn-input-form-company text-rigth" wire:model="amount_internet">
                    </div>
                </div>
                <div class="w-1/5 mt-3">
                    <div>
                        <div for="amount_etc" class="text-rigth">อื่นๆ</div>
                        <input type="number" class="btn-input-form-company text-rigth" wire:model="amount_etc">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-1">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-200 inline-flex items-center">
                <i class="fa-solid fa-check mr-2"></i>
                บันทึก
            </button>
        </div>

        @if ($flashMessage)
            <div
                class="alert alert-success">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ $flashMessage }}
            </div>
        @endif
    </form>
</div>
