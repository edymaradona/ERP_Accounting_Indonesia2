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
        Create New Organization
    </h1>
</div>

<p>Halaman ini digunakan untuk menambah data organisasi baru.
    Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi form create organisasi baru. Form ini terdiri dari input
        <ul>
            <li>Branch Code, kode organisasi</li>
            <li>Name, nama organisasi</li>
            <li>Company Code, kode perusahaan</li>
            <li>Ownership</li>
            <li>Area</li>
            <li>Company Type</li>
            <li>address, alamat organisasi</li>
            <li>Kode pos</li>
            <li>telephone, nomor telepon organisasi</li>
            <li>Fax</li>
            <li>Email</li>
            <li>Website</li>
            <li>Status</li>
            <li>Button Create, klik untuk menambahkan organisasi baru</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke daftar organisasi</li>
            <li>Recently Updated, organisasi yang baru diubah datanya</li>
            <li>Recently Added, organisasi yang baru ditambahkan</li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/aOrganization_create.jpg">