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
        Selection Detail
    </h1>
</div>

<p>Halaman ini terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi form update jadwal seleksi. Form ini terdiri dari
        <ul>
            <li>Category: jenis tahap seleksi</li>
            <li>Schedule Date: tanggal dan jam diadakan. jika input ini di klik maka akan keluar tampilan seperti <img
                    src="/images/man/select_date_time.jpg">. Pilih tanggal untuk menetapkan tanggal seleksi, dan gunakan
                slider hour dan minute untuk menetapkan waktu seleksi, lalu klik Done
            </li>
            <li>Additional Info: keterangan tambahan</li>
            <li>Status: status ketersediaan tempat</li>
        </ul>
        Untuk mengupdate data jadwal seleksi, ketikkan perubahan data, dan klik Save
    </li>

    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke halaman kalender jadwal seleksi</li>
            <li>View, link ke halaman view jadwal seleksi</li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/m1_jSelectionHolding_update.jpg">