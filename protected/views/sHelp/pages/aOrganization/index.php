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
        Organization Structure
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri, menampilkan struktur organisasi seperti daftar folder yang dapat dibuka dan ditutup</li>
    <li>Kolom tengah, menampilkan form cari dan daftar . Untuk mencari organisasi, masukkan nama organisasi yang ingin
        dicari di input pencarian, lalu klik button Search
    </li>
    <li>Kolom kanan, menampilkan
        <ul>
            <li>Button Create New Organization, link ke halaman tambah organisasi baru</li>
            <li>Home, link ke halaman daftar organisasi</li>
            <li>Recently Updated, organisasi yang baru diubah datanya</li>
            <li>Recently Added, organisasi yang baru ditambahkan</li>
        </ul>
    </li>
</ul>

<BR>

<img src="/images/man/aOrganization.jpg">