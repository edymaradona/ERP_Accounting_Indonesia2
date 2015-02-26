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
    Halaman ini menampilkan data pribadi pegawai. Halaman ini terdiri dari dua bagian, yaitu
<ul>
<li>Bagian atas berisi data singkat pegawai,
    <br><img src="/images/man/m1_gPerson_view_person.jpg"><br>
    yang terdiri dari
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
        <li>Join Date, tanggal mulai bekerja. Setelah data tanggal mulai bekerja terdapat informasi lama bekerja pegawai
            tersebut
        </li>
        <li>Superior, atasan</li>
    </ul>

</li>
<li>Bagian bawah berisi data lanjutan pegawai. Data lanjutan terdiri dari beberapa tab. Angka yang berada di samping
judul tab, menyatakan jumlah data yang ada di tab tersebut. Misal, pada tab Education terdapat angka 1, berarti ada 1
baris data pendidikan pada tab tersebut. Ada beberapa tab data pegawai, yaitu
<ul>
<li>Tab Detil memiliki tampilan seperti berikut <br><img src="/images/man/m1_gPerson_view_detail.jpg">. <br>Tab ini
    berisi data detil yang terdiri dari
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
<li>Tab Internal Career, yang menampilkan tabel karir internal pegawai tertentu seperti berikut <img
        src="/images/man/m1_gPerson_view_internal_career.jpg">. <br>Tabel ini memiliki kolom
    <ul>
        <li>Start Date, tanggal mulai bekerja</li>
        <li>Status, status kepegawaian</li>
        <li>Company, perusahaan APL tempat bekerja</li>
        <li>Department, departemen tempat bekerja</li>
        <li>Level, level pekerjaan</li>
        <li>Job Title, jabatan</li>
        <li>Superior, atasan</li>
    </ul>
    <br>Untuk menambah data karir baru, lakukan langkah berikut:
    <ul>
        <li>Klik button New Career pada bagian atas daftar internal career, maka APHRIS akan menampilkan form seperti
            berikut<br><img src="/images/man/m1_gPerson_view_add_internal_career.jpg"></li>
        <li>Isi form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk mengubah data karir tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                src="/images/man/m1_gPerson_view_update_internal_career.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data karir tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data internal career, atau button Cancel jika batal menghapus data internal
            career
        </li>
    </ul>
</li>

<li>Tab Status, yang menampilkan tabel sejarah status kepegawaian pegawai tertentu seperti berikut<br> <img
        src="/images/man/m1_gPerson_view_status.jpg">. <br>Tabel ini memiliki kolom
    <ul>
        <li>Start Date, tanggal mulai status</li>
        <li>End Date, tanggal selesai status</li>
        <li>Status, status kepegawaian</li>
        <li>Remark, catatan</li>
    </ul>
    <br>Untuk menambah data status kepegawaian baru, isi form tambah status kepegawaian, yang berada pada bagian bawah
    tabel status kepegawaian, lalu klik Create.
    <br>Untuk mengubah data status kepegawaian tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                src="/images/man/m1_gPerson_view_update_status.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data karir tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data status kepegawaian, atau button Cancel jika batal menghapus data status
            kepegawaian
        </li>
    </ul>
</li>

<li>Tab Experience, yang menampilkan tabel pengalaman kerja pegawai tertentu seperti berikut <img
        src="/images/man/m1_gPerson_view_experience.jpg">. <br>Tabel ini memiliki kolom
    <ul>
        <li>Company Name, nama perusahaan</li>
        <li>Industries, bidang usaha perusahaan</li>
        <li>Start Date, tanggal mulai bekerja</li>
        <li>End Date, tanggal selesai bekerja</li>
        <li>Year Length, Month Length, lama bekerja</li>
        <li>Job Title, jabatan</li>
    </ul>
    <br>Untuk menambah data pengalaman kerja, lakukan langkah berikut:
    <ul>
        <li>Klik button New Experience pada bagian atas daftar pengalaman kerja, maka APHRIS akan menampilkan form
            seperti berikut<br> <img src="/images/man/m1_gPerson_view_add_experience.jpg"></li>
        <li>Isi form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk mengubah data pengalaman kerja tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut<br> <img
                src="/images/man/m1_gPerson_view_update_experience.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data pengalaman kerja tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data pengalaman kerja, atau button Cancel jika batal menghapus data
            pengalaman kerja
        </li>
    </ul>
</li>

<li>Tab Education, yang menampilkan tabel pendidikan formal pegawai tertentu seperti berikut <img
        src="/images/man/m1_gPerson_view_education.jpg">.<br> Tabel ini memiliki kolom
    <ul>
        <li>Level, tingkat pendidikan</li>
        <li>Institute Name, nama sekolah/universitas</li>
        <li>City/Country, kota dan negara lokasi sekolah/universitas</li>
        <li>Major, jurusan yang diambil</li>
        <li>Graduation Year, tahun kelulusan</li>
        <li>GPA, nilai akhir ketika lulus atau IPK</li>
    </ul>
    <br>Untuk menambah data pendidikan formal baru, isi form tambah pendidikan formal, yang berada pada bagian bawah
    tabel pendidikan formal, lalu klik Save

    <br>Untuk mengubah data pendidikan formal tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut<br> <img
                src="/images/man/m1_gPerson_view_update_education.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Create</li>
    </ul>
    <br>Untuk menghapus data pendidikan formal tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <br><img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data pendidikan formal, atau button Cancel jika batal menghapus data
            pendidikan formal
        </li>
    </ul>
</li>

<li>Tab Training, yang menampilkan tabel pelatihan di holding dan tabel pelatihan di perusahaan pegawai tertentu seperti
    berikut <br><img src="/images/man/m1_gPerson_view_training.jpg">. <br>Tabel pelatihan di holding memiliki kolom
    <ul>
        <li>Learning Title, nama pelatihan</li>
        <li>Schedule Date, tanggal diadakan</li>
        <li>Trainer Name, nama instruktur</li>
        <li>Duration (Hours), jumlah jam pelatihan</li>
        <li>Location, tempat diadakannya pelatihan</li>
        <li>Result Feedback, hasil penilaian dari instruktur</li>
    </ul>

    Tabel pelatihan di perusahaan memiliki kolom
    <ul>
        <li>Name, nama pelatihan</li>
        <li>Topic, topik pelatihan</li>
        <li>Instructor, instruktur pelatihan</li>
        <li>Duration, jumlah jam pelatihan</li>
        <li>Certificate, nomor sertifikat</li>
        <li>Organizer, pihak pelaksana pelatihan</li>
        <li>Place, negara lokasi pelatihan</li>
    </ul>

    <br>Admin HR perusahaan hanya dapat menambah data pelatihan di perusahaan. Untuk menambah data tersebut, lakukan
    langkah berikut:
    <ul>
        <li>Klik button New Training pada bagian atas daftar pelatihan di perusahaan (Local Training), maka APHRIS akan
            menampilkan form seperti berikut <br><img src="/images/man/m1_gPerson_view_add_training.jpg"></li>
        <li>Isi form tersebut, lalu klik Save</li>
    </ul>

    <br>Untuk menghapus data pelatihan tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data<br> <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data pelatihan, atau button Cancel jika batal menghapus data pelatihan</li>
    </ul>
</li>
<li>Tab Family, yang menampilkan tabel anggota keluarga pegawai tertentu seperti berikut <br><img
        src="/images/man/m1_gPerson_view_family.jpg">. <br>Tabel ini memiliki kolom
    <ul>
        <li>Name, nama anggota keluarga</li>
        <li>Relation, hubungan keluarga</li>
        <li>Birth Place, tempat lahir</li>
        <li>Birth Date, tanggal lahir</li>
        <li>Sex, jenis kelamin</li>
        <li>Remark, keterangan tambahan</li>
    </ul>
    <br>Untuk menambah data anggota keluarga, lakukan langkah berikut:
    <ul>
        <li>Klik button New Family pada bagian atas daftar anggota keluarga, maka APHRIS akan menampilkan form seperti
            berikut <br><img src="/images/man/m1_gPerson_view_add_family.jpg"></li>
        <li>Isi form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk mengubah data anggota keluarga tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <br><img
                src="/images/man/m1_gPerson_view_update_family.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data anggota keluarga tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data<br> <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data anggota keluarga, atau button Cancel jika batal menghapus data anggota
            keluarga
        </li>
    </ul>
</li>
<li>
    <ul>Tab More, memiliki 4 sub tab yaitu tab Non Formal Education, Other Info, Assignment dan SSO</ul>
</li>
<li>Tab Non Formal, yang menampilkan tabel pendidikan non formal pegawai tertentu seperti berikut <br><img
        src="/images/man/m1_gPerson_view_non_formal.jpg">. <br>Tabel ini memiliki kolom
    <ul>
        <li>Institution Name, nama institusi pendidikan yang mengadakan kursus/pelatihan</li>
        <li>Subject, topik kursus/pelatihan</li>
        <li>Start, tanggal mulai kursus/pelatihan</li>
        <li>End, tanggal selesai kursus/pelatihan</li>
        <li>Certificate, ada tidaknya sertifikat</li>
        <li>Country, negara lokasi institusi pendidikan</li>
    </ul>
    <br>Untuk menambah data pendidikan non formal, lakukan langkah berikut:
    <ul>
        <li>Klik button New Education Non Formal pada bagian atas daftar pendidikan non formal, maka APHRIS akan
            menampilkan form seperti berikut<br> <img src="/images/man/m1_gPerson_view_add_non_formal.jpg"></li>
        <li>Isi form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk mengubah data pendidikan non formal tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut<br> <img
                src="/images/man/m1_gPerson_view_update_non_formal.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data pendidikan non formal tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data<br> <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data pendidikan non formal, atau button Cancel jika batal menghapus data
            pendidikan non formal
        </li>
    </ul>
</li>
<li>Tab Other Info, yang menampilkan tabel informasi lain untuk pegawai tertentu seperti berikut <img
        src="/images/man/m1_gPerson_view_other_info.jpg">. <br>Tab ini berisi daftar dokumen-dokumen seperti KTP, KK,
    SIM, Paspor, memiliki data
    <ul>
        <li>Document Type, jenis dokumen</li>
        <li>Document Number, nomor dokumen</li>
        <li>Issued Date, tanggal dikeluarkannya dokumen</li>
        <li>Valid To, tanggal selesai berlakunya dokumen</li>
        <li>Custom Info1, informasi tambahan</li>
        <li>Remark, keterangan tambahan</li>
    </ul>
    <br>Untuk menambah data informasi lain, isi form tambah other info, yang berada pada bagian bawah tabel other info
    lalu klik Create

    <br>Untuk mengubah data other info tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                src="/images/man/m1_gPerson_view_update_other_info.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data other info tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data other info, atau button Cancel jika batal menghapus data other info</li>
    </ul>
</li>
<li>Tab Assignment, yang menampilkan tabel penugasan di perusahaan lain untuk pegawai tertentu seperti berikut <img
        src="/images/man/m1_gPerson_view_assignment.jpg">.<br> Tabel ini memiliki data
    <ul>
        <li>Start Date, tanggal mulai ditugaskan</li>
        <li>End Date, tanggal selesai ditugaskan</li>
        <li>Status, status penugasan</li>
        <li>Company, perusahaan lain tempat ditugaskannya pegawai tersebut</li>
        <li>Department, departemen tempat penugasan</li>
        <li>Level, level pekerjaan di penugasan</li>
        <li>Job Title, nama jabatan di penugasan</li>
    </ul>

    <br>Untuk mengubah data penugasan tertentu, lakukan langkah berikut:
    <ul>
        <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                src="/images/man/m1_gPerson_view_update_assignment.jpg"></li>
        <li>Ubah data di form tersebut, lalu klik Save</li>
    </ul>
    <br>Untuk menghapus data other info tertentu, lakukan langkah berikut
    <ul>
        <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
            penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
        <li>klik button OK untuk menghapus data penugasan, atau button Cancel jika batal menghapus data penugasan</li>
    </ul>
</li>
<li>Tab SSO, jika pegawai tersebut belum melakukan registrasi user, tampilannya adalah sebagai berikut
    <img src="/images/man/m1_gPerson_view_sso_unregistered_user.jpg">.
    <br>Pada tab ini terdapat button Generate Code yang berfungsi untuk membuat kode yang digenerate otomatis secara
    acak oleh APHRIS. Kode ini digunakan oleh user ketika melakukan registrasi user. Untuk meng-generate kode tersebut,
    klik button Generate Code. Setelah kode ter-generate, tampilan tab SSO adalah sebagai berikut <img
        src="/images/man/m1_gPerson_view_sso_generate_code.jpg">.<br>
    Jika user sudah melakukan registrasi, maka tampilan tab SSO adalah sebagai berikut <img
        src="/images/man/m1_gPerson_view_sso.jpg">
</li>
</ul>
</li>
</ul>