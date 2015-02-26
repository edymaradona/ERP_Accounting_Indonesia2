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
        Sent Mail
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
    <li>Kolom kanan, berisi daftar pesan terkirim</li>
</ul>
<img src="/images/man/mailbox_message_sent.jpg">