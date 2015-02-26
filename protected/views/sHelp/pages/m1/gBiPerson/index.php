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
        Search Personel
    </h1>
</div>

<p>Halaman ini digunakan untuk mencari pegawai dalam perusahaan tempat Anda bekerja. Parameter pencarian dimasukkan pada
    3 tab yaitu</p>
<ul>
    <li>Tab Field List, digunakan untuk memilih kolom yang ditampilkan pada hasil pencarian. <img
            src="/images/man/m1_gBiPerson_fieldlist.jpg">
        <ul>
            <li>Untuk menambah kolom, klik button Add Row dan pilih data pada dropdown field yang baru ditambahkan</li>
            <li>Untuk mengurangi kolom, klik Remove Row, data kolom akan di remove mulai dari bawah ke atas</li>
        </ul>
    </li>
    <li>Tab Filter, digunakan untuk menyaring data pegawai yang ditampilkan pada hasil pencarian. <img
            src="/images/man/m1_gBiPerson_filter.jpg">
        Untuk menambah kriteria penyaringan, lakukan hal berikut
        <ul>
            <li>Pilih kolom yang akan difilter di kolom Field</li>
            <li>Pilih operator yang digunakan di kolom Operator</li>
            <li>Pilih nilai yang membatasi kriteria di kolom Value</li>
        </ul>
        Untuk mengurangi kolom, klik Remove Row, data kolom akan di remove mulai dari bawah ke atas
    </li>
    <li>Tab Limit, digunakan untuk membatasi jumlah baris yang akan ditampilkan pada hasil pencarian. <img
            src="/images/man/m1_gBiPerson_limit.jpg"> Untuk memasukkan data pegawai yang sudah resign ke hasil
        pencarian, centang checkbox Include Resign Employee
    </li>
</ul>
Untuk mendownload hasil pencarian dalam bentuk file xls, centang checkbox Export to Excel. Setelah semua parameter pencarian dimasukkan, klik button Show.
<BR>

Misal untuk field list, filter dan limit seperti pada contoh di atas, digunakan untuk menampilkan 500 data pegawai dengan kolom Nama Pegawai, Status Kepegawaian dan Nama Departemen yang Job Title-nya mengandung kata Manager. Berikut adalah hasil pencariannya.
<img src="/images/man/m1_gBiPerson_result.jpg">