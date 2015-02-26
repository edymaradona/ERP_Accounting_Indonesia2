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
        Create Business Unit News
    </h1>
</div>

<p>Halaman ini terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri berisi form tambah berita unit bisnis, yang terdiri dari
        <ul>
            <li>Title, judul berita berupa link ke halaman preview berita</li>
            <li>Category, kategori berita</li>
            <li>Priority, prioritas</li>
            <li>Tags</li>
            <li>Approved, status persetujuan</li>
            <li>Publish Date, tanggal terbit berita. Jika input ini di klik maka akan keluar tampilan seperti <img
                    src="/images/man/select_date_time.jpg">. Pilih tanggal untuk menetapkan tanggal seleksi, dan gunakan
                slider hour dan minute untuk menetapkan waktu seleksi, lalu klik Done
            </li>
            <li>Expire Date, tanggal berita selesai diterbitkan/ditampilkan</li>
            <li>Content, isi berita. Pada input content terdapat tool sederhana untuk mem format isi berita. Formatting
                yang disediakan adalah
                <ul>
                    <li>Jenis teks: normal, heading 1, heading 2, heading 3</li>
                    <li>Warna teks</li>
                    <li>Style: bold, italic, underline</li>
                    <li>List: ordered (dengan angka), not ordered (dengan bullet)</li>
                    <li>Indentation</li>
                    <li>Insert link dan image</li>
                </ul>
            </li>
            <br>Untuk menambah berita unit bisnis baru, masukkan data berita di form tersebut,
            lalu klik Create
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke daftar berita unit bisnis</li>
            <li>Recently Updated, berita yang baru di-update</li>
            <li>Recently Added, berita yang baru ditambahkan</li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/sCompanyNewsUnit_create.jpg">