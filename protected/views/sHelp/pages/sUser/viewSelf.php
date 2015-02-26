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
        Lihat Profil Pribadi
    </h1>
</div>

<p>Halaman ini menampilkan data profil user. Halaman ini terdiri dari 3 bagian yaitu:
<ul>
    <li>Bagian atas, menampilkan
        <ul>
            <li>Update User Name, link ke halaman update username</li>
            <li>Update Password, link ke halaman update/ganti password</li>
        </ul>
    </li>
    <li>Bagian tengah, menampilkan data profil user yaitu nama lengkap, username, organisasi asal, dan status</li>
    <li>Bagian bawah, menampilkan tool untuk mengelola file dokumen user. Fitur-fitur yang disediakan dikelompokkan
        menjadi dua yaitu
        <ul>
            <li>Fitur icon atas, terdiri dari
            <li>Back</li>
            <li>Reload</li>
            <li>Open</li>
            <li>New Folder</li>
            <li>New Text File</li>
            <li>Upload File</li>
            <li>Copy</li>
            <li>Paste</li>
            <li>Remove</li>
            <li>Rename</li>
            <li>Edit Text File</li>
            <li>Get Info</li>
            <li>Preview with Quick Look</li>
            <li>Resize Image</li>
            <li>View as Icons</li>
            <li>View as List</li>
            <li>Help</li>
    </li>
    <li>Fitur klik kanan mouse untuk satu file
        <ul>
            <li>Open</li>
            <li>Preview with Quick Look</li>
            <li>Copy</li>
            <li>Cut</li>
            <li>Remove</li>
            <li>Duplicate</li>
            <li>Create Archive (Tar, Bzip atau Gzip archive</li>
            <li>Info</li>
        </ul>
    </li>
    <li>Fitur klik kanan mouse untuk beberapa file
        <ul>
            <li>Reload</li>
            <li>New Folder</li>
            <li>New Text File</li>
            <li>Upload Files</li>
            <li>Get Info</li>
        </ul>
    </li>
</ul>
</li>
</ul>
Untuk mengubah nama dan username, isi form, lalu klik Save.
<img src="/images/man/sUser_viewSelf.jpg">