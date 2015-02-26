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
    <li>Kolom kiri, berisi form untuk mengupdate grup notifikasi</li>
    <li>Kolom kanan, berisi
        <ul>
            <li>List, link ke daftar grup notifikasi</li>
            <li>Create, link ke form tambah grup notifikasi</li>
            <li>View, link ke halaman detil grup notifikasi</li>
            <li>M</li>
        </ul>
    </li>
</ul>
<img src="/images/man/sNotificationGroup_view.jpg">