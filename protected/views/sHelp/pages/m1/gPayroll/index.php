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
        Payroll
    </h1>
</div>

<p>
    Halaman ini menampilkan data gaji pegawai yang dikelompokkan menjadi
<ul>
    <li>Join New/Join Continued, pegawai yang baru masuk</li>
    <li>Mutation, pegawai yang dimutasi</li>
    <li>Promotion, pegawai yang naik jabatan</li>
    <li>Demotion, pegawai yang turun jabatan</li>
    <li>Resign, pegawai yang keluar</li>
</ul>
Tabel-tabel tersebut, memiliki kolom
<ul>
    <li>Name, nama pegawai yang mengajukan cuti</li>
    <li>Department, nama departemen tempat bekerja pegawai yang mengajukan cuti</li>
    <li>Join Date, tanggal mulai dan selesai cuti</li>
    <li>Basic Salary, gaji pokok</li>
    <li>Benefit, tambahan gaji</li>
    <li>Deduction pengurang gaji</li>
    <li>Remark, catatan</li>
    <li>Status, status gaji</li>
</ul>

Pada bagian atas tabel terdapat dua link yaitu
<ul>
    <li>Dashboard, untuk melihat halaman dashboard payroll</li>
    <li>All Employee, untuk melihat payroll semua pegawai pada bulan berjalan</li>
</ul>
<p><img src="/images/man/m1_gPayroll.jpg"></p>