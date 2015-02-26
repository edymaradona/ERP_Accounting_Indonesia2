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
        Dashboard Employee
    </h1>
</div>

<p>
    Jika username dan password yang Anda masukkan benar, APHRIS menampilkan halaman dashboard Employee.
</p>
<ul>
    <li>Kolom kiri, berisi
        <ul>
            <li>General Dashboard, link ke halaman dashboard employee</li>
            <li>Profile, link ke halaman profil pegawai</li>
            <li>Leave, link ke daftar cuti yang pernah diambil</li>
            <li>Permission, link ke daftar ijin yang pernah dilakukan</li>
            <li>Attendance, link ke daftar absensi pada bulan berjalan</li>
            <li>Performance Appraisal, link ke penilaian kinerja</li>
            <li>Update Profile, link ke halaman untuk mengupdate profil pegawai</li>
            <li>New Leave, link ke halaman untuk mengajukan cuti</li>
            <li>Cancellation Leave, link ke halaman untuk membatalkan cuti</li>
            <li>Extended Leave, link ke halaman untuk memperpanjang cuti</li>
            <li>New Permission, link ke halaman untuk mengajukan ijin</li>
            <li>Print Leave History, link untuk men-download daftar cuti</li>
            <li>Print Monthly Attendance, link untuk men-download daftar absensi bulan berjalan</li>
        </ul>
    </li>
    <li>Kolom kanan, berisi
        <ul>
            <li>Attendance Performance, menampilkan kinerja absensi</li>
            <li>Personal Mailbox, menampilkan pesan dari pegawai lain</li>
            <li>Forum | Bugs Thread, menampilkann daftar bug yang dilaporkan user</li>
            <li>Learning Schedule, menampilkan jadwal training yang diadakan</li>
        </ul>
    </li>
</ul>
<p><img src="/images/man/m1_gEss_index2.jpg"></p>