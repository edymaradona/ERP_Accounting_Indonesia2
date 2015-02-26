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
    Halaman ini menampilkan data gaji semua pegawai pada bulan berejalan

    Tabel-tabel tersebut, memiliki kolom
<ul>
    <li>Name, nama pegawai, berupa link jika di klik menampilkan data gaji detil pegawai tersebut</li>
    <li>Department, nama departemen tempat bekerja pegawai</li>
    <li>Status, status kepegawaian</li>
    <li>Basic Salary, gaji pokok</li>
    <li>Benefit, tambahan gaji</li>
    <li>Deduction pengurang gaji</li>
    <li>Remark, catatan</li>
</ul>

Pada bagian atas terdapat dua link yaitu
<ul>
    <li>Dashboard, untuk melihat halaman dashboard payroll</li>
    <li>All Employee, untuk melihat payroll semua pegawai pada bulan berjalan</li>
</ul>
<p><img src="/images/man/m1_gPayroll_currentMonth.jpg"></p>