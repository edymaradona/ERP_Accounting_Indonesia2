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
        Rights Management
    </h1>
</div>

<p>Halaman ini terdiri dari dua bagian yaitu
<ul>
    <li>Bagian kiri, menampilkan daftar role yang dimiliki oleh seorang user.
        Untuk menghapus role dari seorang user, klik link Revoke pada role yang
        ingin dihapus.
    </li>
    <li>Bagian kanan, menampilkan form untuk menambahkan role ke user tersebut.
        Untuk menambah role ke user tersebut, pilih role yang ingin diberikan, rlalu klik button Assign,
        maka role tersebut akan muncul di daftar role user tersebut.
    </li>
</ul>
<BR>

<img src="/images/man/rights_assignment.jpg">