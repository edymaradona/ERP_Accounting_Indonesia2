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
        Operation Management
    </h1>
</div>

<p>Halaman ini menampilkan daftar operation.
    Pada bagian atas daftar operation, terdapat button Create a new operation, yang merupakan link ke halaman tambah
    operation.
    Nama operation adalah link ke halaman update operation.
    Untuk menghapus operation, klik link Delete, maka akan ditampilkan konfirmasi hapus <img
        src="/images/man/konfirmasi_delete.jpg">.
    Klik OK untuk menghapus operation, atau Cancel untuk batal menghapus operation.
    <BR>

    <img src="/images/man/rights_authItem_operations.jpg">