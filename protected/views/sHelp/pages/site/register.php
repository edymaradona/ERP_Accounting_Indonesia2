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
        ESS (Employee Self Service) Registration
    </h1>
</div>

<p>Halaman ini menampilkan form untuk melakukan registrasi user. Form ini berisi
<ul>
    <li>Username, username user yang akan diregister</li>
    <li>Activation Code, kode aktifasi yang diberikan oleh administrator</li>
    <li>Password, password yang akan digunakan untuk mengakses APHRIS</li>
    <li>Password Repeat, password yang akan digunakan untuk mengakses APHRIS. Input pada password dan password repeat
        harus sama.
    </li>
</ul>
<img src="/images/man/site_register.jpg">