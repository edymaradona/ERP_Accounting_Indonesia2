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
        Report
    </h1>
</div>

<p>
    Halaman ini menampilkan daftar report training, yaitu
<ul>
    <li>Training by Employee: daftar pegawai dan training yang pernah diikuti.
        <img src="/images/man/m1_iLearning_report_by_employee.jpg">
    </li>
    <li>Training by Month (tahun berjalan): daftar peserta semua topik training yang diadakan pada tahun berjalan
        dikelompokkan per bulan
        <img src="/images/man/m1_iLearning_report_by_month.jpg">
    </li>
</ul>