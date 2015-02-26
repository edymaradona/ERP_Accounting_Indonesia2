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
        Cost Center
    </h1>
</div>

<p>
    Halaman ini menampilkan data pribadi pegawai. Halaman ini terdiri dari dua bagian, yaitu
<ul>
    <li>Bagian atas berisi data singkat pegawai, yang terdiri dari
        <ul>
            <li>Pas foto</li>
            <li>Data Completeness, menyatakan persentase kelengkapan data pegawai</li>
            <li>Button Upload pas foto pegawai</li>
            <li>Employee ID, nomor pegawai</li>
            <li>Company, perusahaan tempat bekerja saat ini</li>
            <li>Department, departemen tempat bekerja saat ini</li>
            <li>Job Title, jabatan</li>
            <li>Level, tingkat pekerjaan</li>
            <li>Status, status kepegawaian</li>
            <li>Join Date, tanggal mulai bekerja. Setelah data tanggal mulai bekerja terdapat informasi lama bekerja
                pegawai tersebut
            </li>
            <li>Superior, atasan</li>
        </ul>
    </li>
    <li>Bagian bawah berisi data lanjutan yaitu cost center, detil dan assignment pegawai. Data lanjutan terdiri dari
        beberapa tab. Angka yang berada di samping judul tab, menyatakan jumlah data yang ada di tab tersebut. Misal,
        pada tab Cost Center terdapat angka 1, berarti ada 1 baris data cost center pada tab tersebut. Ada beberapa tab
        data cost center, yaitu
        <ul>
            <li>Tab Cost Center, yang menampilkan tabel cost center pegawai tertentu seperti berikut <img
                    src="/images/man/m1_gPersonCostcenter_view_cost_center.jpg">. Tabel ini memiliki kolom
                <ul>
                    <li>Start Date, tanggal mulai sebuah company menjadi cost center pegawai</li>
                    <li>End Date, tanggal selesai company menjadi cost center pegawai</li>
                    <li>Company, perusahaan yang menjadi cost center</li>
                    <li>Remark, catatan</li>
                </ul>
                <br>Untuk menambah data cost center baru, isi form tambah cost center, yang berada pada bagian bawah
                tabel cost center, lalu klik Create.
                <!--br>Untuk mengubah data cost center tertentu, lakukan langkah berikut:
                    <ul>
                        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img src="/images/man/m1_gPersonCostcenter_view_update_cost_center.jpg"></li>
                        <li>Ubah data di form tersebut, lalu klik Save</li>
                    </ul>
                <br>Untuk menghapus data karir tertentu, lakukan langkah berikut
                    <ul>
                        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                        <li>klik button OK untuk menghapus data cost center, atau button Cancel jika batal menghapus data cost center</li>
                    </ul-->
            </li>

            <li>Tab Detil memiliki tampilan seperti berikut <br><img
                    src="/images/man/m1_gPersonCostcenter_view_detail.jpg">. Tab ini berisi data detil yang terdiri dari
                <ul>
                    <li>Local ID, nomor pegawai di perusahaan</li>
                    <li>Birth Place, tempat lahir</li>
                    <li>Birth Date, tanggal lahir. Setelah tanggal lahir terdapat informasi usia pegawai</li>
                    <li>Gender, jenis kelamin</li>
                    <li>Religion, agama</li>
                    <li>Blood, golongan darah</li>
                    <li>Address, alamat rumah</li>
                    <li>Pos Code, kode pos</li>
                    <li>Identity Number, nomor KTP</li>
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

            <li>Tab Assignment, yang menampilkan tabel assignment pegawai ke departemen tertentu seperti berikut <img
                    src="/images/man/m1_gPersonCostcenter_view_assignment.jpg">. Tabel ini memiliki kolom
                <ul>
                    <li>Start Date, tanggal mulai assignment</li>
                    <li>End Date, tanggal selesai assignment</li>
                    <li>Status, status kepegawaian di assignment tersebut</li>
                    <li>Company, perusahaan yang menjadi tempat assignment</li>
                    <li>Department, departemen yang menjadi tempat assignment</li>
                    <li>Level, level pekerjaan assignment</li>
                    <li>Job Title, jabatan assignment</li>
                </ul>
                <br>Untuk menambah data assignment baru, lakukan langkah berikut:
                <ul>
                    <li>Klik button New Assignment pada bagian atas daftar assignment, maka APHRIS akan menampilkan form
                        seperti berikut <img src="/images/man/m1_gPersonCostcenter_view_add_assignment.jpg"></li>
                    <li>Isi form tersebut, lalu klik Save</li>
                </ul>
                <br>Untuk mengubah data assignment tertentu, lakukan langkah berikut:
                <ul>
                    <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                            src="/images/man/m1_gPersonCostcenter_view_update_assignment.jpg"></li>
                    <li>Ubah data di form tersebut, lalu klik Save</li>
                </ul>
                <br>Untuk menghapus data assignment tertentu, lakukan langkah berikut
                <ul>
                    <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta
                        konfirmasi penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
                    <li>klik button OK untuk menghapus data assignment, atau button Cancel jika batal menghapus data
                        assignment
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>