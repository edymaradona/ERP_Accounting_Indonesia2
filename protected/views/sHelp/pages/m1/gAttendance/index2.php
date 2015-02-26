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

<p>Halaman ini terdiri dari dua bagian yaitu</p>
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Change shift list, daftar ganti shift, tabel ini terdiri dari kolom
                <ul>
                    <li>Name, nama pegawai yang meminta ganti shift</li>
                    <li>Date, tanggal yang diminta untuk ganti shift</li>
                    <li>Real Pattern, pola kedatangan awal yang diminta untuk diganti</li>
                    <li>Request Pattern, pola kedatangan yang diminta untuk menggantikan</li>
                    <li>Superior Status, status persetujuan atasan</li>
                    <li>HR Status, status persetujuan staf HR</li>
                    <li>Remark, catatan penggantian shift</li>
                </ul>
            </li>
            <li>10 Most Absensce, daftar 10 pegawai yang paling sering absen. Tabel ini terdiri dari kolom
                <ul>
                    <li>Employee Name, nama pegawai</li>
                    <li>Jam Kerja (TO DO), jumlah utang jam kerja (format jam.menit.detik</li>
                    <li>Cuti, jumlah cuti yang sudah diambil</li>
                    <li>Alpa, jumlah absen tanpa keterangan</li>
                    <li>Terlambat, jumlah hari kedatangan yang terlambat</li>
                    <li>Menit, jumlah menit terlambat</li>
                    <li>Pulang Cepat, jumlah hari pulang sebelum jam kerja selesai</li>
                    <li>Menit, jumlah utang jam kerja karena pulang cepat (format jam.menit.detik)</li>
                    <li>TAD</li>
                    <li>TAP</li>
                    <li>Sakit, jumlah hari ijin sakit</li>
                    <li>Khusus, jumlah hari ijin khusus</li>
                </ul>
            </li>
            <li>10 Most Late in List, daftar 10 pegawai yang paling banyak jumlah utang jam kerjanya karena datang
                terlambat. Tabel ini terdiri dari kolom
                <ul>
                    <li>Employee Name, nama pegawai</li>
                    <li>Jam Kerja (TO DO), jumlah utang jam kerja (format jam.menit.detik</li>
                    <li>Cuti, jumlah cuti yang sudah diambil</li>
                    <li>Alpa, jumlah absen tanpa keterangan</li>
                    <li>Terlambat, jumlah hari kedatangan yang terlambat</li>
                    <li>Menit, jumlah menit terlambat</li>
                    <li>Pulang Cepat, jumlah hari pulang sebelum jam kerja selesai</li>
                    <li>Menit, jumlah utang jam kerja karena pulang cepat (format jam.menit.detik)</li>
                    <li>TAD</li>
                    <li>TAP</li>
                    <li>Sakit, jumlah hari ijin sakit</li>
                    <li>Khusus, jumlah hari ijin khusus</li>
                </ul>
            </li>
            <li>Recently Added, daftar pegawai yang baru diinput</li>
            <li>Recently Updated, daftar pegawai yang baru diupdate</li>
        </ul>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Search Form untuk mencari pegawai berdasarkan nama pegawai</li>
            <li>Button Create New Person, link ke halaman input tambah pegawai</li>
            <li>Operation berisi
            </li>
            <ul>
                <li>Home, link ke halaman home attendance</li>
                <li>Home II, link ke halaman home attendance ke diupdate</li>
                <li>Schedule Upload, link ke halaman untuk mengupload jadwal</li>
                <li>Attendant Upload, link ke halaman untuk mengupload data absensi</li>
                <li>Parameter Time Block, link ke halmaan untuk time block absensi</li>
                <li>Rekap by Dept, link ke halaman untuk men-download rekap laporan kedatangan pegawai per departemen
                </li>
            </ul>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/m1_gAttendance_index2.jpg">