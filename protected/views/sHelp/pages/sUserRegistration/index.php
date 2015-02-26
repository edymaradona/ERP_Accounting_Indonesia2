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
        User Registration List
    </h1>
</div>

<p>Halaman ini menampilkan daftar user pelamar yang terdaftar di APHRIS.
    Pada kanan atas terdapat button Create New User Registration, digunakan
    untuk menambah user baru.
    Tabel daftar user memiliki beberapa kolom, yaitu:
<ul>
    <li>Email, alamat email user yang digunakan ketika registrasi</li>
    <li>Name, status approval registrasi</li>
    <li>Action, link ke halaman lihat detil, update dan hapus pelamar.</li>
    <li>Module Name, nama modul yang dapat diakses setelah melakukan registrasi</li>
    <li>Registration Time, perkiraan waktu user pelamar melakukan registrasi</li>
    <li>Applicant, nama pelamar, adalah link ke halaman detil pelamar</li>
</ul>
Pada bagian atas tabel terdapat input pencarian email dan nama modul.
<BR>

<img src="/images/man/sUserRegistration.jpg">