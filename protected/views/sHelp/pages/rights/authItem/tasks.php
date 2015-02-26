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
        Task Management
    </h1>
</div>

<p>Halaman ini menampilkan daftar task.
    Pada bagian atas daftar task, terdapat button Create a new task, yang merupakan link ke halaman tambah task.
    Nama task adalah link ke halaman update task.
    Untuk menghapus task, klik link Delete, maka akan ditampilkan konfirmasi <img
        src="/images/man/konfirmasi_delete.jpg">.
    Klik OK untuk menghapus task, atau Cancel untuk batal menghapus task.
    <BR>

    <img src="/images/man/rights_authItem_tasks.jpg">