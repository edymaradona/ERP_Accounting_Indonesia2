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
        Pending Permission
    </h1>
</div>

<p>
    Halaman ini menampilkan data ijin yang ditunda.
    Tabel ijin Pending Permission, memiliki kolom
<ul>
    <li>Foto, foto pegawai yang mengajukan ijin</li>
    <li>Name, nama pegawai yang mengajukan ijin</li>
    <li>Department, nama departemen tempat bekerja pegawai yang mengajukan ijin</li>
    <li>Start Date/Time, tanggal jam mulai ijin
    <li>End Date/Time, tanggal jam selesai ijin</li>
    <li>Number of Day, jumlah hari ijin yang diambil</li>
    <li>Status, status ijin</li>
</ul>
<p><img src="/images/man/m1_gPermission_onPending.jpg"></p>
<p>Pada bagian atas daftar ijin, terdapat input untuk mencari nama pegawai yang mengajukan ijin. Data ijin dikelompokkan
    menjadi empat golongan yaitu
<ul>
    <li>Waiting for Approval, ijin yang menunggu persetujuan</li>
    <li>Approved Permission, ijin yang sudah disetujui</li>
    <li>Pending State, ijin yang dipending/tunda</li>
    <li>Employee on Permission, ijin yang sedang berjalan</li>
    <li>Recent Permission, ijin yang sudah selesai</li>
</ul>
