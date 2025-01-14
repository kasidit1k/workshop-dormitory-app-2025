# PHP Laravel

## รู้จักกับ MVC

-   Model(M) คือ ส่วนที่เก็บข้อมูลของ Application (Back-End)
-   View(V) คือ ส่วนที่ทำงานฝั่ง (Front-End) หรือ หน้าตาของ Application เป็นส่วนที่ใว้ใช้แสดงผลข้อมูลด้วย HTML (Blade Template)
-   Controller(C) คือ ส่วนประมวลผลคำสั่งต่างๆ ใน Application โดยควบคุมการทำงานระหว่าง Model และ View (Back-End)
  
## Blade Layout
- ในส่วนของ View จะมีการนำเอา Blade Template มาใช้งาน ซึ่งเป็น Template Engine ที่สามารถทำ Layout ต่างๆ แยกออกจากกัน แล้วนำมาประกอบกัน เพื่อสร้างเป็นหน้าเว็บเพจได้ โดยไม่ต้องเขียนโค้ดเหมือนเดิมซ้ำๆ
- @yieId ใช้ในการสร้างตัวแปร

## Laravel Project Structure
    - app : เก็บส่วนหลักๆ ของโปรเจ็คอย่าง Controller และ Model ที่ใช้ในการประมวลผลและติดต่อกับฐานข้อมูล
    - config : เก็บส่วนการตั้งค่าต่างๆ ของโปรเจ็ค
    - database : เก็บส่วนที่จัดการกับ database ต่างๆ อย่าง migration และ seed data
    - public : เก็บส่วนที่ให้ user เห็นได้ เช่น ไฟล์ css, js และอื่นๆ และ ยังเก็บไฟล์ index.php ที่เป็นไฟล์เริ่มต้นของโปรเจ็ค
    - resources : เก็บส่วนของ View ทั้งหมด
    - routes : เก็บส่วนของไฟล์ที่ใช้กําหนดเส้นทางของ URL ที่ User เรียกเข้ามา
    - storage : เก็บส่วนของไฟล์ cache, session ต่างๆ 
    - vendor : เก็บ Package ต่างๆ ที่ใช้ Composer ติดตั้งเข้ามา 
    - .env – ไฟล์ที่ใช้ในการตั้งค่าส่วนต่างๆ ของโปรเจ็ค

## wire:model

-   wire:model เป็นคำสั่งที่ใช้สร้างการเชื่อมโยงแบบ Two-Way Data Binding ระหว่างฟิลด์ในฟอร์ม (HTML) กับตัวแปรใน Livewire Component
-   การทำงาน : เมื่อผู้ใช้ป้อนข้อมูลในฟอร์ม ข้อมูลจะถูกอัปเดตไปยังตัวแปรใน Component ทันที

## wire:click

-   wire:click เป็นคำสั่งที่ผูกการคลิกขององค์ประกอบ HTML เข้ากับฟังก์ชันใน Livewire Component
-   การทำงาน : เมื่อผู้ใช้คลิกองค์ประกอบที่มี wire:click จะเรียกใช้ฟังก์ชันใน Component ที่กำหนดไว้

## install Project

```
laravel new app
```

## php -S localhost:8000 -t public

```
php -S         : เรียกใช้ PHP built-in web server
localhost:8000 : กำหนดให้เซิร์ฟเวอร์ทำงานบน localhost และพอร์ต 8000
-t public      : ระบุให้ใช้โฟลเดอร์ public เป็น Document Root (โฟลเดอร์หลักที่เซิร์ฟเวอร์ใช้เป็นฐานสำหรับเสิร์ฟไฟล์)

```

## อ่านค่าอ่านไฟล์ Migration ทั้งหมดที่อยู่ในโฟลเดอร์ database/migrations เพื่อจะสร้าง Table ลง Record

```
php artisan migrate
```

## ลง Library Livewire เข้าใน Project

```
composer require livewire/livewire
```

## คำสั่งสร้าง config

```
php artisan livewire:publish --config
```

## คำสั่งสร้าง assets

```
php artisan livewire:publish --assets
```

## make components สร้างหน้า signin

```
php artisan make:livewire signin
```
##
```
php artisan storage:link
```

## คำสั่ง ติดตั้ง APEXCHARTS.JS เพื่อสร้างกราฟ

```
npm install apexcharts
```
