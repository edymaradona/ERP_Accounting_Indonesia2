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
        Update Password User
    </h1>
</div>

<p>Halaman ini digunakan untuk melihat data user. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi form ubah password user. Form ini terdiri dari input
        <ul>
            <li>Password, untuk mengisikan password baru</li>
            <li>Password repeat, untuk mengisikan konfirmasi password baru</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Button Create New User Registration, link ke halaman tambah user baru</li>
            <li>Home, link ke daftar user pelamar</li>
            <li>View, link ke halaman lihat detil user</li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/sUserRegistration_updatePassword.jpg">