<html>

Project ini sudah menggunakan service layer (repository pattern) dan form request validation . Untuk notifikasi alert nya menggunakan sweetalert . Penggunaan repositori pattern / service layer supaya mengurangi penulisan baris code yang berulang . Sehingga jika ada fitur yang sama baik dari API / Web dapat langsung menggunakan service layer tersebut . Juga agar pada tiap tiap controller hanya menggunakan baris code yang sedikit . Untuk collection API sudah saya cantumkan dengan nama file Nasabah Transaction.postman_collection.json

<br>======================Instalasi Project=======================
<br>1.Dowload repositories
<br>2.Buka terminal CMD dan arahkan ke project ini
<br>3.Jalankan composer i
<br>4.Ubah database env sesuaikan dengan yang diinginkan
<br>5.Jalankan php artisan key:generate
<br>6.Jalankan php artisan migrate
<br>7.Jalankan php artisan serve
<br>8.Buka http://localhost:8000 pada web browser 
<br>9.Selesai

<br>====================URL API===================================
<br>1.Nasabah
<br>Index [GET] http://localhost:8000/api/nasabah
<br>Show [GET] http://localhost:8000/api/nasabah/{id}
<br>Update [PUT] http://localhost:8000/api/nasabah/{id}
<br>Delete [DELETE] http://localhost:8000/api/nasabah/{id}
<br>2.Transaction
<br>Index [GET] http://localhost:8000/api/transaction
<br>Show [GET] http://localhost:8000/api/transaction/{id}
<br>Update [PUT] http://localhost:8000/api/transaction/{id}
<br>Delete [DELETE] http://localhost:8000/api/transaction/{id}
<br>3.Point
<br>Index [GET] http://localhost:8000/api/point
<br>4.Report
<br>Index [GET] http://localhost:8000/api/report


</html>
