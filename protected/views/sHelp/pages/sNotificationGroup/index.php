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
        Notification Group
    </h1>
</div>

<p>Halaman ini terdiri dari dua kolom yaitu
<ul>
    <li>Kolom kiri, berisi tabel daftar grup notifikasi. Untuk melihat detil grup notifikasi, klik nama grup
        notifikasi
    </li>
    <li>Kolom kanan, berisi
        <ul>
            <li>Create New Notification Group, link ke halaman form untuk menambah grup notifikasi</li>
            <li>Recently Updated, daftar grup notifikasi yang baru diupdate</li>
            <li>Recently Added, daftar grup notifikasi yang baru ditambah</li>
        </ul>
    </li>
</ul>
<img src="/images/man/sNotificationGroup.jpg">