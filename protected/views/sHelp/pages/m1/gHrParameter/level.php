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
        Parameter Level
    </h1>
</div>

<p>
    Halaman ini terdiri dari dua bagian yaitu
</p>
<ul>
    <li>Daftar level</li>
    <li>Form input level <br> <img src="/images/man/m1_gHrParameter_level.jpg"></li>
</ul>

<p>Untuk menginput level, lakukan langkah berikut</p>
<ul>
    <li>Isi form input, yang terdiri dari:
        <ul>
            <li>Parent, nama level atasan</li>
            <li>Sort, kode level untuk memudahkan sorting/pengurutan</li>
            <li>Name, nama level</li>
            <li>Golongan, golongan level</li>
        </ul>
    </li>
    <li>klik tombol Create, maka data level akan tampil di daftar level</li>
</ul>

<p>Untuk mengubah level, lakukan hal berikut</p>
<ul>
    <li>klik pada data yang ingin diubah, maka akan muncul tampilan seperti berikut<img
            src="/images/man/update_cell.jpg"></li>
    <li>lakukan perubahan data</li>
    <li>untuk mengubah klik tanda centang, untuk membatalkan perubahan klik tanda silang</li>

    <p>Untuk menghapus level, lakukan langkah berikut</p>
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <br><img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data level, atau button Cancel jika batal menghapus data level</li>
    </ul>