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
        Update Role
    </h1>
</div>

<p>Halaman ini menampilkan form update dan detil role.
    Halaman ini terdiri dari dua bagian yaitu
<ul>
    <li>Form ubah role, untuk mengupdate role, ubah data role, lalu klik Save</li>
    <li>Daftar relasi parent, menampilkan role lain yang menjadi parent role yang sedang diakses</li>
    <li>Daftar relasi child, menampilkan role, task dan operation yang diassign ke role sedang diakses</li>
    <li>Form tambah child, untuk menambah child ke role yang sedang diakses, pilih salah satu dari role, task atau
        operation, lalu klik Add
    </li>
</ul>
<BR>

<img src="/images/man/rights_authItem_update_roles.jpg">

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Update Task
    </h1>
</div>

<p>Halaman ini menampilkan form update dan detil task.
    Halaman ini terdiri dari dua bagian yaitu
<ul>
    <li>Form ubah task, untuk mengupdate task, ubah data task, lalu klik Save</li>
    <li>Daftar relasi parent, menampilkan role dan task lain yang menjadi parent task yang sedang diakses</li>
    <li>Daftar relasi child, menampilkan task dan operation yang diassign ke task sedang diakses</li>
    <li>Form tambah child, untuk menambah child ke task yang sedang diakses, pilih salah satu dari task atau operation,
        lalu klik Add
    </li>
</ul>
<BR>

<img src="/images/man/rights_authItem_update_tasks.jpg">

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Update Operation
    </h1>
</div>

<p>Halaman ini menampilkan form update dan detil operation.
    Halaman ini terdiri dari dua bagian yaitu
<ul>
    <li>Form ubah operation, untuk mengupdate operation, ubah data operation, lalu klik Save</li>
    <li>Daftar relasi parent, menampilkan role, task dan operation lain yang menjadi parent operation yang sedang
        diakses
    </li>
    <li>Daftar relasi child, menampilkan operation yang diassign ke operation sedang diakses</li>
    <li>Form tambah child, untuk menambah child ke operation yang sedang diakses, pilih salah satu dari operation, lalu
        klik Add
    </li>
</ul>
<BR>

<img src="/images/man/rights_authItem_update_operations.jpg">