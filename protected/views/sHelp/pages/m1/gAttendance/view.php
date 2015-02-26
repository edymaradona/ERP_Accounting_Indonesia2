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
        Attendance per Month
    </h1>
</div>

<p>
    Halaman ini terdiri dari dua bagian yaitu
</p>

<ul>
    <li>Daftar, memiliki dua tab yaitu
        <ul>
            <li>Daftar absensi bulan berjalan. Untuk melihat daftar absen bulan lain, gunakan link Previous Month dan
                Next Month.
            </li>
            <li>Detil pegawai</li>
        </ul>
    </li>
    <li>Form input absen</li>
</ul>
<p><img src="/images/man/m1_gAttendance_view.jpg"></p>
<br><br>

<p>Untuk menginput data kehadiran, lakukan langkah berikut</p>
<ul>
    <li>Isi form input, yang terdiri dari:
        <ul>
            <li>Date, tanggal absen</li>
            <li>Real Pattern,</li>
            <li>In, jam masuk kerja. Ketik dengan format dd-mm-yyyy hh:mm (misal 30-03-2014 11:53), atau gunakan date
                time picker <br><img src="/images/man/select_date_time.jpg"></li>
            <li>Out, jam selesai kerja. Cara pengisian seperti pada input In.</li>
            <li>Remark, keterangan tambahan</li>
        </ul>
    </li>
    <li>klik tombol Create</li>
</ul>

<p>Untuk mengubah data kehadiran, lakukan langkah berikut</p>
<ul>
    <li>Klik icon <img src="/images/man/pencil.jpg">, APHRIS akan menampilkan <img
            src="/images/man/m1_gAttendance_view_update.jpg"</li>
    <li>Isi form update, yang terdiri dari:
        <ul>
            <li>Date, tanggal absen</li>
            <li>Real Pattern,</li>
            <li>In, jam masuk kerja. Ketik dengan format dd-mm-yyyy hh:mm (misal 30-03-2014 11:53), atau gunakan date
                time picker<br> <img src="/images/man/select_date_time.jpg"></li>
            <li>Out, jam selesai kerja. Cara pengisian seperti pada input In.</li>
            <li>Remark, keterangan tambahan</li>
        </ul>
    </li>
    <li>klik tombol Save</li>
</ul>

<p>Untuk menghapus data kehadiran, lakukan langkah berikut</p>
<ul>
    <li>klik icon <img src="/images/man/bin.jpg">, APHRIS akan meminta konfirmasi penghapusan data <br><img
            src="/images/man/konfirmasi_delete.jpg"></li>
    <li>klik button OK untuk menghapus data kehadiran, atau button Cancel jika batal menghapus data kehadiran</li>
</ul>