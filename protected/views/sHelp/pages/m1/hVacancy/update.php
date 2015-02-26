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
        Update Vacancy
    </h1>
</div>

<p>Halaman ini digunakan untuk mengubah data lowongan. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi Daftar Vacancy, link ke detil lowongan tertentu</li>
    <li>Kolom tengah berisi form update lowongan. Form ini terdiri dari
        <ul>
            <li>Isian Utama, terdiri dari
                <ul>
                    <li>Title, nama jabatan yang akan dibuka lowongannya</li>
                    <li>Responsibility, deskripsi kerja yang akan dilakukan pelamar</li>
                    <li>Skill Required, keahlian tertentu yang diperlukan</li>
                    <li>Business Type, tipe usaha perusahaan yang membuka lowongan</li>
                    <li>For Level, tingkat pekerjaan</li>
                    <li>City, kota lokasi kerja</li>
                    <li>Min Education Level, tingkat pendidikan terendah yang diperlukan</li>
                    <li>Min GPA, IPK/NEM terkecil yang diperlukan</li>
                    <li>Min Working Experience, jumlah tahun pengalaman kerja yang dibutuhkan</li>
                </ul>
            </li>
            <li>Isian Pilihan /Optional, untuk menampilkan atau menyembunyikan optional form, klik link Show Optional
                Form.
                <img src="/images/man/m1_hVacancy_create_show_optional_form.jpg">. Form ini terdiri dari
                <ul>
                    <li>Work Address, alamat lokasi kerja</li>
                    <li>Min Salary, gaji terkecil yang ditawarkan</li>
                    <li>Max Salary, gaji terbesar yang ditawarkan</li>
                    <li>Show Salary, jika dicentang, data gaji ditampilkan di halaman yang diakses pelamar</li>
                </ul>
            </li>
            <li>Button Save, klik button ini untuk menyimpan data lowongan</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Top Interview berisi daftar nama
                pelamar yang datanya baru diperbarui
            </li>
            <li>Top Recent berisi daftar nama
                pelamar yang baru mendaftar
            </li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/m1_hVacancy_interviewDetail.jpg">