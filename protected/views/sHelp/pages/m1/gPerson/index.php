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

<p>Untuk melakukan administrasi data pegawai, Anda dapat meng-klik
    sub menu Personel Administration di Menu HR Admin. Kemudian APHRIS
    akan menampilkan halaman Personel Administration yang terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi Filter Department. Filter Department berisi
            daftar departemen yang dapat Anda gunakan untuk menyaring
            pegawai-pegawai sehingga hanya menampilkan pegawai dari departemen
            tertentu</li>
    <li><p>Kolom tengah berisi detil singkat para pegawai
    </li>
    <li><p>Kolom kanan berisi
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
                    <li>List of Uncomplete Data, link ke
                        daftar pegawai yang datanya belum lengkap
                    </li>
                    <li>Birthday of the Month, link ke
                        daftar pegawai yang berulang tahun pada bulan berjalan
                    </li>
                    <li>Probation/Contract, link ke
                        daftar pegawai yang statusnya Probation atau Contract
                    </li>
                    <li>Employee In/Out, link ke daftar
                        pegawai yang baru masuk atau keluar
                    </li>
                    <li>Black List, link ke dafftar
                        pegawai yang di-black-list
                    </li>
                    <li>Help, link ke manual halaman
                        Personel Administration
                    </li>
                </ul>
            </li>
            <li>Recent Update berisi daftar nama
                pegawai yang datanya baru diperbarui
            </li>
            <li>Recent Add berisi daftar nama
                pegawai yang datanya baru ditambahkan
            </li>
            <li>Related berisi daftar pegawai
                yang memiliki nama mirip dengan pegawai yang sedang dilihat datanya
            </li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/m1_gPerson.jpg">