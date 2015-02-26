<?php
$this->breadcrumbs = [
    'Help' => ['/m1/help'],
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/help']],
];
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        User Login History
    </h1>
</div>

<p>Halaman ini menampilkan daftar data login user yang mengakses www.agungpodomoro-aphris.com.
    Tabel terdiri dari kolom
<ul>
    <li>User Name, username user yang login</li>
    <li>Default Entity, organisasi asal user</li>
    <li>IP Address, alamat IP yang digunakan user ketika login</li>
    <li>Location, lokasi fisik user yang login, mungkin kosong jika tidak diketahui</li>
    <li>Log Time, waktu login user</li>
    <li>Browser Name, identitas browser yang digunakan</li>
</ul>
<img src="/images/man/sAdmin_userHistory.jpg">