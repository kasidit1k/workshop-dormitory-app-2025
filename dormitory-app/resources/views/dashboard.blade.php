{{-- ใช้ layout 'backoffice' ที่มีโครงสร้างหลักของหน้าเว็บ --}}
@extends('layouts.backoffice')

@section('content')
    {{-- ใช้ Livewire Component ชื่อ 'dashboard' --}}
    @livewire('dashboard')
@endsection
