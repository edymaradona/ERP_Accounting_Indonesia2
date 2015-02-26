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
        Notification Group
    </h1>
</div>

<p>Halaman ini terdiri dari dua kolom yaitu
<ul>
    <li>Kolom kiri, terdiri dari tiga bagian, yaitu
        <ul>
            <li>Bagian kiri atas, menampilkan detil grup notifikasi yaitu nama, deskripsi, dan status</li>
            <li>Bagian kiri tengah, menampilkan daftar user yang terdaftar sebagai anggota grup notifikasi yang sedang
                dilihat. Untuk menghapus user dari grup notifikasi, lakukan langkah berikut
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus user grup notifikasi, atau button Cancel jika batal menghapus
                        user grup notifikasi.
                    </li>
                </ul>
            </li>
            <li>Bagian kiri bawah, menampilkan form untuk menambah user ke grup notifikasi. Untuk menambah user ke grup
                notifikasi, pilih user lalu klik Create.
            </li>
        </ul>
    </li>
    <li>Kolom kanan, berisi
        <ul>
            <li>Home, link ke daftar grup notifikasi</li>
            <li>Update, link ke form update grup notifikasi</li>
            <li>Recently Updated, daftar grup notifikasi yang baru diupdate</li>
            <li>Recently Added, daftar grup notifikasi yang baru ditambah</li>
        </ul>
    </li>
</ul>
<img src="/images/man/sNotificationGroup_view.jpg">