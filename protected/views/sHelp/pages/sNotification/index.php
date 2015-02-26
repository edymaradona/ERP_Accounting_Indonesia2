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
        Notification Manager
    </h1>
</div>

<p>Halaman ini terdiri dari dua kolom yaitu
<ul>
    <li>Kolom kanan, berisi daftar notifikasi untuk user yang login. Baris notifikasi yang sudah dibaca memiliki warna
        background putih, sedangkan notifikasi yang belum dibaca memiliki warna background abu-abu. Untuk menyatakan
        notifikasi sudah dibaca, klik button Mark All as Read
    </li>
    <li>Kolom kiri, berisi daftar album foto kegiatan</li>
</ul>
<img src="/images/man/sNotification.jpg">