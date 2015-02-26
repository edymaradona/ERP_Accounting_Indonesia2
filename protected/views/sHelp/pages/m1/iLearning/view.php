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
        Training Schedule
    </h1>
</div>

<p>
    Pada halaman ini terdapat 2 tab yaitu, yaitu
<ul>
    <li>Tab Schedule, berisi daftar jadwal training untuk topik tersebut. Tabel ini memiliki kolom
        <ul>
            <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
            <li>Trainer Name: nama trainer</li>
            <li>Location: lokasi tempat diadakannya training</li>
            <li>Additional Info: keterangan tambahan</li>
            <li>Status: status ketersediaan jadwal training</li>
        </ul>
        <img src="/images/man/m1_iLearning_view_schedule.jpg">
    </li>
    <li>Tab Detail, berisi data detil topik training, data detil tersebut adalah
        <ul>
            <li>Objective: targat yang ingin dicapai dengan diadakannya training topik tersebut</li>
            <li>Outline: materi yang disampaikan</li>
            <li>Target Participant: jenis peserta yang disarankan mengikuti training topik tersebut</li>
            <li>Duration: lama training (dalam satuan jam)</li>
            <li>Type: jenis training</li>
        </ul>
        <img src="/images/man/m1_iLearning_view_detail.jpg">
    </li>
</ul>