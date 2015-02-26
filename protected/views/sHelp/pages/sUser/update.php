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
        Lihat Detil User
    </h1>
</div>

<p>Halaman ini menampilkan detil user. Halaman ini terdiri dari 3 bagian yaitu:
<ul>
    <li>Kolom kiri, menampilkan form update user, yang terdiri dari
        <ul>
            <li>Full Name, nama lengkap user</li>
            <li>Username, username yang digunakan untuk login</li>
            <li>Default Group Name, organisasi tempat user bekerja</li>
            <li>Status, jika non active, user tidak dapat login</li>
            <li>Button Save, klik untuk menyimpan perubahan data user</li>
        </ul>
    </li>
    <li>Kolom kanan, menampilkan
        <ul>
            <li>Home, link ke halaman daftar user</li>
            <li>View, link ke halaman detil user</li>
            <li>Recently Added, daftar user yang baru ditambahkan</li>
        </ul>
    </li>
</ul>
<img src="/images/man/sUser_update.jpg">
