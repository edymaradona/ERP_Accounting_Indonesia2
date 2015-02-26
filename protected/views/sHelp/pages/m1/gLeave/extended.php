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
        Leave Extension
    </h1>
</div>

<p>
    Halaman ini menampilkan form untuk memperpanjang cuti pegawai. Untuk memperpanjang cuti, isi informasi perpanjangan
    cuti pada form tersebut, yang terdiri dari
<ul>
    <li>Employee Name, nama pegawai yang mengajukan perpanjangan cuti. Untuk mencari pegawai, ketik sebagian nama
        pegawai tersebut, maka APHRIS akan menampilkan daftar pegawai yang namanya seperti nama yang dicari, kemudian
        pilih salah satu pegawai <br><img src="/images/man/autocomplete-name.jpg"></li>
    <li>Input Date, tanggal pengisian form. Tanggal ini tidak bisa diinput, karena sudah di set oleh APHRIS</li>
    <li>Start Date of Leave, tanggal mulai perpanjangan cuti. Untuk menginput, klik kotak isian, maka APHRIS akan
        menampiilkan datepicker untuk memilih tanggal<br> <img src="/images/man/select_date.jpg"></li>
    <li>End Date of Leave, tanggal selesai perpanjangan cuti. Cara input sama dengan input Start Date of Leave</li>
    <li>Number of Days, jumlah hari cuti yang diperpanjang</li>
    <li>Reason, alasan perpanjangan cuti</li>
</ul>
<p><img src="/images/man/m1_gLeave_extended.jpg"></p>