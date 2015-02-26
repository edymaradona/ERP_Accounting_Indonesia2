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
        Leave
    </h1>
</div>

<p>
    Halaman ini menampilkan data cuti Anda. Pada bagian atas daftar cuti, menampilkanl
<ul>
    <li>Informasi
        <ul>
            <li>Join date, tanggal bergabung dengan perusahaan</li>
            <li>Balance, sisa cuti pada tahun berjalan</li>
        </ul>
    </li>
    <li>Tabel cuti, memiliki kolom
        <ul>
            <li>Start Date of Leave, tanggal mulai cuti</li>
            <li>End Date of Leave, tanggal selesai cuti</li>
            <li>Number of Working Days, jumlah cuti yang diambil yang merupakan hari kerja</li>
            <li>Reason, alasan cuti</li>
            <li>Balance, sisa jatah cuti</li>
            <li>Superior State, status persetujuan cuti dari atasan</li>
            <li>HR State, status cuti persetujuan cuti dari HR admin</li>
        </ul>
    </li>
    <li>Department Leave Calendar, menampilkan jadwal cuti di departemen user yang login

    </li>
</ul>
<p><img src="/images/man/m1_gEss_leave2.jpg"></p>
