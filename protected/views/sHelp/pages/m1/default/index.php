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
        Main Dashboard
    </h1>
</div>

<p>
    Halaman ini menampilkan statistik jumlah pegawai dalam bentuk chart, yaitu
<ul>
    <li>Total Employee per Month, perbandingan jumlah pegawai per bulan pada tahun berjalan</li>
    <li>Employees In and Out by Month, perbandingan jumlah pegawai baru masuk dan baru keluar per bulan pada tahun
        berjalan
    </li>
    <li>Promotion-Mutation-Demotion, perbandingan jumlah pegawai yang dipromosikan, dimutasi, dan didemosi per bulan
        pada tahun berjalan
    </li>
</ul>
<p><img src="/images/man/m1_default.jpg"></p>
<br><br>