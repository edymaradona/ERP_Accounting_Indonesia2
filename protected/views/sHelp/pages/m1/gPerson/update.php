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
        Update Person/Employee
    </h1>
</div>

<p>
    Halaman ini menampilkan form untuk mengubah data pegawai. Untuk mengubah data pegawai, isikan data pegawai di form
    tersebut, lalu klik tombol Save. Form data pegawai terdiri dari beberapa bagian yaitu
<ul>
    <li>Basic Info, data umum pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Employee Name, nama pegawai</li>
            <li>Local ID, nomor pegawai di perusahaan</li>
            <li>Birth Place, tempat lahir</li>
            <li>Birth Date, tanggal lahir</li>
            <li>Sex, jenis kelamin</li>
            <li>Religion, agama</li>
            <li>Blood, golongan darah</li>
        </ul>
    </li>
    <li>Address, alamat pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Address, alamat rumah</li>
            <li>Pos Code, kode pos</li>
        </ul>
    </li>
    <li>Identity, data identitas pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Identity Number, nomor KTP</li>
            <li>Valid, tanggal kadaluarsa KTP</li>
            <li>Identity Address, alamat pada KTP</li>
            <li>Identity Pos Code, kode pos pada KTP</li>
        </ul>
    </li>
    <li>Contact, data kontak pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Email, alamat email</li>
            <li>Home Phone, nomor telepon rumah</li>
            <li>Handphone, nomor handphone</li>
        </ul>
    </li>
    <li>Bank, data bank pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Account Number, nomor rekening bank</li>
            <li>Account Name, nama pemegang rekening bank</li>
            <li>Bank Name, nama bank penerbit nomor rekening tersebut</li>
        </ul>
    </li>
    <li>Career, data karir pegawai terdiri dari beberapa input yaitu:
        <ul>
            <li>Start Date, tanggal mulai kerja</li>
            <li>Status, status karir</li>
            <li>Company, nama perusahaan tempat bekerja</li>
            <li>Department, nama departemen tempat bekerja</li>
            <li>Level, tingkat jabatan</li>
            <li>Job Title, nama jabatan</li>
            <li>Superior Name, nama atasan</li>
            <li>Reason, alasan dibuat data karir baru</li>
        </ul>
    </li>
    <li>Status, data status kepegawaian terdiri dari beberapa input yaitu:
        <ul>
            <li>Start Date, tanggal mulai menjalani status kepegawaian tersebut</li>
            <li>End Date, tanggal selesai menjalani status kepegawaian tersebut</li>
            <li>Status, status kepegawaian</li>
            <li>Remark, catatan</li>
        </ul>
    </li>
</ul>

<p><img src="/images/man/m1_gPerson_update.jpg"></p>