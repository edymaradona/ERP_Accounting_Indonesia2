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
        Personel Administration
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri menampilkan
        <ul>
            <li>Probation, daftar pegawai yang sedang dalam masa percobaan</li>
            <li>Contract, daftar pegawai kontrak</li>
            <li>Recently Updated, daftar pegawai yang baru diubah datanya</li>
            <li>Recently Added, daftar pegawai yang baru diinput datanya</li>
            <li>Employee In, daftar pegawai yang baru diterima</li>
            <li>Employee Out, daftar pegawai yang baru keluar</li>
            <li>Birthday, kalendar ulang tahun pada bulan berjalan</li>
        </ul>

        Filter Department. Filter Department berisi
        daftar departemen yang dapat Anda gunakan untuk menyaring
        pegawai-pegawai sehingga hanya menampilkan pegawai dari departemen
        tertentu
    </li>
    <li>Kolom kanan berisi
        <ul>
            <li>Search Form untuk mencari pegawai
                berdasarkan nama pegawai
            </li>
            <li>Create New Person untuk membuka
                halaman pendaftaran pegawai
            </li>
            <li>Operation berisi
                <ul>
                    <li>Home, link ke halaman Personel
                        Administration
                    </li>
                    <li>Home II, link ke halaman Personel Administration versi 2</li>
                    <li>List of Uncomplete Data, link ke
                        daftar pegawai yang datanya belum lengkap
                    </li>
                    <li>Black List, link ke dafftar
                        pegawai yang di-black-list
                    </li>
                    <li>Help, link ke manual halaman
                        Personel Administration
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/m1_gPerson_index2.jpg">