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
        Learning List by Date
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi daftar jadwal training yang diadakan, tabel ini terdiri dari kolom
        <ul>
            <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
            <li>Subject: topik training, berupa link ke detil topik training</li>
            <li>Trainer Name: nama trainer</li>
            <li>Location: lokasi tempat diadakannya training</li>
            <li>Additional Info: keterangan tambahan</li>
            <li>Status: status ketersediaan jadwal training</li>
        </ul>

    </li>
    <li>Kolom kanan berisi</li>
    <ul>
        <li>Learning Calendar, link ke halaman utama training</li>
        <li>List By Subject, link ke daftar topik training</li>
    </ul>
</ul>

<img src="/images/man/m1_iLearning_index3.jpg">