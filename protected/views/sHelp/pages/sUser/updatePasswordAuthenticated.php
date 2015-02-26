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
        Ganti Password
    </h1>
</div>

<p>Halaman ini menampilkan form untuk mengubah password user, yang terdiri dari
<ul>
    <li>Salt, kode hashing, tidak dapat diubah</li>
    <li>Password, password baru</li>
    <li>Password Repeat, pengulangan password baru. Untuk mengganti password,
        Password dan Password Repeat harus sama.
    </li>
</ul>
Untuk mengubah password, isi form, lalu klik Save.
<img src="/images/man/sUser_updatePasswordAuthenticated.jpg">