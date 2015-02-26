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
        Create Permission
    </h1>
</div>

<p>
    Halaman ini digunakan untuk menginput data ijin harian pegawai. Untuk menginput ijin harian pegawai, lakukan hal
    berikut
<ul>
    <li>Isi form ijin, yang terdiri dari:
        <ul>
            <li>Input Date, tanggal ijin</li>
            <li>Permission Type, jenis ijin</li>
            <li>Permission Reason, alasan ijin</li>
            <li>Start Date/Time, jam mulai ijin</li>
            <li>End Date/Time, jam selesai ijin</li>
            <li>Number of Day, jumlah hari ijin</li>
        </ul>
    </li>
    <li>klik tombol Create</li>
</ul>
<p><img src="/images/man/m1_gEss_createPermission.jpg"></p>
