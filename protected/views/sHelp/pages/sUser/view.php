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
        Lihat Detil User
    </h1>
</div>

<p>Halaman ini menampilkan detil user. Halaman ini terdiri dari 3 bagian yaitu:
<ul>
    <li>Kolom kiri, menampilkan struktur organisasi dalam bentuk tree. Angka disebelah nama organisasi menunjukkan
        jumlah user di organisasi tersebut.
    </li>
    <li>Kolom tengah, menampilkan data user, yaitu:
        <ul>
            <li>Detil user, menampilkan nama lengkap, username, organisasi tempat bekerja user tersebut, status user dan
                sso. SSO adalah link ke halaman detil kepegawaian user tersebut.
            </li>
            <li>Tab Module and Rights, menampilkan daftar peran user tersebut
                dan daftar modul yang dapat diakses user tersebut. Daftar modul adalah link yang akan ditampilkan di
                menu atas.
                Untuk menghilangkan hak akses user ke suatu modul, klik icon <img src="/images/man/bin.jpg"> pada modul
                yang akan dihapus.
                Untuk menambah modul yang dapat diakses user, gunakan form tambah modul yang berada di bawah daftar
                modul.
                Pilih modul yang mau ditambahkan, lalu klik Create, maka nama modul akan muncul di daftar modul dan di
                menu atas.
                <img src="/images/man/sUser_view_module_and_rights.jpg">
            </li>
            <li>Tab Entity Group, menampilkan</li>
            <li>Tab Notification Group, menampilkan</li>
            <li>Tab SSO, menampilkan form untuk</li>
        </ul>
    </li>
    <li>Kolom kanan, menampilkan
        <ul>
            <li>Home, link ke halaman daftar user</li>
            <li>Rights, link kle halaman daftalr rights user</li>
            <li>Update, link ke halaman update user</li>
            <li>Delete, link untuk menghapus user</li>
            <li>Update Password, link ke halaman ubah password user</li>
            <li>Duplicate, link untuk membuat user baru dengan data yang sama dengan user yang sedang diakses, namun
                dengan username berbeda.
            </li>
            <li>Set Non Active, link untuk me-non-aktifkan user. Link ini muncul jika status user adalah aktif</li>
            <li>Set Active, link untuk meng-aktifkan usler. Link ini muncul jika status user adalah non aktif</li>
            <li>Recently Added, daftar user yang baru ditambahkan</li>
        </ul>
    </li>
</ul>
