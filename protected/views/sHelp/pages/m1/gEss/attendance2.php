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

<p>
    Halaman ini menampilkan dua tab, yaitu
<ul>
    <li>Tab Normal View, menampilkan data absensi Anda pada bulan berjalan. <br>
        <img src="/images/man/m1_gEss_attendance3.jpg">. <br>
        Tabel ini terdiri dari kolom
        <ul>
            <li>Date, tanggal kedatangan</li>
            <li>Pattern, pola jam kerja pada tanggal tersebut. Pattern O - Libur / Off, menandakan tanggal tersebut
                adalah hari libur
            </li>
            <li>In, jam masuk. Jika In berisi ??:??, berarti waktu datang tidak diketahui</li>
            <li>Out, jam pulang. Jika Out berisi ??:?? berarti waktu pulang tidak diketahui</li>
            <li>Set Permission, jika kolom In dan kolom Out tidak diketahui, dan ternyata pada hari tersebut, adalah
                tanggal dimana pegawai ijin, klik button Set Permission
            </li>
            <li>Change Schedule, untuk mencatat permintaan perubahan jadwal kerja, klik button Change Schedule</li>
            <li>Notes to HR, catatan untuk staf HR. Untuk mengubah Notes to HR, klik link Notes to HR pada baris yang
                ingin diubah, maka akan ditampilkan tool untuk mengubah Notes to HR<br><img
                    src="/images/man/m1_gEss_attendance_enter_hr_notes.jpg">.<br>
                Untuk menyimpan catatan, klik tanda centang, untuk membatalkan simpan catatan, klik tanda silang.
            </li>
        </ul>
        Untuk melihat daftar absen bulan lain, gunakan link Previous Month dan Next Month di atas tabel
    </li>
    <li>Tab Calendar View, menampilkan kalendar jadwal kerja, dapat dilihat dalam tampilan per bulan atau per minggu
        <br><img src="/images/man/m1_gEss_attendance_calendar_month.jpg">.<br>
        <br><img src="/images/man/m1_gEss_attendance_calendar_week.jpg">.<br>
    </li>
</ul>

