 # PHP Laravel

 ## รู้จักกับ MVC
 - Model(M) คือ ส่วนที่เก็บข้อมูลของ Application (Back-End)
 - View(V) คือ ส่วนที่ทำงานฝั่ง (Front-End) หรือ หน้าตาของ Application เป็นส่วนที่ใว้ใช้แสดงผลข้อมูลด้วย HTML (Blade Template)
 - Controller(C) คือ ส่วนประมวลผลคำสั่งต่างๆ ใน Application โดยควบคุมการทำงานระหว่าง Model และ View (Back-End) 
 
 
 ## install Project
 ```
 laravel new app
 ```

 ## php -S localhost:8000 -t public
 ```
 php -S: เรียกใช้ PHP built-in web server
 localhost:8000: กำหนดให้เซิร์ฟเวอร์ทำงานบน localhost และพอร์ต 8000
 -t public: ระบุให้ใช้โฟลเดอร์ public เป็น Document Root (โฟลเดอร์หลักที่เซิร์ฟเวอร์ใช้เป็นฐานสำหรับเสิร์ฟไฟล์)

 ```

 ## อ่านค่าสั่งที่อยู่ใน Laravel เพื่อจะสร้าง Table ลง Record
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

 ## คำสั่ง ติดตั้ง APEXCHARTS.JS
 ```
npm install apexcharts
 ```