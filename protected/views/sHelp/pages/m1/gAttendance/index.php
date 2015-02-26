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
        Attendance
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Rekap by Dept, link ke halaman untuk men-download rekap laporan kedatangan pegawai per departemen</li>
            <li>Filter Department. Filter Department berisi
                daftar departemen yang dapat Anda gunakan untuk menyaring
                pegawai-pegawai sehingga hanya menampilkan pegawai dari departemen
                tertentu
            </li>
        </ul>
    <li><p>Kolom tengah berisi detil singkat para pegawai. Jika nama pegawai di klik, APHRIS akan menampilkan data
            absensi pegawai tersebut.
    </li>
    <li>
        <p>Kolom kanan berisi
    </li>
    <ul>
        <li>Search Form untuk mencari pegawai berdasarkan nama pegawai</li>
        <li>Operation berisi
        </li>
        <ul>
            <li>Home, link ke halaman home attendance</li>
            <li>Schedule Upload, link ke halaman untuk mengupload jadwal</li>
            <li>Attendant Upload, link ke halaman untuk mengupload data absensi</li>
            <li>Parameter Time Block, link ke halmaan untuk time block absensi</li>
            <li>Rekap by Dept, link ke halaman untuk men-download rekap laporan kedatangan pegawai per departemen</li>
        </ul>
        <li>Recent Updated berisi daftar nama pegawai yang datanya baru diperbarui</li>
        <li>Recent Added berisi daftar nama pegawai yang datanya baru ditambahkan</li>
    </ul>
</ul>
<BR>
<img src="/images/man/m1_gAttendance.jpg">
