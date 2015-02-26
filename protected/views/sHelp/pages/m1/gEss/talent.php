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
        Employee Performance
    </h1>
</div>

<p>
    Halaman ini menampilkan data kinerja pegawai. Halaman ini terdiri dari dua bagian, yaitu
<ul>
    <li>Bagian atas berisi nilai akhir penilaian kinerja yang terdiri dari
        <ul>
            <li>Work Result</li>
            <li>Core Competency</li>
            <li>Leadership Competency</li>
        </ul>
        dan link untuk memilih tahun penilaian kinerja
    </li>
    <li>Bagian bawah berisi detil penilaian kinerja pegawai pada tahun tertentu yang ditampilkan dalam 3 tab, yaitu
        <ul>
            <li>Work Result, berisi daftar aspek non manajerial yang dinilai yaitu Produktivitas, Ketekunan dan
                ketangguhan, Motivasi Kerja, Inisiatif dan Kemauan Belajar, dan Kehadiran dan Kedisiplinan <img
                    src="/images/man/m1_gEss_talent_work_result.jpg"></li>

            <li>Tab Core Competency. Tab ini terdiri dari dua bagian yaitu:
                <ul>
                    <li>Tabel Core Competency, berisi daftar aspek kompetensi utama yang dinilai yaitu Integritas,
                        Berjuang Untuk Hasil Yang Terbaik, Kompeten, Fokus Pada Pelanggan, dan Kerjasama <img
                            src="/images/man/m1_gEss_talent_core_competency.jpg">.
                        Tabel ini terdiri dari kolom
                        <ul>
                            <li>Year, tahun penilaian kinerja</li>
                            <li>Aspect, aspek yang dinilai</li>
                            <li>Weight, bobot penilaian</li>
                            <li>Personal Score I, penilaian kinerja diri sendiri, diinput oleh pegawai yang
                                bersangkutan
                            </li>
                            <li>Remark, catatan penilaian</li>
                            <li>Status, status penilaian permintaan</li>
                        </ul>
                    </li>
                    <li>Form tambah Core Competency, terdiri dari
                        <ul>
                            <li>Talent Template, aspek yang dinilai</li>
                            <li>Personal Score I, penilaian kinerja diri sendiri, diinput oleh pegawai yang
                                bersangkutan
                            </li>
                            <li>Remark, catatan penilaian</li>
                        </ul>
                        Untuk menambah Core Competency, isi form tersebut lalu klik button Create.
                    </li>
                </ul>
            </li>

            <li>Tab Leadership Competency. Tab ini terdiri dari dua bagian, yaitu:
                <ul>
                    <li>Leadership Competency, berisi daftar aspek kompetensi kepemimpinan yang dinilai yaitu
                        Kepemimpinan, Visi, Pengelolaan Perubahan, Pengembangan Karyawan, dan Penyelesaian Tugas <img
                            src="/images/man/m1_gEss_talent_leadership_competency.jpg">.
                        Tabel ini terdiri dari kolom
                        <ul>
                            <li>Year, tahun penilaian kinerja</li>
                            <li>Aspect, aspek yang dinilai</li>
                            <li>Weight, bobot penilaian</li>
                            <li>Personal Score I, penilaian kinerja diri sendiri, diinput oleh pegawai yang
                                bersangkutan
                            </li>
                            <li>Remark, catatan penilaian</li>
                            <li>Status, status penilaian permintaan</li>
                        </ul>
                    </li>
                    <li>Form tambah Leaadership Competency, terdiri dari
                        <ul>
                            <li>Talent Template, aspek yang dinilai</li>
                            <li>Personal Score I, penilaian kinerja diri sendiri, diinput oleh pegawai yang
                                bersangkutan
                            </li>
                            <li>Remark, catatan penilaian</li>
                        </ul>
                        Untuk menambah Leaadership Competency, isi form tersebut lalu klik button Create.
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>