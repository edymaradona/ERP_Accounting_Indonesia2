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
        Leave Cancellation
    </h1>
</div>

<p>
    Halaman ini menampilkan form untuk membatalkan cuti pegawai. Untuk membatalkan cuti, isi informasi pembatalan cuti
    pada form tersebut, yang terdiri dari
<ul>
    <li>Employee Name, nama pegawai yang mengajukan pembatalan cuti. Untuk mencari pegawai, ketik sebagian nama pegawai
        tersebut, maka APHRIS akan menampilkan daftar pegawai yang namanya seperti nama yang dicari, kemudian pilih
        salah satu pegawai <br><img src="/images/man/autocomplete-name.jpg"></li>
    <li>Input Date, tanggal pengisian form. Tanggal ini sudah di set oleh APHRIS, dan tidak dapat diubah</li>
    <li>Start Date of Leave, tanggal mulai pembatalan cuti. Untuk menginput, klik kotak isian, maka APHRIS akan
        menampiilkan datepicker untuk memilih tanggal <br><img src="/images/man/select_date.jpg"></li>
    <li>End Date of Leave, tanggal selesai pembatalan cuti. Cara input sama dengan input Start Date of Leave</li>
    <li>Number of Days, jumlah hari cuti yang dibatalkan</li>
    <li>Reason, alasan pembatalan cuti</li>
</ul>
<p><img src="/images/man/m1_gLeave_cancellation.jpg"></p>