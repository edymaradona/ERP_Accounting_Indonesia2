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
        Attendance
    </h1>
</div>

<p>
    Halaman ini menampilkan data absensi Anda pada bulan berjalan.
<ul>
    <li>Untuk melihat daftar absen bulan lain, gunakan link Previous Month dan Next Month di atas tabel</li>
    <li>Pattern O - Libur / Off, menandakan tanggal tersebut adalah hari libur</li>
    <li>??:?? pada kolom In atau Out, menandakan waktu datang atau waktu pulang tidak diketahui</li>
    <li>Jika kolom In dan kolom Out tidak diketahui, dan ternyata pada hari tersebut, adalah hari ijin pegawai, klik
        button Set Permission
    </li>
</ul>
<p><img src="/images/man/m1_gEss_attendance.jpg"></p>
