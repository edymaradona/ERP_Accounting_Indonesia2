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
        Yii Log
    </h1>
</div>

<p>Halaman ini menampilkan daftar error yang dialami user ketika mengakses www.agungpodomoro-aphris.com.
    Tabel terdiri dari kolom
<ul>
    <li>Kolom 1, berisi alamat IP pengakses, nama user yang mengalami dan waktu terjadinya error.</li>
    <li>Kolom 2, berisi detil error yang terjadi.</li>
</ul>
<img src="/images/man/sAdmin_yiiLog.jpg">