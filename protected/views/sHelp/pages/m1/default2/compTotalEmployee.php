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
        Comparison Based on Employee
    </h1>
</div>

<p>
    Halaman ini menampilkan statistik komposisi jumlah pegawai dalam bentuk chart, yaitu
<ul>
    <li>Total Employee Composition, perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL,
        berdasarkan bidang usaha
    </li>
    <li>Total Employee, jumlah gabungan pegawai dari semua perusahaan dalam Holding APL</li>
    <li>Total Employee by Holding Type, perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL,
        berdasarkan tipe kepemilikan
    </li>
    <li>Total Employee by Holding Type, perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL,
        berdasarkan tipe holding
    </li>
</ul>
<p><img src="/images/man/m1_default2_compTotalEmployee.jpg"></p>
<br><br>