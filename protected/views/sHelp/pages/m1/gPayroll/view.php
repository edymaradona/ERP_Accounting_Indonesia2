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
        Payroll per Pegawai
    </h1>
</div>

<p>
    Halaman ini menampilkan data gaji pegawai. Halaman ini terdiri dari dua bagian, yaitu
<ul>
    <li>Bagian atas berisi data singkat pegawai, yang terdiri dari
        <ul>
            <li>Basic Salary, gaji pokok pegawai</li>
            <li>Total Benefit, total tunjngan gaji pegawai</li>
            <li>Total Deduction, total pengurang gaji pegawai</li>
        </ul>
    </li>
    <li>Bagian bawah berisi data lanjutan gaji pegawai. Data lanjutan terdiri dari beberapa tab.
        <ul>
            <li>Tab Salary History, menampilkan data gaji pokok per bulan,
                memiliki tampilan seperti berikut <br>
                <img src="/images/man/m1_gPayroll_view_salary_history.jpg">.
                Tab ini menampilkan
                <ul>
                    <li>Daftar Basic Salary per Periode. Daftar ini memiliki kolom
                        <ul>
                            <li>Year Month, periode gaji (bulan tahun)</li>
                            <li>Category, kategori gaji pegawai</li>
                            <li>Basic Salary, gaji pokok pegawai</li>
                            <li>Remark, catatan transaksi gaji</li>
                        </ul>
                    </li>
                    <li>Form input basic salary per periode. Form ini terdiri dari</li>
                    <ul>
                        <li>Year Month, periode gaji (bulan tahun), diinput dengan memilih bulan dan tahun pada
                            monthpicker
                            <img src="/images/man/select_month2.jpg"></li>
                        <li>Category, kategori gaji pegawai</li>
                        <li>Basic Salary, gaji pokok pegawai</li>
                        <li>Remark, catatan transaksi gaji</li>
                    </ul>
            </li>
        </ul>
    </li>
    <li>Tab Benefit, menampilkan data tunjangan pada waktu tertentu,
        memiliki tampilan seperti berikut <br>
        <img src="/images/man/m1_gPayroll_view_benefit.jpg">.
        Tab ini menampilkan
        <ul>
            <li>Daftar Tunjangan. Daftar ini memiliki kolom
                <ul>
                    <li>Benefit, nama tunjangan</li>
                    <li>Start, periode mulai mendapat tunjangan tersebut</li>
                    <li>End, periode selesai mendapat tunjangan tersebut</li>
                    <li>Amount, jumlah tunjangan</li>
                    <li>Remark, catatan tunjangan</li>
                </ul>
            </li>
            <li>Form input basic salary per periode. Form ini terdiri dari</li>
            <ul>
                <li>Start, periode mulai mendapat tunjangan tersebut</li>
                <li>End, periode selesai mendapat tunjangan tersebut</li>
                <li>Benefit, nama tunjangan</li>
                <li>Remark, catatan tunjangan</li>
            </ul>
    </li>
</ul>

<li>Tab Deduction, menampilkan data potongan gaji per bulan,
    memiliki tampilan seperti berikut <br>
    <img src="/images/man/m1_gPayroll_view_deduction.jpg">.
    Tab ini menampilkan
    <ul>
        <li>Daftar Potongan. Daftar ini memiliki kolom
            <ul>
                <li>Deduction, nama potongan</li>
                <li>Start, periode mulai mendapat potongan tersebut</li>
                <li>End, periode selesai mendapat potongan tersebut</li>
                <li>Amount, jumlah potongan</li>
                <li>Remark, catatan potongan</li>
            </ul>
        </li>
        <li>Form input basic salary per periode. Form ini terdiri dari</li>
        <ul>
            <li>Start, periode mulai mendapat potongan tersebut</li>
            <li>End, periode selesai mendapat potongan tersebut</li>
            <li>Deduction, nama potongan</li>
            <li>Remark, catatan potongan</li>
        </ul>
</li>
