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

<p>Halaman ini menampilkan daftar data login user ke www.agungpodomoro-aphris.com.
    Tabel terdiri dari kolom
<ul>
    <li>IP Address, alamat IP yang digunakan user ketika login</li>
    <li>Log Time, waktu login user</li>
    <li>Browser Name, identitas browser yang digunakan</li>
</ul>
<img src="/images/man/sNotification_userHistory.jpg">