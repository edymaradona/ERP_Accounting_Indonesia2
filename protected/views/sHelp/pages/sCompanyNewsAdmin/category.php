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
        News Category
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri atas berisi daftar kategori berita holding, yang terdiri dari kolom
        <ul>
            <li>Sort, urutan</li>
            <li>Category, nama kategori</li>
            <li>Description, keterangan</li>
        </ul>
        <br>Untuk mengubah data kategori tertentu, lakukan langkah berikut:
        <ul>
            <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan
                ke menampilkan form ubah kategori berita seperti berikut <img
                    src="/images/man/sCompanyNewsUnit_category_update.jpg"></li>
            <li>Ubah data di form tersebut, lalu klik Save</li>
        </ul>
        <br>Untuk menghapus data kategori berita tertentu, lakukan langkah berikut
        <ul>
            <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
                penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
            <li>klik button OK untuk menghapus data kategori, atau buutton Cancel jika batal menghapus data kategori
            </li>
        </ul>
    </li>
    <li>Bagian kiri bawah berisi form tambah kategori berita unit bisnis, yang terdiri dari
        <ul>
            <li>Sort, urutan</li>
            <li>Category, nama kategori</li>
            <li>Description, keterangan</li>
        </ul>
        <br>Untuk menambah kategori berita holding, masukkan data kategori berita di form tersebut,
        lalu klik Create
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke halaman daftar berita holding</li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/sCompanyNewsAdmin_category.jpg">