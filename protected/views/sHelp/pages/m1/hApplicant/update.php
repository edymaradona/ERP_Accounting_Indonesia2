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
        Update Applicant
    </h1>
</div>

<p>Halaman ini digunakan untuk mengubah data pelamar. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Create New Applicant, link ke halaman form untuk menambah pelamar</li>
            <li>Vacancy, link ke halaman daftar lowongan</li>
            <li>Applicant, link ke halaman daftar pelamar</li>
            <li>Selection Registration, link ke halaman jadwal seleksi</li>
            <li>Interview, link ke halaman daftar rencana interview</li>
            <li>Nama-nama pelamar, link ke halaman profil pelamar</li>
        </ul>
    </li>

    <li><p>Kolom kanan berisi form tambah pelamar, yang terdiri dari
        <ul>
            <li>Applicant Name</li>
            <li>Email</li>
            <li>Birth Place: tempat lahir</li>
            <li>Date Birth: tanggal lahir</li>
            <li>Handphone: nomor handphone</li>
            <li>Religion: agama</li>
            <li>Sex: jenis kelamin</li>
            <li>Identity Number: nomor KTP/SIM/paspor</li>
            <li>Address</li>
            <li>Fresh Grad: centang jika pelamar baru lulus, kosongkan jika sudah ada pengalaman</li>
            <li>Expected Salary: gaji yang diharapkan</li>
            <li>Expected Position: posisi yang diinginkan</li>
        </ul>
        untuk menambah pelamar, isi form tersebut, lalu klik Save
    </li>
</ul>
<BR>

<img src="/images/man/m1_hApplicant_create.jpg">