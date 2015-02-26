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
        Parameter Management
    </h1>
</div>

<p>Untuk melakukan administrasi data user, Anda dapat meng-klik
    sub menu User Management di Menu Administratiror. Kemudian APHRIS
    akan menampilkan halaman User Management yang terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li>Bagian atas, menampilkan daftar parameter yang sudah
        dikelompokkan sesuai tipe parameternya. Kolom-kolom pada daftar parameter, yaitu
        <ul>
            <li>Tipe Parameter, nama tipe parameter</li>
            <li>Code, kode atau nomor parameter yang mengidentifikasi parameter</li>
            <li>Name, nama parameter</li>
            <li>Status, status parameter, aktif atau tidak aktif</li>
        </ul>
        Ada beberapa fungsi yang dapat dilakukan yaitu
        <ul>
            <li>Untuk memfilter parameter yang ditampilkan, pilih tipe parameter pada input di bagian atas daftar
                parameter.
                menampilkan parameter dari semua tipe parameter, pilih [ALL].
            </li>
            <li>Untuk mengubah parameter klik icon <img src="/images/man/pencil.jpg">, maka APHRIS akan menampilkan form
                update parameter sebagai berikut
                <img src="/images/man/sParameter_update.jpg">. Ubah data parameter lalu klik button Save.
            </li>
            <li>Untuk menghapus parameter klik icon <img src="/images/man/bin.jpg">, maka APHRIS akan menampilkan
                konfirmasi
                hapus sebagai berikut <img src="/images/man/konfirmasi_delete.jpg">. Klik OK untuk menghapus, atau
                Cancel untuk membatalkan.
            </li>
        </ul>
    </li>
    <li>Bagian bawah menampilkan
        <ul>
            <li>Tab Existing Parameter, untuk menginput parameter ke tipe parameter yang sudah ada. Tipe parameter dapat
                dipilih di input Type
            </li>
            <li>Tab New Parameter, untuk menginput parameter dengan tipe parameter yang belum ada. Nama tipe parameter
                baru di ketik di input Type
                <img src="/images/man/sParameter_newparameter.jpg">
            </li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/sParameter.jpg">