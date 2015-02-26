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
        Daftar Thread
    </h1>
</div>

<p>Halaman ini menampilkan daftar thread/diskusi yang termasuk dalam forum/kelompok thread tertentu.
    Ada dua jenis thread yaitu
<ul>
    <li>Sticky Thread: thread yang selalu tampil di bagian atas, agar mudah dicari</li>
    <li>Normal Thread: thread diurutkan berdasarkan waktu aktifitas (tambah, reply) terbaru</li>
</ul>
Beberapa fungsi yang dapat dilakukan adalah
<ul>
    <li>Untuk melihat pembicaraan pada thread tertentu, klik judul thread</li>
    <li>Untuk membuat thread baru, klik button New Thread</li>
</ul>


<img src="/images/man/forum_forum_view.jpg">