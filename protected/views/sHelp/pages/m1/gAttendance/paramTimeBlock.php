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
        Param Time Block
    </h1>
</div>

<p>
    Halaman ini terdiri dari dua bagian yaitu
</p>
<ul>
    <li>Daftar blok jam kerja. Untuk mengupdate blok jam kerja, klik icon <img src="/images/man/pencil.jpg">. Untuk
        menghapus blok jam kerja, klik icon <img src="/images/man/bin.jpg">.
    </li>
    <li>Form input blok jam kerja</li>
</ul>
<p><img src="/images/man/m1_gAttendance_paramTimeBlock.jpg"></p>
<br><br>

<p>Untuk menginput blok jam kerja, lakukan langkah berikut</p>
<ul>
    <li>Isi form input, yang terdiri dari:
        <ul>
            <li>Name, nama blok jam kerja</li>
            <li>In, jam masuk kerja. Ketik dengan format hh:mm (misal 20:30), atau gunakan slider <img
                    src="/images/man/select_time.jpg"></li>
            <li>Out, jam selesai kerja. Cara pengisian seperti pada input In.</li>
            <li>Rest In, jam mulai istirahat. Cara pengisian seperti pada input In.</li>
            <li>Rest Out, jam selesai istirahat. Cara pengisian seperti pada input In.</li>
            <li>Remark, keterangan tambahan</li>
        </ul>
    </li>
    <li>klik tombol Create</li>
</ul>

<p>Untuk mengubah blok jam kerja, lakukan langkah berikut</p>
<ul>
    <li>Klik icon <img src="/images/man/pencil.jpg">, APHRIS akan menampilkan <img
            src="/images/man/m1_gAttendance_paramTimeBlock_update.jpg"</li>
    <li>Isi form update, yang terdiri dari:
        <ul>
            <li>Name, nama blok jam kerja</li>
            <li>In, jam masuk kerja. Ketik dengan format hh:mm (misal 20:30), atau gunakan slider <img
                    src="/images/man/select_time.jpg"></li>
            <li>Out, jam selesai kerja. Cara pengisian seperti pada input In.</li>
            <li>Rest In, jam mulai istirahat. Cara pengisian seperti pada input In.</li>
            <li>Rest Out, jam selesai istirahat. Cara pengisian seperti pada input In.</li>
            <li>Remark, keterangan tambahan</li>
        </ul>
    </li>
    <li>klik tombol Save</li>
</ul>

<p>Untuk menghapus blok jam kerja, lakukan langkah berikut</p>
<ul>
    <li>klik icon <img src="/images/man/bin.jpg">, APHRIS akan meminta konfirmasi penghapusan data <br> <img
            src="/images/man/konfirmasi_delete.jpg"></li>
    <li>klik button OK untuk menghapus data blok jam kerja, atau button Cancel jika batal menghapus data blok jam
        kerja
    </li>
</ul>