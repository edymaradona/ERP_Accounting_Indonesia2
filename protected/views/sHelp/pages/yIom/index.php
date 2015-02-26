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
        Inter Office Memo
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri atas berisi form search subject memo</li>
    <li>Bagian kiri bawah berisi daftar memo antar departemen, yang terdiri dari kolom
        <ul>
            <li>Number, nomor memo</li>
            <li>To, tujuan memo</li>
            <li>From, pembuat memo</li>
            <li>Subject, judul memo</li>
            <li>Date, tanggal pembuatan memo</li>
            <li>Username, user yang membuat memo</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Create New Inter Office Memo, link ke form untuk membuat memo</li>
            <li>Recently Updated, memo yang baru di-update</li>
            <li>Recently Added, memo yang baru ditambahkan</li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/yIom.jpg">