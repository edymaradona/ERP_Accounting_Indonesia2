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
        Person View
    </h1>
</div>

<p>Untuk melihat data pegawai, Anda dapat meng-klik
    sub menu Personel Profile di Menu Holding. Kemudian APHRIS
    akan menampilkan halaman Person View yang terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Search Form untuk mencari pegawai
                berdasarkan nama pegawai
            </li>
            <li>Detil singkat pegawai</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Operation berisi
                <ul>
                    <li>Home, link ke halaman Cost Center</li>
                    <li>Report, link untuk mendownload report</li>
                    <li>Request to Mutation, link untuk</li>
                </ul>
            </li>
            <li>Recently Update berisi daftar nama
                pegawai yang datanya baru diperbarui
            </li>
            <li>Recently Add berisi daftar nama
                pegawai yang datanya baru ditambahkan
            </li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/m1_gPersonHolding.jpg">