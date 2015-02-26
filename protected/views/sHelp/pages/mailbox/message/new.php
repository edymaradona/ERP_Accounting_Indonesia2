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
    <li>Kolom kanan, berisi form untuk mengirim pesan baru, terdiri dari
        <ul>
            <li>To, username APHRIS penerima</li>
            <li>Subject, judul email</li>
            <li>Isi pesan</li>
            <li>Button Send Message, untuk mengirim email. Jika diklik pesan di form tersebut akan masuk ke Sent Mail
                pengirim dan Inbox penerima
            </li>
        </ul>
    </li>
</ul>
<img src="/images/man/mailbox.jpg">