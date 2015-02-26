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
        Create Permission
    </h1>
</div>

<p>
    Halaman ini menampilkan form untuk mengajukan ijin pegawai. Untuk mengajukan ijin, isi informasi pengajuan ijin pada
    form tersebut, lalu klik tombol Create. Form pengajuan ijin terdiri dari
<ul>
    <li>Employee Name, nama pegawai yang mengajukan ijin. Untuk mencari pegawai, ketik sebagian nama pegawai tersebut,
        maka APHRIS akan menampilkan daftar pegawai yang namanya seperti nama yang dicari, kemudian pilih salah satu
        pegawai <br><img src="/images/man/autocomplete-name.jpg"></li>
    <li>Input Date, tanggal pengisian form. Tanggal ini tidak bisa diinput, karena sudah di set oleh APHRIS</li>
    <li>Start Date/Time, tanggal mulai ijin. Untuk menginput, klik kotak isian, maka APHRIS akan menampiilkan datepicker
        untuk memilih tanggal <br><img src="/images/man/select_date_time.jpg"></li>
    <li>End Date/Time, tanggal selesai ijin. Cara input sama dengan input Start Date of Leave</li>
    <li>Permission Type, jenis ijin</li>
    <li>Number of Day, jumlah hari ijin yang diajukan</li>
    <li>Permission Reason, alasan pengajuan ijin</li>
</ul>
<p><img src="/images/man/m1_gPermission_create.jpg"></p>