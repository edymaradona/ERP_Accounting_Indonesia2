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
        User Management
    </h1>
</div>

<p>Untuk melakukan administrasi data user, Anda dapat meng-klik
    sub menu User Management di Menu Administratiror. Kemudian APHRIS
    akan menampilkan halaman User Management yang terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi Filter Organisasi. Filter Organisasi berisi
            daftar organisasi yang dapat Anda gunakan untuk menyaring
            user sehingga hanya menampilkan user dari organisasi
            tertentu</li>
    <li><p>Kolom tengah berisi
        <ul>
            <li>Form search user</li>
            <li>Detil singkat para user. Username adalah link ke halaman lihat detil user.
                Rights adalah link ke halamana manajemen hak akses untuk user tersebut.
            </li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Create New User untuk membuka
                halaman pendaftaran user
            </li>
            <li>Operation berisi
                <ul>
                    <li>Home, link ke halaman Personel
                        Administration
                    </li>
                    <li>Rights, link ke halaman daftar hak akses</li>
                    <li>Modules, link ke halaman daftar modul</li>
                </ul>
            </li>
            <li>Recent Added berisi daftar user yang datanya baru ditambahkan</li>
            <li>Other Menu berisi daftar user yang mengakses APHRIS</li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/sUser_index.jpg">