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
        View User
    </h1>
</div>

<p>Halaman ini digunakan untuk melihat data user. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi data user. Form ini terdiri dari input
        <ul>
            <li>Module Name, nama modul yang dapat diakses setelah registrasi</li>
            <li>Registration Date, tanggal registrasi</li>
            <li>Activation Code, kode aktivasi akun</li>
            <li>Email, alamat email user</li>
            <li>Password, password yang sudah di hash</li>
            <li>Name, status registrasi user</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Button Create New User Registration, link ke halaman tambah user baru</li>
            <li>Home, link ke daftar user pelamar</li>
            <li>Update, link ke halaman update user</li>
            <li>Update Password, link ke halaman ubah password user</li>
            <li>Delete, link untuk menghapus user</li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/sUserRegistration_view.jpg">