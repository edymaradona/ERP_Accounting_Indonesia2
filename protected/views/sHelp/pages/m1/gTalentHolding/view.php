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
            <li>Join Date, tanggal mulai bekerja. Setelah data tanggal mulai bekerja terdapat informasi lama bekerja
                pegawai tersebut.
            </li>
            <li>Join Date Biz Unit, tanggal mulai berkerja di unit bisnis. Setelah data tanggal mulai bekerja terdapat
                informasi lama bekerja pegawai tersebut di unit bisnis.
            </li>
            <li>Superior, atasan</li>
        </ul>
    </li>
    <li>Bagian bawah berisi detil penilaian kinerja pegawai pada tahun tertentu yang ditampilkan dalam 4 tab, yaitu
        <ul>
            <li>Performance Appraisal, terdiri dari 3 sub-tab, yaitu
                <ul>
                    <li>Work Result jika non-manajer, KPI jika manajer.
                        <ul>
                            <li>Work Result, berisi penilaian aspek non manajerial yang di set sebelumnya di tab Target
                                Setting, sub tab Work Result <img
                                    src="/images/man/m1_gTalentHolding_view_performance_appraisal_work_result.jpg">.
                            </li>
                            <li>KPI, berisi penilaian aspek manajerial yang di set sebelumnya di tab Target Setting, sub
                                tab KPI <img src="/images/man/m1_gTalentHolding_view_performance_appraisal_kpi.jpg">.
                            </li>
                        </ul>
                    </li>
                    <li>Core Competency, berisi penilaian aspek kompetensi utama yang di set sebelumnya di tab Target
                        Setting, sub tab Core Competency <img
                            src="/images/man/m1_gTalentHolding_view_performance_appraisal_core_competency.jpg">.

                        <br><br>Penilaian dilakukan 2 kali dalam setahun, dan masing-masing aspek dinilai oleh pegawai
                        itu sendiri dan atasannya. Kedua penilaian tersebut kemudian menjadi input rumus tertentu untuk
                        mendapatkan nilai akhir suatu aspek.
                    </li>
                    <li>Leadership Competency, berisi penilaian aspek kompetensi kepemimpinan yang di set sebelumnya di
                        tab Target Setting, sub tab Leadership Competency <img
                            src="/images/man/m1_gTalentHolding_view_performance_appraisal_leadership_competency.jpg">.
                        <br><br>Penilaian dilakukan 2 kali dalam setahun, dan masing-masing aspek dinilai oleh pegawai
                        itu sendiri dan atasannya. Kedua penilaian tersebut kemudian menjadi input rumus tertentu untuk
                        mendapatkan nilai akhir suatu aspek.
                    </li>
                </ul>
            </li>
            <li>Final Rating, yang menampilkan tabel final rating pegawai tertentu seperti berikut <img
                    src="/images/man/m1_gTalentHolding_view_final_rating.jpg">. Tabel ini memiliki kolom
                <ul>
                    <li>Input Date, tanggal input penilaian</li>
                    <li>Year, tahun kinerja yang dinilai</li>
                    <li>Name, range waktu yang dinilai</li>
                    <li>PA Value,</li>
                    <li>HF Identification</li>
                    <li>Remark, catatan</li>
                </ul>
            </li>
            <li>Personal Info, terdiri dari 2 sub-tab, yaitu
                <ul>
                    <li>Career - Experience - Status, menampilkan riwayat karir, pengalaman kerja dan status pegawai
                        seperti berikut <img src="/images/man/m1_gTalentHolding_view_career_experience_status.jpg">
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

                            <li>Tab Experience, yang menampilkan tabel pengalaman kerja pegawai. Tabel ini memiliki
                                kolom
                                <ul>
                                    <li>Company Name, nama perusahaan</li>
                                    <li>Industries, bidang usaha perusahaan</li>
                                    <li>Start Date, tanggal mulai bekerja</li>
                                    <li>End Date, tanggal selesai bekerja</li>
                                    <li>Year Length, Month Length, lama bekerja</li>
                                    <li>Job Title, jabatan</li>
                                </ul>
                            </li>

                            <li>Tab Status, yang menampilkan tabel sejarah status kepegawaian pegawai tertentu. Tabel
                                ini memiliki kolom
                                <ul>
                                    <li>Start Date, tanggal mulai status</li>
                                    <li>End Date, tanggal selesai status</li>
                                    <li>Status, status kepegawaian</li>
                                    <li>Remark, catatan</li>
                                </ul>
                            </li>
                        </ul>
                    <li>Education, yang menampilkan tabel pendidikan formal dan non formal pegawai tertentu seperti
                        berikut <img src="/images/man/m1_gTalentHolding_view_education.jpg">. Tabel pendidikan formal
                        memiliki kolom
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