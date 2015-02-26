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
        Vacancy Detail
    </h1>
</div>

<p>
    Halaman ini menampilkan data pribadi pegawai. Halaman ini terdiri dari dua bagian, yaitu
<ul>
    <li><p>Kolom kiri berisi
        <ul>
            <li>Daftar pasangan pelamar - lamaran, link ke halaman Vacancy List</li>
            <li>Vacancy, link ke halaman daftar lowongan</li>
            <li>Applicant, link ke halaman pelaman</li>
            <li>Selection Registration, link ke halaman Selection List</li>
            <li>Interview, link ke halaman interview</li>
            <li>Update, link ke halaman update lowongan</li>
            <li>Daftar Vacancy, link ke detil lowongan tertentu saja</li>
        </ul>
    </li>
    <li>Kolom kanan terdiri dari
    <li>Campaign, promosi lowongan. Bagian ini terdiri dari
        <ul>
            <li>Daftar Campaign, dengan kolom-kolom
                <ul>
                    <li>Campaign Name: nama acara promosi</li>
                    <li>Start Date: tanggal mulai acara promosi</li>
                    <li>End Date: tanggal selesai acara promosi</li>
                    <li>Location: lokasi diadakannya promosi</li>
                    <li>Additional Info: informasi tambahan acara promosi</li>
                </ul>
            </li>
            <li>Untuk menambah data campaign baru, lakukan langkah berikut:
                <ul>
                    <li>Klik button Show/Hide New Campaign, maka APHRIS akan menampilkan form input campaign seperti
                        berikut <img src="/images/man/m1_hVacancy_view_show_hide_new_campaign.jpg"></li>
                    <li>Isikan data-data campaign, dan klik Create. APHRIS akan memperbaharui daftar campaign</li>
                </ul>
            </li>
            <li>Untuk mengubah data campaign tertentu, lakukan langkah berikut:
                <ul>
                    <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                            src="/images/man/m1_hVacancy_view_update_campaign.jpg"></li>
                    <li>Ubah data di form tersebut, lalu klik Save</li>
                </ul>
            </li>
            <li>Untuk menghapus data campaign tertentu, lakukan langkah berikut
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus data campaign, atau button Cancel jika batal menghapus data
                        campaign
                    </li>
                </ul>
            </li>
        </ul>

    </li>
    <li>Detail, untuk menampilkan atau menyembunyikan detil lowongan, klik link Show/Hide Detail. Detil yang ditampilkan
        adalah syarat-syarat lowongan tersebut, dan ditampilkan di atas tab-tab pelamar <img
            src="/images/man/m1_hVacancy_view_show_hide_detail.jpg">
    </li>
    <li>Bagian bawah berisi data pelamar yang dikelompokkan dalam 9 kelompok yaitu
        <ul>
            <li>Unprocessed</li>
            <li>Pre-Screened</li>
            <li>Candidate Pool</li>
            <li>Interview</li>
            <li>Rejected</li>
            <li>Other/Blacklisted</li>
            <li>Other/Hired</li>
            <li>Other/Other</li>
            <li>Other/Withdraw</li>
        </ul>
        Disamping nama tab terdapat angka yang menunjukkan jumlah pelamar yang ada dalam tab kelompok tersebut. <img
            src="/images/man/m1_hVacancy_view_applicant.jpg">. Masing-masing tab tersebut daftar pelamar yang ada dalam
        kelompok tersebut, dengan detil
        <ul>
            <li>Foto</li>
            <li>Waktu Melamar</li>
            <li>Nama</li>
            <li>Tanggal Lahir</li>
            <li>Jenis Kelamin</li>
            <li>Agama</li>
            <li>Nomor Telepon</li>
            <li>Daftar Pendidikan, dengan kolom
                <ul>
                    <li>Level, tingkat pendidikan, misal D3, S1</li>
                    <li>Institute Name, nama sekolah/universitas</li>
                    <li>City/Country, kota dan negara lokasi sekolah/universitas</li>
                    <li>Major, jurusan yang diambil</li>
                    <li>Graduation Year, tahun kelulusan</li>
                    <li>GPA, nilai akhir pada saat kelulusan (IPK, NEM)</li>
                </ul>
            </li>
            <li>Daftar Pengalaman Kerja, dengan kolom
                <ul>
                    <li>Company Name, nama perusahaan</li>
                    <li>Industries, bidang usaha</li>
                    <li>Start Date, tanggal mulai bekerja di perusahaan tersebut</li>
                    <li>End Date, tanggal selesai bekerja di perusahaan tersebut</li>
                    <li>Job Title, jabatan terakhir di perusahaan tersebut</li>
                </ul>
            </li>
            <li>Tombol Action, berada di samping foto. Untuk memindahkan pelamar ke kelompok pelamar lain, klik tombol
                Action, pilih kelompok pelamar lain
            </li>
        </ul>
    </li>
</ul>