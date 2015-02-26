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
        Comparison Based on Company Type
    </h1>
</div>

<p>
    Halaman ini menampilkan statistik komposisi jumlah pegawai dalam bentuk chart, yaitu
<ul>
    <li>Employee Composition (Holding), perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL,
        yang bertipe Holding
    </li>
    <li>Employee Composition (Developer), perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL,
        yang bertipe Developer
    </li>
    <li>Employee Composition (POM), perbandingan jumlah gabungan pegawai dari semua perusahaan dalam Holding APL, yang
        bertipe POM
    </li>
</ul>
<p><img src="/images/man/m1_default2_compCompanyType.jpg"></p>
<br><br>