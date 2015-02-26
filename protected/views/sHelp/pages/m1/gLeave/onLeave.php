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
        Ongoing Leave
    </h1>
</div>

<p>
    Halaman ini menampilkan data cuti pegawai yang sedang diambil.
    Tabel cuti Employee on Leave, memiliki kolom
<ul>
    <li>Foto, foto pegawai yang mengajukan cuti</li>
    <li>Name, nama pegawai yang mengajukan cuti</li>
    <li>Department, nama departemen tempat bekerja pegawai yang mengajukan cuti</li>
    <li>Start - End Date, tanggal mulai dan selesai cuti</li>
    <li>Number of Days, jumlah hari cuti yang diambil</li>
    <li>Reason, alasan cuti</li>
    <li>Balance, sisa jatah cuti</li>
    <li>Superior Status, status persetujuan cuti dari atasan</li>
    <li>HR Status, status cuti persetujuan cuti dari HR admin</li>
    <li>Created By, username yang memasukkan data cuti</li>
</ul>
<p><img src="/images/man/m1_gLeave_onLeave.jpg"></p>

<p>Pada bagian atas daftar cuti, terdapat input untuk mencari nama pegawai yang mengajukan cuti. Data cuti dikelompokkan
    menjadi empat golongan yaitu
<ul>
    <li>Waiting for Approval, cuti yang menunggu persetujuan</li>
    <li>Approved Leave, cuti yang sudah disetujui</li>
    <li>Employee on Leave, cuti yang sedang berjalan</li>
    <li>Recent Leave, cuti yang sudah selesai</li>
</ul>
