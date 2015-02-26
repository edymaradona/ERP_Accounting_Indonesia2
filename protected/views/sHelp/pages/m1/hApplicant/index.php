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
        Applicant Administration
    </h1>
</div>

<p>Untuk melakukan administrasi data pelamar, Anda dapat meng-klik
    sub menu Applicant di Menu HR Admin. Kemudian APHRIS
    akan menampilkan halaman daftar applicant yang terdiri dari
    beberapa bagian yaitu</p>
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

    <li><p>Kolom kanan berisi
        <ul>
            <li>Search Form untuk mencari pelamar
                berdasarkan nama pelamar, nama lowongan atau deskripsi kerja lowongan
            </li>
            <li>Detil singkat pelamar, yang terdiri dari
                <ul>
                    <li>Nama</li>
                    <li>Foto</li>
                    <li>Alamat</li>
                    <li>Birth Place: tempat lahir</li>
                    <li>Date Birth: tanggal lahir</li>
                    <li>Sex: jenis kelamin</li>
                    <li>Religion: agama</li>
                    <li>Handphone: nomor handphone</li>
                    <li>Email</li>
                    <li>Fresh Grad: baru lulus atau sudah ada pengalaman</li>
                    <li>Expected Salary: gaji yang diharapkan</li>
                    <li>Expected Position: posisi yang diinginkan</li>
                    <li>Experience: daftar pengalaman</li>
                    <li>Applied On: lowongan yang dilamar</li>
                    <li>Comment: komentar petugas seleksi</li>
                    <li>Selection Schedule: jadwal seleksi yang diikuti</li>
                    <li>Selection Result: hasil seleksi</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/m1_hApplicant.jpg">