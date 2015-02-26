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
        Company News
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri atas berisi daftar berita unit bisnis, yang terdiri dari kolom
        <ul>
            <li>Create Time, tanggal pembuatan berita</li>
            <li>Publish Date, tanggal terbit berita</li>
            <li>Author, penulis</li>
            <li>Category, kategori berita</li>
            <li>Title, judul berita berupa link ke halaman preview berita</li>
            <li>Priority, prioritas</li>
            <li>Approved Status, status persetujuan</li>
            <li>Expire Date, tanggal berita selesai diterbitkan/ditampilkan</li>
        </ul>
        <br>Untuk mengubah data berita tertentu, lakukan langkah berikut:
        <ul>
            <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan
                ke halaman ubah Business Unit News seperti berikut <img
                    src="/images/man/m1_sCompanyNewsUnit_update.jpg"></li>
            <li>Ubah data di form tersebut, lalu klik Save</li>
        </ul>
        <br>Untuk menghapus data berita tertentu, lakukan langkah berikut
        <ul>
            <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
                penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
            <li>klik button OK untuk menghapus data berita unit bisnis, atau buutton Cancel jika batal menghapus data
                berita unit bisnis
            </li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Create New Company News, link ke form untuk menambah berita unit bisnis</li>
            <li>Recently Updated, berita yang baru di-update</li>
            <li>Recently Added, berita yang baru ditambahkan</li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/sCompanyNewsAdmin.jpg">