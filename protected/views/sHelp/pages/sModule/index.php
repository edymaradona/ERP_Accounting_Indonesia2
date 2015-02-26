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
        Module Management
    </h1>
</div>

<p>Halaman ini memiliki tiga bagian yaitu,
<ul>
    <li>Kolom kiri, menampilkan struktur modul/menu di APHRIS</li>
    <li>Kolom kanan bagian atas, menampilkan daftar modul/menu, dengan kolom
        <ul>
            <li>Action, berisi icon/link update dan delete.
                Untuk mengupdate module, klik icon <img src="/images/man/pencil.jpg">, maka akan ditampilkan
                <img src="/images/man/sModule_update.jpg">. Ubah data module, lalu klik Save.
                Untuk menghapus module, klik icon <img src="/images/man/bin.jpg">, maka akan ditampilkan konfirmasi
                hapus
                <img src="/images/man/konfirmasi_delete.jpg">. Klik OK untuk menghapus, dan Cancel untuk membatalkan
                hapus.
            </li>
            <li>ID, nomor identifikasi unik</li>
            <li>Application,</li>
            <li>Sort, nomor urut tampilan di menu/sub menu</li>
            <li>Title, teks yang ditampikan di menu/sub menu, adalah link ke halaman detil module</li>
            <li>Link, link yang dituju jika menu/sub menu di klik</li>
            <li>Icon, icon yang ditampilkan di menu/sub menu</li>
        </ul>
    </li>
    <li>Kolom kanan bagian bawah, menampilkan form untuk menambah module baru ke APHRIS.
        Untuk menambahkan module baru, isikan data module lalu klik Create.
        Untuk menambahkan menu, pilih (ROOT) sebagai Parent ID, sedangkan untuk menambahkan sub menu, pilih selain
        (ROOT) sebagain Parent ID.
        Module yang Parent ID bukan (ROOT), akan muncul sebagai sub menu Parent ID yang dipilih.
    </li>
</ul>
<BR>

<img src="/images/man/sModule.jpg">