@extends('layouts.backoffice')
// ใช้คำสั่ง @extends เพื่อบอกว่าไฟล์นี้จะใช้เลย์เอาต์ (layout) ที่ชื่อว่า 'backoffice'
// โดยไฟล์ 'backoffice' จะเป็นไฟล์ที่มีโครงสร้างหลัก เช่น ส่วนหัว, ส่วนท้าย, เมนูด้านข้าง, และตำแหน่งสำหรับแสดงเนื้อหา
// เลย์เอาต์นี้จะถูกกำหนดในไฟล์ resources/views/layouts/backoffice.blade.php

@section('content')
// ใช้ @section เพื่อกำหนดเนื้อหาส่วนหนึ่งในหน้าเพจนี้ที่จะไปแทนที่ส่วนที่กำหนดใน layout 'backoffice'
// ส่วนนี้จะแทนที่ตำแหน่งที่ใช้ @yield('content') ใน layout 'backoffice'

    @livewire('dashboard')
// ใช้ @livewire เพื่อรวม Livewire component ที่ชื่อว่า 'dashboard' ลงในหน้าเพจนี้
// Livewire คือแพ็คเกจที่ใช้ในการสร้างส่วนประกอบ (component) ที่สามารถทำงานแบบ reactive โดยไม่ต้องรีโหลดหน้า
// การใช้ @livewire('dashboard') จะเรียกใช้ Component ที่ชื่อว่า 'Dashboard' ซึ่งถูกกำหนดในไฟล์ App/Http/Livewire/Dashboard.php
// ตัว Component นี้จะมีการจัดการข้อมูลและแสดงผลในหน้าเพจโดยอัตโนมัติ

@endsection
