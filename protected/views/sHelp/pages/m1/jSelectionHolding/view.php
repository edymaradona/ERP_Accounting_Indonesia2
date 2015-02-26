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
            <li>Detil tahap seleksi, dengan data
                <ul>
                    <li>Category: jenis tahap seleksi</li>
                    <li>Schedule Date: tanggal dan jam diadakan</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan tempat</li>
                </ul>
            </li>
            <li>Form registrasi peserta seleksi baru
                <ul>
                    <li>Applicant Name, nama pelamar. Ketikkan sebagian nama pelamar, maka di bawah input akan tampil
                        daftar pelamar yang namanya mirip dengan teks yang diketik
                        <img src="/images/man/autocomplete-name.jpg">, lalu pilih salah satu pelamar yang muncul di
                        daftar sebagai pelamar yang akan mengikuti tahap seleksi
                    </li>
                    <li>Company, nama perusahaan yang membuka lowongan</li>
                    <li>Department, nama departemen yang membuka lowongan</li>
                    <li>Level, tingkat posisi lowongan</li>
                    <li>For Position, nama posisi untuk pelamar tersebut</li>
                </ul>
                Untuk menambah peserta seleksi baru, isi form registrasi peserta, lalu klik Create
                <br>
                Untuk tidak mengikutsertakan peserta dari tahap seleksi, lakukan langkah berikut
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus data peserta seleksi, atau button Cancel jika batal menghapus
                        data peserta seleksi
                    </li>
                </ul>
            </li>
            <li>Daftar pelamar yang didaftarkan untuk mengikuti tahap seleksi tersebut</li>
        </ul>

    </li>

    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke halaman kalender jadwal seleksi</li>
            <li>Update, link ke halaman update jadwal seleksi</li>
            <li>Delete, link untuk menghapus jadwal seleksi. Untuk menghapus jadwal seleksi, lakukan langkah berikut
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus data jadwal seleksi, atau button Cancel jika batal menghapus data
                        jadwal seleksi
                    </li>
                </ul>
            </li>
        </ul>
    </li>


</ul>
<BR>

<img src="/images/man/m1_jSelectionHolding_view.jpg">