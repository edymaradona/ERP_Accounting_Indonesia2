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
    <li>Kolom kiri berisi 2 tab, yaitu
        <ul>
            <li>Tab Upcoming Event
                <br>
                <img src="/images/man/m1_iLearningHolding_index3_upcoming_events.jpg">
                <ul>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Subject: topik training, berupa link ke detil topik training</li>
                    <li>Trainer Name: nama trainer</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan jadwal training</li>
                    <li>Total Participant: jumlah peserta yang akan mengikuti training tersebut</li>
                </ul>
            </li>
            <li>Tab Past Event
                <br>
                <img src="/images/man/m1_iLearningHolding_index3_past_events.jpg">
                <ul>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Subject: topik training, berupa link ke detil topik training</li>
                    <li>Trainer Name: nama trainer</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan jadwal training</li>
                    <li>Actual Mandays: lama training, dengan satuan man day. Misal lama training adalah 4 jam (dari 8
                        jam kerja), maka mandays yang diisikan adalah 0.5
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>Kolom kanan berisi</li>
    <ul>
        <li>Learning Calendar, link ke halaman utama training</li>
        <li>List By Subject, link ke daftar topik training</li>
    </ul>
</ul>
