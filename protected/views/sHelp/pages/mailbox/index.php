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
        Inbox
    </h1>
</div>

<p>Halaman ini terdiri dari dua bagian yaitu
<ul>
    <li>Kolom kiri, berisi
        <ul>
            <li>Inbox, link ke halaman daftar pesan masuk</li>
            <li>Sent Mail, link ke halaman daftar pesan terkirim</li>
            <li>Trash, link ke halaman daftar pesan yang sudah dihapus</li>
            <li>New Message, link ke halaman untuk membuat pesan baru</li>
        </ul>
    </li>
    <li>Kolom kanan, berisi
        <ul>
            <li>Button Check All, untuk memilih semua pesan</li>
            <li>Button Uncheck All, untuk menghilangkan tanda dipilih di semua pesan</li>
            <li>Daftar pesan</li>
            <li>Button Delete, untuk menghapus pesan yang dipilih</li>
            <li>Button Read, untuk menandai pesan yang dipilih sebagai pesan yang sudah dibaca</li>
            <li>Button Unread, untuk menandai pesan yang dipilih sebagai pesan yang belum dibaca</li>
        </ul>
    </li>
</ul>
<img src="/images/man/mailbox.jpg">