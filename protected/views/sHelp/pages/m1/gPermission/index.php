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
        Permission
    </h1>
</div>

<p>
    Halaman ini menampilkan data ijin pegawai yang menunggu persetujuan.
    Tabel ijin Waiting for Approval, memiliki kolom
<ul>
    <li>Foto, foto pegawai yang mengajukan ijin</li>
    <li>Name, nama pegawai yang mengajukan ijin</li>
    <li>Department, nama departemen tempat bekerja pegawai yang mengajukan ijin</li>
    <li>Start - End Date, tanggal mulai dan selesai ijin</li>
    <li>Permission Type - Reason, jenis dan alasan ijin</li>
    <li>Superior Status, status persetujuan ijin dari atasan</li>
    <li>HR Status, status ijin persetujuan ijin dari HR admin</li>
    <li>Icon tempat sampah <img src="/images/man/bin.jpg"> untuk menghapus data ijin</li>
    <li>Button print <img src="/images/man/print.jpg"> untuk mendownload form pengajuan ijin</li>
    <li>Button Approved <img src="/images/man/approved.jpg"> untuk menyetujui data ijin</li>
</ul>
<p><img src="/images/man/m1_gPermission_waiting_for_approval.jpg"></p>

<p>Pada bagian atas daftar ijin, terdapat input untuk mencari nama pegawai yang mengajukan ijin. Data ijin dikelompokkan
    menjadi empat golongan yaitu
<ul>
    <li>Waiting for Approval, ijin yang menunggu persetujuan</li>
    <li>Approved Permission, ijin yang sudah disetujui</li>
    <li>Employee on Permission, ijin yang sedang berjalan</li>
    <li>Recent Permission, ijin yang sudah selesai</li>
</ul>
