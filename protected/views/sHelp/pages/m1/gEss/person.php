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
        Employee
    </h1>
</div>

<p>
    Halaman ini menampilkan data pribadi Anda. Halaman ini terdiri dari dua bagian, yaitu
<ul>
    <li>Bagian atas berisi data singkat pegawai <br><img src="/images/man/m1_gEss_person_detail_singkat.jpg">, yang
        terdiri dari
        <ul>
            <li>Employee ID, nomor pegawai</li>
            <li>Company, perusahaan tempat bekerja saat ini</li>
            <li>Department, departemen tempat bekerja saat ini</li>
            <li>Job Title, jabatan</li>
            <li>Level, tingkat pekerjaan</li>
            <li>Status, status kepegawaian</li>
            <li>Join Date, tanggal mulai bekerja</li>
            <li>Superior, atasan</li>
        </ul>
    </li>
    <li>Bagian bawah berisi data lanjutan pegawai. Data lanjutan terdiri dari beberapa tab. Angka yang berada di samping
        judul tab, menyatakan jumlah data yang ada di tab tersebut. Misal, pada tab Education terdapat angka 1, berarti
        ada 1 baris data pendidikan pada tab tersebut. Ada beberapa tab data pegawai, yaitu
        <ul>
            <li>Tab Detil memiliki tampilan seperti berikut <br><img src="/images/man/m1_gEss_person_detail.jpg">. Tab
                ini berisi data detil yang terdiri dari
                <ul>
                    <li>Local ID, nomor pegawai di perusahaan</li>
                    <li>Birth Place, tempat lahir</li>
                    <li>Birth Date, tanggal lahir</li>
                    <li>Gender, jenis kelamin</li>
                    <li>Religion, agama</li>
                    <li>Blood, golongan darah</li>
                    <li>Address, alamat rumah</li>
                    <li>Pos Code, kode pos</li>
                    <li>Identity, nomor KTP</li>
                    <li>Valid, tanggal selesai berlaku KTP</li>
                    <li>Identity Address, alamat yang tercantum di KTP</li>
                    <li>Email, alamat email</li>
                    <li>Home Phone, nomor telepon rumah</li>
                    <li>Handphone, nomor handphone</li>
                    <li>Account Number, nomor rekening bank</li>
                    <li>Account Name, nama pemilik nomor rekening bank</li>
                    <li>Bank Name, nama bank penerbit nomor rekening</li>
                </ul>
            </li>
            <li>Tab Career - Experience - Status memiliki tampilan seperti berikut <br><img
                    src="/images/man/m1_gEss_person_career_experience_status.jpg">. Tab ini berisi daftar
                <ul>
                    <li>Karir di APL, memiliki data
                        <ul>
                            <li>Start Date, tanggal mulai bekerja</li>
                            <li>Status, status kepegawaian</li>
                            <li>Company, perusahaan APL tempat bekerja</li>
                            <li>Department, departemen tempat bekerja</li>
                            <li>Level, level pekerjaa</li>
                            <li>Job Title, jabatan</li>
                            <li>Superior, atasan</li>
                        </ul>
                    </li>
                    <li>Pengalaman bekerja sebelum bekerja di APL, memiliki data
                        <ul>
                            <li>Company Name, nama perusahaan</li>
                            <li>Industries, bidang usaha perusahaan</li>
                            <li>Start Date, tanggal mulai bekerja</li>
                            <li>End Date, tanggal selesai bekerja</li>
                            <li>Year Length, Month Length, lama bekerja</li>
                            <li>Job Title, jabatan</li>
                        </ul>
                    </li>
                    <li>Status kepegawaian di APL, memiliki data
                        <ul>
                            <li>Start Date, tanggal mulai status</li>
                            <li>End Date, tanggal selesai status</li>
                            <li>Status, status kepegawaian</li>
                            <li>Remark, catatan</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Tab Education memiliki tampilan seperti berikut <br><img src="/images/man/m1_gEss_person_education.jpg">.
                Tab ini berisi daftar
                <ul>
                    <li>Pendidikan formal pegawai, memiliki data
                        <ul>
                            <li>Level, tingkat pendidikan</li>
                            <li>Institution Name, nama sekolah/universitas</li>
                            <li>City/Country, kota dan negara lokasi sekolah/universitas</li>
                            <li>Major, jurusan yang diambil</li>
                            <li>Graduation Year, tahun kelulusan</li>
                        </ul>
                    </li>
                    <li>Pendidikan non formal pegawai, memiliki data
                        <ul>
                            <li>Institution Name, nama institusi pendidikan yang mengadakan kursus/pelatihan</li>
                            <li>Subject, topik kursus/pelatihan</li>
                            <li>Start, tanggal mulai kursus/pelatihan</li>
                            <li>End, tanggal selesai kursus/pelatihan</li>
                            <li>Certificate, nomor sertifikat</li>
                            <li>Country, negara lokasi institusi pendidikan</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Tab Training memiliki tampilan seperti berikut <br><img src="/images/man/m1_gEss_person_training.jpg">.
                Tab ini berisi daftar
                <ul>
                    <li>Holding Training, pelatihan yang diadakan Holding, memiliki data
                        <ul>
                            <li>Learning Title, nama pelatihan</li>
                            <li>Schedule Date, tanggal diadakan</li>
                            <li>Trainer Name, nama instruktur</li>
                            <li>Duration (Hours), jumlah jam pelatihan</li>
                            <li>Location, tempat diadakannya pelatihan</li>
                            <li>Result (Feedback), hasil penilaian dari instruktur</li>
                        </ul>
                    </li>
                    <li>Local Training, pelatihan yang diadakan perusahaan sendiri, memiliki data
                        <ul>
                            <li>Name, nama pelatihan</li>
                            <li>Topic, topik pelatihan</li>
                            <li>Instructor, instruktur pelatihan</li>
                            <li>Duration, jumlah jam pelatihan</li>
                            <li>Certificate, nomor sertifikat</li>
                            <li>Organizer, pihak pelaksana pelatihan</li>
                            <li>Country, negara lokasi pelatihan</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Tab Family memiliki tampilan seperti berikut <br><img src="/images/man/m1_gEss_person_family.jpg">. Tab
                ini berisi daftar anggota keluarga, memiliki data
                <ul>
                    <li>Name, nama anggota keluarga</li>
                    <li>Relation, hubungan keluarga</li>
                    <li>Birth Place, tempat lahir</li>
                    <li>Birth Date, tanggal lahir</li>
                    <li>Sex, jenis kelamin</li>
                    <li>Remark, keterangan tambahan</li>
                </ul>
            </li>
            <li>Tab Other memiliki tampilan seperti berikut <br><img src="/images/man/m1_gEss_person_other.jpg">. Tab
                ini berisi daftar dokumen-dokumen seperti KTP, KK, SIM, Paspor, memiliki data
                <ul>
                    <li>Document Type, nama dokumen</li>
                    <li>Document Number, nomor dokumen</li>
                    <li>Issued Date, tanggal dikeluarkannya dokumen</li>
                    <li>Valid To, tanggal selesai berlakunya dokumen</li>
                    <li>Custom Info1, informasi tambahan</li>
                    <li>Remark, keterangan tambahan</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
