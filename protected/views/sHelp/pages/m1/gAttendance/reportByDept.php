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
        Attendance Report
    </h1>
</div>

<p>
    Halaman ini digunakan untuk men-download laporan absensi per departmen. Untuk mendapatkan laporan tersebut, lakukan
    langkah berikut
<ul>
    <li>Pilih periode laporan dengan memilih tahun dan bulan pada widget periode
        <br><img src="/images/man/select_month.jpg"></li>
    <li>Pilih jenis laporan</li>
    <li>Klik button Report, APHRIS akan menampilkan window untuk menyimpan file <img src="/images/man/save_file.jpg">
    </li>
    <li>Klik Save untuk menyimpan file, atau Cancel untuk batal menyimpan file</li>
</ul>

<p>Isi file laporan akan terlihat seperti berikut</p>
<img src="/images/man/attendance_by_dept.jpg">