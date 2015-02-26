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
        Create Applicant
    </h1>
</div>

<p>Halaman ini digunakan untuk menambah data pelamar. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Create New Applicant, link ke halaman form untuk menambah pelamar</li>
            <li>Vacancy, link ke halaman daftar lowongan</li>
            <li>Applicant, link ke halaman daftar pelamar</li>
            <li>Selection Registration, link ke halaman jadwal seleksi</li>
            <li>Interview, link ke halaman daftar rencana interview</li>
            <li>Print CV, link untuk mendownload CV pelamar</li>
            <li>Nama-nama pelamar, link ke halaman profil pelamar</li>
        </ul>
    </li>

    <li><p>Kolom kanan berisi detil data pelamar, yang terdiri dari
        <ul>
            <li>Nama Pelamar</li>
            <li>Foto</li>
            <li>Tab Selection Process, tab ini berisi empat tabel yaitu
                <ul>
                    <li>Daftar Application</li>
                    <li>Daftar Comment</li>
                    <li>Daftar Selection Schedule</li>
                    <li>Daftar Selection Result</li>
                </ul>
                <img src="/images/man/m1_hApplicant_view_selection_process.jpg">
            </li>
            <li>Tab Candidate Profile, tab ini berisi
                <ul>
                    <li>Button Update Profile, link ke form update pelamar</li>
                    <li>Data pribadi pelamar, yang terdiri dari
                        <ul>
                            <li>Birth Place: tempat lahir</li>
                            <li>Birth Date: tanggal lahir</li>
                            <li>Sex: jenis kelamin</li>
                            <li>Religion: agama</li>
                            <li>Address: alamat rumah</li>
                            <li>Email: satu alamat email hanya boleh terdaftar satu kali</li>
                            <li>Handphone: nomor handphone</li>
                            <li>Fresh Grad: centang jika pelamar baru lulus, kosongkan jika sudah ada pengalaman</li>
                            <li>Expected Salary: gaji yang diharapkan</li>
                            <li>Expected Position: posisi yang diinginkan</li>
                        </ul>
                    </li>
                    <li>Daftar Experience</li>
                    <li>Daftar Education</li>
                    <li>Daftar Family</li>
                    <li>Daftar Non Formal Education</li>
                </ul>
                <p>
                    Untuk menghapus salah satu baris pada tabel experience, education, family, dan non formal education,
                    lakukan langkah berikut</p>
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi
                        penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus data level, atau button Cancel jika batal menghapus data level
                    </li>
                </ul>

                <img src="/images/man/m1_hApplicant_view_candidate_profile.jpg">
            </li>
            <li>Tab Create New/Experience, berisi form untuk menambah pengalaman kerja pelamar. Form ini terdiri dari
                <ul>
                    <li>Company Name, nama perusahaan tempat pernah bekerja</li>
                    <li>Industries, bidang usaha perusahaan</li>
                    <li>Start Date, tanggal mulai, format bebas</li>
                    <li>End Date, tanggal selesai, format bebas</li>
                    <li>Year Length, Month Length, lama bekerja. Misal bekerja selama 2.5 tahun, maka Year Length diisi
                        2, dan Month
                        Length diisi 6
                    </li>
                    <li>Job Title, jabatan/posisi kerja</li>
                    <li>Job Description, keterangan singkat tentang apa yang dikerjakan</li>
                </ul>
                Untuk menambah pengalaman kerja baru, isi form di atas lalu klik Create
                <img src="/images/man/m1_hApplicant_view_new_experience.jpg">
            </li>
            <li>Tab Create New/Education, berisi form untuk menambah data pendidikan formal pelamar. Form ini terdiri
                dari
                <ul>
                    <li>Level, tingkat pendidikan</li>
                    <li>Institute Name, nama sekolah/universitas</li>
                    <li>Major, nama jurusan</li>
                    <li>City / Country, kota/negara lokasi sekolah</li>
                    <li>Graduation Year, tahun lulus</li>
                    <li>GPA, nilai akhir (IPK atau NEM)</li>
                </ul>
                Untuk menambah data pendidikan formal baru, isi form di atas lalu klik Create
                <img src="/images/man/m1_hApplicant_view_new_education.jpg">
            </li>
            <li>Tab Create New/Family, berisi form untuk menambah data pendidikan pelamar. Form ini terdiri dari
                <ul>
                    <li>Name, nama anggota keluarga</li>
                    <li>Relation, hubungan keluarga</li>
                    <li>Birth Place, tempat lahir</li>
                    <li>Birth Date, tanggal lahir</li>
                    <li>Sex, jenis kelamin</li>
                    <li>Remark, keterangan tambahan</li>
                </ul>
                Untuk menambah anggota keluarga baru, isi form di atas lalu klik Create
                <img src="/images/man/m1_hApplicant_view_new_family.jpg">
            </li>
            <li>Tab Create New/Non Formal Education, berisi form untuk menambah data pendidikan non formal pelamar. Form
                ini terdiri
                dari
                <ul>
                    <li>Education Name, nama lembaga yang mengadakan pendidikan non formal tersebut</li>
                    <li>Category, bidang usaha</li>
                    <li>Start, tanggal mulai mengambil pendidikan non formal</li>
                    <li>End, tanggal selesai mengambil pendidikan non formal</li>
                    <li>Certificate, ada atau tidak ada sertifikat</li>
                    <li>Country, kota lembaga yang mengadakan pendidikan non formal</li>
                </ul>
                Untuk menambah data pendidikan non formal baru, isi form di atas lalu klik Create
                <img src="/images/man/m1_hApplicant_view_new_non_formal_education.jpg">
            </li>
            <li>Form New Process, berada di bagian bawah data pelamar, berupa form untuk menambah proses seleksi baru
                untuk pelamar
                tersebut. Form ini terdiri dari
                <ul>
                    <li>Work Flow, tahap seleksi</li>
                    <li>Work Flow Result, hasil tahap seleksi tersebut</li>
                    <li>Assessment Date, tanggal dilakukannya tahap seleksi</li>
                    <li>Assessed By, staf yang melakukan seleksi</li>
                    <li>Assessment Summary, keterangan hasil seleksi</li>
                    <li>Development Area</li>
                </ul>
                Untuk menambah tahap seleksi baru, isi form di atas lalu klik Create
            </li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/m1_hApplicant_create.jpg">