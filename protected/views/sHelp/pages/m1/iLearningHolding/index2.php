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
        Learning List
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri terdiri dari
        <ul>
            <li>Search Form untuk mencari topik training berdasarkan nama topik training</li>
            <li>Daftar detil topik training yang disediakan, dengan detil terdiri dari
                <ul>
                    <li>Objective: targat yang ingin dicapai dengan diadakannya training topik tersebut</li>
                    <li>Outline: materi yang disampaikan</li>
                    <li>Target Participant: jenis peserta yang disarankan mengikuti training topik tersebut</li>
                    <li>Duration: lama training (dalam satuan jam)</li>
                    <li>Type: jenis training</li>
                    <li>Schedule List: jadwal training untuk topik tersebut</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>Kolom kanan berisi</li>
    <ul>
        <li>Learning Calendar, link ke halaman utama training</li>
        <li>List By Date, link ke daftar training pada bulan berjalan</li>
    </ul>
</ul>

<img src="/images/man/m1_iLearningHolding_index2.jpg">