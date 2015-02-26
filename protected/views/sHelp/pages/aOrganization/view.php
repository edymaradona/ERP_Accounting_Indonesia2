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
        Organization Structure
    </h1>
</div>

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri, menampilkan struktur organisasi seperti daftar folder yang dapat dibuka dan ditutup</li>
    <li>Kolom tengah, menampilkan halaman detil organisasi. Kolom ini terdiri dari beberapa bagian, yaitu
        <ul>
            <li>Tab Detail, menampilkan data organisasi. Nama Parent Organization adalah link ke detil halaman
                organisasi yang membawahi organisasi yang sedang diakses. <img
                    src="/images/man/aOrganization_view_detail.jpg"></li>
            <li>Tab User Member, menampilkan user yang bekerja di organisasi tersebut. Nama user adalah link ke halaman
                detil user. <br><img src="/images/man/aOrganization_view_user_member.jpg"></li>
            <li>Tab Logo, menampilkan logo organisasi, dan button upload. <br><img
                    src="/images/man/aOrganization_view_logo.jpg"><br>
                Untuk mengupload logo, klik button upload,
                sistem akan menampilkan window untuk memilih file yang akan diupload <img
                    src="/images/man/upload_foto.jpg">. <br> Pilih file yang akan diupload, lalu klik Open.
            </li>
    </li>
    <li>Child Organization, tabel daftar sub organisasi. Nama sub organisasi adalah link ke halaman detilnya. Untuk
        menghapus sub organisasi, klik icon <img src="/images/man/bin.jpg">.
    <li>New Child Organization, form untuk menambahkan sub organisasi ke organisasi yang sedang diakses detilnya. Cara
        pengisiannya sama dengan cara membuat organisasi baru
    </li>
</ul>

<li>Kolom kanan, menampilkan
    <ul>
        <li>Button Create New Organization, link ke halaman tambah organisasi baru</li>
        <li>Home, link ke halaman daftar organisasi</li>
        <li>Update, link ke halaman update data organisasi</li>
        <li>Delete, link untuk menghapus organisasi</li>
        <li>Recently Updated, organisasi yang baru diubah datanya</li>
        <li>Recently Added, organisasi yang baru ditambahkan</li>
        <li>Related, organisasi terkait</li>
    </ul>
</li>

<BR>