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
<li>Bagian atas berisi data singkat pegawai, yang terdiri dari
    <ul>
        <li>Pas foto</li>
        <li>Print Profile, link untuk mendownload profil pegawai</li>
        <li>Employee ID, nomor pegawai</li>
        <li>Company, perusahaan tempat bekerja saat ini</li>
        <li>Department, departemen tempat bekerja saat ini</li>
        <li>Job Title, jabatan</li>
        <li>Level, tingkat pekerjaan</li>
        <li>Status, status kepegawaian</li>
        <li>Join Date, tanggal mulai bekerja. Setelah data tanggal mulai bekerja terdapat informasi lama bekerja pegawai
            tersebut.
        </li>
        <li>Join Date Biz Unit, tanggal mulai berkerja di unit bisnis. Setelah data tanggal mulai bekerja terdapat
            informasi lama bekerja pegawai tersebut di unit bisnis.
        </li>
        <li>Superior, atasan</li>
    </ul>
</li>
<li>
    Bagian tengah berisi nilai akhir penilaian kinerja yang terdiri dari
    <ul>
        <li>Work Result</li>
        <li>Core Competency</li>
        <li>Leadership Competency</li>
        <li>Final Rating</li>
    </ul>

    dan link untuk memilih tahun penilaian kinerja
</li>
<li>Bagian bawah berisi detil penilaian kinerja pegawai pada tahun tertentu yang ditampilkan dalam 4 tab, yaitu
<ul>
<li>Target Setting, terdiri dari 3 sub-tab, yaitu
    <ul>
        <li>Work Result jika pegawai, KPI jika manajer.
            <ul>
                <li>Work Result, berisi daftar aspek non manajerial yang dinilai yaitu Produktivitas, Ketekunan
                    dan ketangguhan, Motivasi Kerja, Inisiatif dan Kemauan Belajar, dan Kehadiran dan
                    Kedisiplinan <img src="/images/man/m1_gTalent_view_target_setting_work_result.jpg">

                    <br><br>Untuk menambah data satu per satu work result baru, isi form tambah work result,
                    yang berada pada bagian bawah tabel work result, lalu klik Create.

                    <br><br>Untuk menambah 5 work result sekaligus ke tahun tertentu, pada form tambah work
                    result, pilih tahun lalu klik Generate All.

                    <br><br>Untuk menghapus data work result tertentu, lakukan langkah berikut
                    <ul>
                        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan
                            meminta konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg">
                        </li>
                        <li>klik button OK untuk menghapus data work result, atau button Cancel jika batal
                            menghapus data work result
                        </li>
                    </ul>
                </li>
                <li>KPI, berisi daftar target tahunan yang dikelompokkan menjadi 4 perspektif, yaitu Financial,
                    Customer, Internal, dan Learning & Growth<img
                        src="/images/man/m1_gTalent_view_target_setting_kpi.jpg">. Tabel ini memiliki kolom
                    <ul>
                        <li>Year, tahun target</li>
                        <li>Perspective, kelompok perspektif target</li>
                        <li>Strategic Objective, tujuan strategis target</li>
                        <li>KPI Desc, deskripsi key performance indicator, indikasi kinerja pencapaian target
                        </li>
                        <li>Weight, bobot implementasi target</li>
                        <li>Target, kuantifikasi target</li>
                        <li>Unit, satuan kuantifikasi target</li>
                        <li>Remark, catatan</li>
                        <li>Strategic Initiative, kegiatan strategis yang akan dilakukan untuk mencapai target
                        </li>
                        <li>Status, status target, approved atau requested</li>
                    </ul>

                    <br><br>Untuk menambah data target baru, isi form tambah target setting, yang berada pada
                    bagian bawah tabel KPI, lalu klik Create.
                    <br><br>Untuk mengubah data target tertentu, lakukan langkah berikut:
                    <ul>
                        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti
                            berikut <img src="/images/man/m1_gTalent_view_target_setting_update_kpi.jpg"></li>
                        <li>Ubah data di form tersebut, lalu klik Save</li>
                    </ul>

                    <br><br>Untuk menghapus data target tertentu, lakukan langkah berikut
                    <ul>
                        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan
                            meminta konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg">
                        </li>
                        <li>klik button OK untuk menghapus data target, atau button Cancel jika batal menghapus
                            data target
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Core Competency, berisi daftar aspek kompetensi utama yang dinilai yaitu Integritas, Berjuang Untuk
            Hasil Yang Terbaik, Kompeten, Fokus Pada Pelanggan, dan Kerjasama <img
                src="/images/man/m1_gTalent_view_target_setting_core_competency.jpg">.

            <br><br>Untuk menambah data satu per satu core competency baru, isi form tambah core competency,
            yang berada pada bagian bawah tabel core competency, lalu klik Create.

            <br><br>Untuk menambah 5 core competency sekaligus ke tahun tertentu, pada form tambah core
            competency, pilih tahun lalu klik Generate All.

            <br><br>Untuk menghapus data core competency tertentu, lakukan langkah berikut
            <ul>
                <li>
                    klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                    konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg">
                </li>
                <li>
                    klik button OK untuk menghapus data core competency, atau button Cancel jika batal menghapus
                    data core competency
                </li>
            </ul>
        </li>
        <li>Leadership Competency, berisi daftar aspek kompetensi kepemimpinan yang dinilai yaitu Kepemimpinan,
            Visi, Pengelolaan Perubahan, Pengembangan Karyawan, dan Penyelesaian Tugas <img
                src="/images/man/m1_gTalent_view_target_setting_leadership_competency.jpg">.

            <br><br>Untuk menambah data satu per satu leadership competency baru, isi form tambah leadership
            competency, yang berada pada bagian bawah tabel leadership competency, lalu klik Create.

            <br><br>Untuk menambah 5 leadership competency sekaligus ke tahun tertentu, pada form tambah
            leadership competency, pilih tahun lalu klik Generate All.

            <br><br>Untuk menghapus data leadership competency tertentu, lakukan langkah berikut
            <ul>
                <li>
                    klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                    konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg">
                </li>
                <li>
                    klik button OK untuk menghapus data leadership competency, atau button Cancel jika batal
                    menghapus data leadership competency
                </li>
            </ul>
        </li>
    </ul>
</li>
<li>Performance Appraisal, terdiri dari 3 sub-tab, yaitu
    <ul>
        <li>Work Result jika non-manajer, KPI jika manajer.
            <ul>
                <li>Work Result, berisi penilaian aspek non manajerial yang di set sebelumnya di tab Target
                    Setting, sub tab Work Result <img
                        src="/images/man/m1_gTalent_view_performance_appraisal_work_result.jpg">. Untuk
                    mengupdate penilaian, klik pada data yang ingin diupdate, maka akan tampil tool untuk
                    mengedit data tersebut <img src="/images/man/update_cell.jpg">. Untuk menyimpan data klik
                    tanda centang, sedangkan untuk membatalkan dan menutup tool edit tersebut, klik tanda
                    silang.
                </li>
                <li>KPI, berisi penilaian aspek manajerial yang di set sebelumnya di tab Target Setting, sub tab
                    KPI <img src="/images/man/m1_gTalent_view_performance_appraisal_kpi.jpg">. Untuk mengupdate
                    penilaian, klik pada data yang ingin diupdate, maka akan tampil tool untuk mengedit data
                    tersebut <img src="/images/man/update_cell.jpg">. Untuk menyimpan data klik tanda centang,
                    sedangkan untuk membatalkan dan menutup tool edit tersebut, klik tanda silang.
                </li>
            </ul>
        </li>
        <li>Core Competency, berisi penilaian aspek kompetensi utama yang di set sebelumnya di tab Target
            Setting, sub tab Core Competency <img
                src="/images/man/m1_gTalent_view_performance_appraisal_core_competency.jpg">.

            <br><br>Penilaian dilakukan 2 kali dalam setahun, dan masing-masing aspek dinilai oleh pegawai itu
            sendiri dan atasannya. Kedua penilaian tersebut kemudian menjadi input rumus tertentu untuk
            mendapatkan nilai akhir suatu aspek.

            <br><br>Untuk mengupdate penilaian, klik pada data yang ingin diupdate, maka akan tampil tool untuk
            mengedit data tersebut <img src="/images/man/update_cell.jpg">. Untuk menyimpan data klik tanda
            centang, sedangkan untuk membatalkan dan menutup tool edit tersebut, klik tanda silang.
        </li>
        <li>Leadership Competency, berisi penilaian aspek kompetensi kepemimpinan yang di set sebelumnya di tab
            Target Setting, sub tab Leadership Competency <img
                src="/images/man/m1_gTalent_view_performance_appraisal_leadership_competency.jpg">.
            <br><br>Penilaian dilakukan 2 kali dalam setahun, dan masing-masing aspek dinilai oleh pegawai itu
            sendiri dan atasannya. Kedua penilaian tersebut kemudian menjadi input rumus tertentu untuk
            mendapatkan nilai akhir suatu aspek.

            <br><br>Untuk mengupdate penilaian, klik pada data yang ingin diupdate, maka akan tampil tool untuk
            mengedit data tersebut <img src="/images/man/update_cell.jpg">. Untuk menyimpan data klik tanda
            centang, sedangkan untuk membatalkan dan menutup tool edit tersebut, klik tanda silang.
        </li>
    </ul>
</li>
<li>Final Rating, yang menampilkan tabel final rating pegawai tertentu seperti berikut <img
        src="/images/man/m1_gTalent_view_final_rating.jpg">. Tabel ini memiliki kolom
    <ul>
        <li>Input Date, tanggal input penilaian</li>
        <li>Year, tahun kinerja yang dinilai</li>
        <li>Name, range waktu yang dinilai</li>
        <li>PA Value,</li>
        <li>HF Identification</li>
        <li>Remark, catatan</li>
    </ul>
    <br>Untuk menambah data final rating baru, isi form tambah final rating, yang berada pada bagian bawah tabel
    final rating, lalu klik Create.
    <br>Untuk mengubah data final rating tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                src="/images/man/m1_gPersonCostcenter_view_update_final_rating.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data final rating tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
            konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data final rating, atau button Cancel jika batal menghapus data final
            rating
        </li>
    </ul>
</li>
<li>Personal Info, terdiri dari 2 sub-tab, yaitu
    <ul>
        <li>Career - Experience - Status, menampilkan riwayat karir, pengalaman kerja dan status pegawai seperti
            berikut <img src="/images/man/m1_gTalent_view_career_experience_status.jpg">
            <ul>
                <li>Tab Internal Career, yang menampilkan tabel karir internal pegawai tertentu. Tabel ini
                    memiliki kolom
                    <ul>
                        <li>Start Date, tanggal mulai bekerja</li>
                        <li>Status, status kepegawaian</li>
                        <li>Company, perusahaan APL tempat bekerja</li>
                        <li>Department, departemen tempat bekerja</li>
                        <li>Level, level pekerjaan</li>
                        <li>Job Title, jabatan</li>
                        <li>Superior, atasan</li>
                    </ul>
                </li>

                <li>Tab Experience, yang menampilkan tabel pengalaman kerja pegawai. Tabel ini memiliki kolom
                    <ul>
                        <li>Company Name, nama perusahaan</li>
                        <li>Industries, bidang usaha perusahaan</li>
                        <li>Start Date, tanggal mulai bekerja</li>
                        <li>End Date, tanggal selesai bekerja</li>
                        <li>Year Length, Month Length, lama bekerja</li>
                        <li>Job Title, jabatan</li>
                    </ul>
                </li>

                <li>Tab Status, yang menampilkan tabel sejarah status kepegawaian pegawai tertentu. Tabel ini
                    memiliki kolom
                    <ul>
                        <li>Start Date, tanggal mulai status</li>
                        <li>End Date, tanggal selesai status</li>
                        <li>Status, status kepegawaian</li>
                        <li>Remark, catatan</li>
                    </ul>
                </li>
            </ul>
        <li>Education, yang menampilkan tabel pendidikan formal dan non formal pegawai tertentu seperti berikut
            <img src="/images/man/m1_gTalent_view_education.jpg">. Tabel pendidikan formal memiliki kolom
            <ul>
                <li>Level, tingkat pendidikan</li>
                <li>Institute Name, nama sekolah/universitas</li>
                <li>City/Country, kota dan negara lokasi sekolah/universitas</li>
                <li>Major, jurusan yang diambil</li>
                <li>Graduation Year, tahun kelulusan</li>
                <li>GPA, nilai akhir ketika lulus atau IPK</li>
            </ul>

            <br><br>Sedangkan tabel pendidikan non formal memiliki kolom
            <ul>
                <li>Institution Name, nama institusi pendidikan yang mengadakan kursus/pelatihan</li>
                <li>Subject, topik kursus/pelatihan</li>
                <li>Start, tanggal mulai kursus/pelatihan</li>
                <li>End, tanggal selesai kursus/pelatihan</li>
                <li>Certificate, ada tidaknya sertifikat</li>
                <li>Country, negara lokasi institusi pendidikan</li>
            </ul>
        </li>
    </ul>
</li>
</ul>
</li>
</ul>