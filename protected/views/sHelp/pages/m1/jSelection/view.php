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
        Selection Detail
    </h1>
</div>

<p>Halaman ini terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Vacancy, link ke halaman daftar lowongan</li>
            <li>Applicant, link ke halaman daftar pelamar</li>
            <li>Selection Registration, link ke halaman jadwal seleksi</li>
            <li>Interview, link ke halaman daftar rencana interview</li>
            <li>Nama-nama pelamar, link ke halaman profil pelamar</li>
        </ul>
    </li>

    <li><p>Kolom kanan berisi
        <ul>
            <li>Detil tahap seleksi, dengan data
                <ul>
                    <li>Category: jenis tahap seleksi</li>
                    <li>Schedule Date: tanggal dan jam diadakan</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan tempat</li>
                </ul>
            </li>
            <li>Daftar pelamar yang didaftarkan untuk mengikuti tahap seleksi tersebut</li>
        </ul>

    </li>
</ul>
<BR>

<img src="/images/man/m1_jSelection.jpg">