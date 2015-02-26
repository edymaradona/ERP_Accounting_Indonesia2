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
        Business Unit News
    </h1>
</div>

<p>Halaman ini terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri atas berisi daftar berita unit bisnis, yang terdiri dari kolom
        <ul>
            <li>Create Time, tanggal pembuatan berita</li>
            <li>Publish Date, tanggal terbit berita</li>
            <li>Author, penulis</li>
            <li>Company, perusahaan</li>
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
    <li>Bagian kiri bawah berisi form upload foto kegiatan unit bisnis, yang terdiri dari
        <ul>
            <li>Date, tanggal foto</li>
            <li>Title, judul foto</li>
            <li>Description, keterangan foto</li>
            <li>Upload Files, untuk memilih file yang akan diupload klik Browse, sistem akan menampilkan window untuk
                memilih file yang akan diupload <img src="/images/man/upload_foto.jpg">. Pilih file yang akan diupload,
                lalu klik Open.
            </li>
            <li>Upload, setelah memilih file, klik Upload untuk mengupload foto, maka foto unit bisnis akan ditampilkan
                di halaman login di bagian foto unit bisnis
            </li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Create New Business Unit News, link ke form untuk menambah berita unit bisnis</li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/m1_sCompanyNewsUnit.jpg">