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
        View Module
    </h1>
</div>

<p>Halaman ini memiliki tiga bagian yaitu,
<ul>
    <li>Kolom kiri, menampilkan struktur modul/menu di APHRIS</li>
    <li>Kolom tengah, memiliki dua bagian yaitu
        <ul>
            <li>Bagian atas, menampilkan detil modul/menu</li>
            <li>Bagian tengah, menampilkan daftar user yang dapat mengakses
                modul/menu tersebut. Daftar user terdiri dari kolom
                <ul>
                    <li>Username, berupa link ke halaman detil user</li>
                    <li>Nama organisasi, berupa link ke halaman detil organisasi</li>
                    <li>Status, jika active user dapat login, dan jika non aktif, user tidak dapat login ke APHRIS</li>
                    <li>Icon delete, untuk membuat seorang user tidak dapat mengakses suatu modul, klik icon <img
                            src="/images/man/bin.jpg">, maka akan ditampilkan konfirmasi hapus <img
                            src="/images/man/konfirmasi_delete.jpg">. Klik OK untuk menghapus, atau Cancel untuk
                        membatalkan.
                    </li>
                </ul>
            </li>
            <li>Bagian bawah, menampilkan form untuk menambah user ke daftar user
                yang dapat mengakses module/menu tersebut.
                Untuk menambah user, isikan sebagian username, maka akan ditampilkan daftar user yang username nya mirip
                <img src="/images/man/autocomplete-user.jpg"></li>
            . Pilih salah satu user yang diinginkan, lalu klik Create.
        </ul>
    </li>
    <li>Kolom kanan menampilkan
        <ul>
            <li>Home, link ke daftar modul/menu</li>
            <li>Other Menu, link ke model/menu yang lain</li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/sModule.jpg">